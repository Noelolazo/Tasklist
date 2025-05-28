<?php

class clsUserManager
{
    private $dbCommand;

    public function __construct($dbCommand)
    {
        $this->dbCommand = $dbCommand;
    }

    public function register($name, $email, $password, $phone_number = NULL)
    {
        if (empty($name) || empty($password) || empty($email)) {
            echo "All the fields are mandatory.";
            return;
        } else {
            try {
                if (!$this->existMail($email)) {
                    $hpasswd = password_hash($password, PASSWORD_BCRYPT);
                    $phone_value = (is_null($phone_number) || $phone_number === '') ? "NULL" : intval($phone_number);
                    $sql = "INSERT INTO User (Name, Email, Password, Phone_number, Status) 
                    values ('$name', '$email', '$hpasswd', $phone_value, 1);";
                    $resultid = $this->dbCommand->insert($sql);
                    $user = new clsUser($resultid, $name, $email, $phone_number);
                    return $user;
                } else {
                    echo "Email already registered.";
                }

            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

    public function login($email, $password)
    {
        if (empty($email) || empty($password)) {
            echo "All the fields are mandatory.";
        } else {
            try {
                if ($this->existMail($email)) {
                    $sql = "SELECT * FROM User WHERE Email = '$email'";
                    $result = $this->dbCommand->execute($sql);
                    $info = mysqli_fetch_row($result);
                    // var_dump($info);
                    if (password_verify($password, $info[3])) {
                        $user = new clsUser($info[0], $info[1], $info[2], $info[4]);
                        echo "Login correct";
                        return $user;
                    } else {
                        echo "Bad password.";
                        return null;
                    }
                } else {
                    echo "User does not exists.";
                    return null;
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

    public function logout()
    {
        try {
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                $result = $this->dbCommand->execute('sp_user_logout', array($username));
                session_destroy();

                // Establecer el encabezado para XML
                header('Content-Type: text/xml');

                // Mostrar la respuesta XML
                echo $result;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function recoverPassword($email)
    {
        try {
            if ($this->existMail($email)) {
                $pin = $this->generatePin($email);
                $url = 'https://script.google.com/macros/s/AKfycbyX3ZFgqmwbPlSUIGyCk8Pkn9nmyglD8fsUG2o4yuVM62v9Ch5brS7hTdQ-0S3hm-Ag/exec';
                $receiver = $email;
                $affair = 'Recover password.';
                $body = 'Your recovery code is ' . $pin;
                $attachments = null;

                $result = sendMail($url, $receiver, $affair, $body, $attachments);
                if ($result == "1") {
                    echo "The recover password mail has been sent.";
                } else {
                    echo "Something went wrong.";
                }
            } else {
                echo "The email doesn't exists.";
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function recoverPasswordPin($email, $pin, $password)
    {
        if (empty($email) || empty($password) || empty($pin)) {
            echo "All fields are mandatory.";
        } else {
            try {
                if ($this->existMail($email)) {
                    if ($this->correctPIN($email, $pin)) {
                        $hnewpasswd = password_hash($password, PASSWORD_BCRYPT);
                        // var_dump($hnewpasswd);
                        $sql = "UPDATE User SET Password='$hnewpasswd' where Email = '$email'";
                        $this->dbCommand->execute($sql);
                        $this->deletePin(($pin));
                        echo "Change of password correct.";
                    } else {
                        echo "Incorrect PIN.";
                    }
                } else {
                    echo "Email not found (What did you do?).";
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

    public function changePassword($email, $password, $newpassword)
    {
        if (empty($email) || empty($password) || empty($newpassword)) {
            echo "All fields are mandatory.";
        } else {
            try {
                if ($this->existMail($email)) {
                    $sql = "SELECT Password FROM User WHERE Email = '$email'";
                    $result = $this->dbCommand->execute($sql);
                    $hpasswd = mysqli_fetch_row($result);
                    // var_dump($hpasswd);
                    if (password_verify($password, $hpasswd[0])) {
                        $hnewpasswd = password_hash($newpassword, PASSWORD_BCRYPT);
                        // var_dump($hnewpasswd);
                        $sql = "UPDATE User SET Password='$hnewpasswd' where Email = '$email'";
                        $this->dbCommand->execute($sql);
                        echo "Change of password correct";
                    } else {
                        echo "User does not exists or bad password.";
                    }
                }
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

    public function accountValidate($username, $code)
    {
        if (empty($username) || empty($code)) {
            echo "Todos los campos son obligatorios.";
        } else {
            try {
                $result = $this->dbCommand->execute('sp_user_accountvalidate', array($username, $code));

                // Establecer el encabezado para XML
                header('Content-Type: text/xml');

                // Mostrar la respuesta XML
                echo $result;

            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }

    private function existMail($email)
    {
        try {
            $sql = "SELECT * FROM User WHERE Email = '$email'";
            $result = $this->dbCommand->execute($sql);
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    private function correctPIN($email, $pin)
    {
        try {
            $sql = "SELECT Pin FROM Password_Reset_Pin WHERE User_ID = (SELECT User_ID FROM User u WHERE u.Email = '$email')";
            $result = $this->dbCommand->execute($sql);
            $dbPin = mysqli_fetch_row($result);
            if ($dbPin[0] == $pin) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    private function generatePin($email)
    {
        try {
            $sql = "SELECT User_ID FROM User WHERE Email = '$email'";
            $result = $this->dbCommand->execute($sql);
            $row = mysqli_fetch_assoc($result);
            $id = $row['User_ID'];
            $pin = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $sql2 = "INSERT INTO Password_Reset_Pin (User_ID, Pin) VALUES ($id, $pin) ON DUPLICATE KEY UPDATE Pin = VALUES(Pin), Created_At = CURRENT_TIMESTAMP";
            $result2 = $this->dbCommand->execute($sql2);

            return $pin;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

        private function deletePin($pin)
    {
        try {
            $sql = "DELETE FROM Password_Reset_Pin WHERE Pin = $pin";
            $this->dbCommand->execute($sql);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        }
    }
?>