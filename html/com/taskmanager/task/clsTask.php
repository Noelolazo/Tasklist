<?php
class clsTask
{
    private $id;
    private $list_id;
    private $title;
    private $description;
    private $deadline;
    private $location;
    private $status;

    public function __construct($title, $deadline, $description = "", $location = "", $list_id = 0, $status = "pending", $id = 0)
    {
        $this->id = $id;
        $this->list_id = $list_id;
        $this->title = $title;
        $this->description = $description;
        $this->deadline = $deadline;
        $this->location = $location;
        $this->status = $status;
    }

    public function save()
    {
        global $dbCommand;
        if ($this->id != 0) {
            $sql = "UPDATE Task SET Title = '$this->title', Description = '$this->description', Deadline = '$this->deadline', Location = '$this->location', Status = '$this->status' WHERE Task_ID = '$this->id'";
            $dbCommand->execute($sql);
        } else {
            $sql = "INSERT INTO Task (List_ID, Title, Description, Deadline, Location) VALUES ('$this->list_id','$this->title','$this->description','$this->deadline','$this->location')";
            $resultid = $dbCommand->insert($sql);
            $this->id = $resultid;
        }
    }

    public function to_XML($xml)
    {
        $root = $xml->createElement("task");
        $root->appendChild($xml->createElement("task_id", $this->id));
        $root->appendChild($xml->createElement("list_id", $this->list_id));
        $root->appendChild($xml->createElement("title", $this->title));
        $root->appendChild($xml->createElement("description", $this->description));
        $root->appendChild($xml->createElement("deadline", $this->deadline));
        $root->appendChild($xml->createElement("location", $this->location));
        $root->appendChild($xml->createElement("status", $this->status));
        return $root;
    }

    public function render_XML()
    {
        $xml = new DOMDocument("1.0", "UTF-8");
        $xml->formatOutput = true;
        $taskElement = $this->to_XML($xml);
        $xml->appendChild($taskElement);

        header("Content-Type: application/xml");
        echo $xml->saveXML();
    }

    public function getData()
    {
        return [$this->id, $this->title, $this->description, $this->deadline, $this->location, $this->status];
    }

    ///////////////////////////////////////// GETTER 

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDeadline()
    {
        return $this->deadline;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getStatus()
    {
        return $this->status;
    }

    ///////////////////////////////////////// SETTER 

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }


    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}

?>