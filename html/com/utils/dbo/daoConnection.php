<?php
class connConnection {
    private $host;
    private $user;
    private $password;
    private $databaseName;
    // private $port;
    private $conn;

    public function __construct($host, $databaseName, $user, $password) {
        $this->host=$host;
        $this->databaseName=$databaseName;
        $this->user=$user;
        $this->password=$password;
        $this -> connectON();
    }

    private function connectON() {
        try {
            $this -> conn = new mysqli($this->host, $this->user, $this->password, $this->databaseName);
        } catch (Exception $error) {
            echo "Could not connect to the database: ". $error -> getMessage();
        }
    }

    public function getConn(){
        return $this -> conn;
        
    }
}



?>