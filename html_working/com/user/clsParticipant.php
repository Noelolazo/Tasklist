<?php

class clsParticipant
{
    private $user_id;
    private $username;
    private $email;
    private $role;
    private $status;

    function __construct($user_id, $username, $email, $role = "", $status = "")
    {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->email = $email;
        $this->role = $role;
        $this->status = $status;
    }

    public function to_XML($xml)
    {
        $root = $xml->createElement("participant");
        $root->appendChild($xml->createElement("user_id", $this->user_id));
        $root->appendChild($xml->createElement("username", $this->username));
        $root->appendChild($xml->createElement("email", $this->email));
        $root->appendChild($xml->createElement("role", $this->role));
        $root->appendChild($xml->createElement("status", $this->status));
        return $root;
    }

    public function render_XML()
    {
        $xml = new DOMDocument("1.0", "UTF-8");
        $xml->formatOutput = true;
        $participantElement = $this->to_XML($xml);
        $xml->appendChild($participantElement);

        header("Content-Type: application/xml");
        echo $xml->saveXML();
    }

    ///////////////////////////////////////// GETTER 
    public function getUser_id()
    {
        return $this->user_id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getStatus()
    {
        return $this->status;
    }

    ///////////////////////////////////////// SETTER 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }
}


?>