<?php

class UserManager
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
                if (!$this->existMail($email)){
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

                // $register_code = $this->dbCommand->execute('sp_wdev_get_registercode', array($username, 0));

                // URL del Web App desplegado en Google Apps Script
                //url pau
                // $url = 'https://script.google.com/macros/s/AKfycbzs-WaweIA_cKNVVgqqPmianx7dn4wPI7AflDvM78iUcP8pUoYNh5u5Dg7nBlkofdKu/exec';

                //url Pol
                // $url = 'https://script.google.com/macros/s/AKfycbxAQsgiFCg31C-G1MzD27GjZTo0Owa22XBoGJQzu2AT-WV8lWj76kud2WOuxLaxpH6OYw/exec';

                // // Parámetros del correo electrónico
                // $destinatario = $email;
                // $asunto = 'Código de registro.';
                // $cuerpo = $name . ', su código de verificación es ' . $register_code;
                // $adjunto = null; 

                // // Llamada a la función para enviar el correo
                // $resultado = enviarCorreo($url, $destinatario, $asunto, $cuerpo, $adjunto);
                // // $resultado2 = readAndRegisterUsers($url);

                // // Establecer el encabezado para XML
                // header('Content-Type: text/xml');

                // // Mostrar la respuesta XML
                
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
                        $user = new clsUser($info[0], $info[1], $info[2], $info[3]);
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
                    var_dump($hpasswd);
                    if (password_verify($password, $hpasswd[0])) {
                        $hnewpasswd = password_hash($newpassword, PASSWORD_BCRYPT);
                        var_dump($hnewpasswd);
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

    public function listusers($ssid)
    {
        if (empty($ssid)) {
            echo "Todos los campos son obligatorios.";
        } else {
            try {
                $result = $this->dbCommand->execute('sp_list_users2', array($ssid));

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
}
?>