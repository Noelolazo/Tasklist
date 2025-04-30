<?php

class clsUser {
    
    private $id;
    private $username;
    private $email;
    private $phone_number;

    function __construct($id, $username, $email, $phone_number = '') {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->phone_number = $phone_number;

    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
    

?>