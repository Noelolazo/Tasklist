<?php

class clsConnection
{
    private $dbCommand;
    private $user;
    private $conn_id;
    private $user_id;
    private $email;
    private $date_connected;
    private bool $connected = false;

    public function __construct($user)
    {
        $this->user = $user;
        $this->user_id = $user->getId();
        $this->email = $user->getEmail();
        $this->writeConnection();
        $this->connected = $this->isConnected();
        $this->checkDateConnected();
    }

    private function writeConnection()
    {
        global $dbCommand;
        $this->conn_id = $this->generateUUID();
        $sql = "INSERT INTO User_connections (Connection_ID, User_id, Email) VALUES ('$this->conn_id', '$this->user_id', '$this->email')";
        $dbCommand->insert($sql);
    }

    public function isConnected()
    {
        global $dbCommand;
        $sql = "SELECT Connection_ID FROM User_connections WHERE Connection_ID='$this->conn_id'";
        $result = $dbCommand->execute($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkDateConnected()
    {
        global $dbCommand;
        $sql = "SELECT Date_Connected FROM User_connections WHERE Connection_ID='$this->conn_id'";
        $result = $dbCommand->execute($sql);
        $date = mysqli_fetch_row($result);
        $this->date_connected = $date[0];
    }

    public function discConnection()
    {
        global $dbCommand;
        if ($this->isConnected()) {
            $sql = "INSERT INTO User_connections_history (User_ID, Email, Date_connected) VALUES ('$this->user_id', '$this->email', '$this->date_connected')";
            $dbCommand->insert($sql);
            $sql = "DELETE FROM User_connections WHERE Connection_ID = '$this->conn_id'";
            $dbCommand->execute($sql);
            $this->connected = false;
            return true;
        } else {
            echo "NO CONECTADO";
            return false;
        }
    }


    public function getAll()
    {
        // echo "User:" . (var_dump($this->user)) . '<br>';
        echo "User ID:" . $this->user_id . '<br>';
        echo "Conn ID:" . $this->conn_id . '<br>';
        echo "Email:" . $this->email . '<br>';
        echo "Date connected:" . $this->date_connected . '<br>';
    }

    public function getUserData()
    {
        $xml = $this->user->to_XML(); 
        header("Content-Type: application/xml");
        echo $xml->saveXML();
    }

    private function generateUUID()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
    
    public function getConnected()
    {
        return $this->connected;
    }

    public function getUser_id()
    {
        return $this->user_id;
    }
}

?>