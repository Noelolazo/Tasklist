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
        if (is_null($phone_number)) {
            $this->phone_number = "";

        } else {
            $this->phone_number = $phone_number;
        }

    }

    public function to_XML()
    {
        $xml = new DOMDocument("1.0", "UTF-8");
        $xml->formatOutput = true;

        $root = $xml->createElement("root");
        $userElement = $xml->createElement("user");

        $userElement->appendChild($xml->createElement("id", $this->id));
        $userElement->appendChild($xml->createElement("username", $this->username));
        $userElement->appendChild($xml->createElement("email", $this->email));
        $userElement->appendChild($xml->createElement("phone_number", $this->phone_number));

        $root->appendChild($userElement);
        $xml->appendChild($root);

        return $xml;
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