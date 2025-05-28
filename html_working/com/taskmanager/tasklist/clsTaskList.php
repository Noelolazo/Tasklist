<?php
class clsTaskList
{
    private $tasklist;

    public function __construct($load = false)
    {
        $this->tasklist = [];
        if ($load) {
            $this->load();
        } else {
            return;
        }
    }

    public function save()
    {
        foreach ($this->tasklist as $list) {
            $list->save();
        }
        echo "0";
    }

    public function load()
    {
        global $dbCommand;
        global $connection;
        $user_id = $connection->getUser_id();
        // $sql = "SELECT l.List_ID, l.Title, l.Description
        //     FROM List l
        //     JOIN List_User_Access lua ON l.List_ID = lua.List_ID
        //     WHERE lua.User_ID = '$user_id' AND lua.Status = 'active'";
        $sql = "SELECT l.List_ID, l.Title, l.Description
            FROM List l";
        $result = $dbCommand->execute($sql);
        while ($row = mysqli_fetch_row($result)) {
            $list = new clsList($row[1], $row[2], id: $row[0]);
            $sql2 = "SELECT 
                lua.User_ID,
                u.Name,
                u.Email,
                lua.Role,
                lua.Status
            FROM List_User_Access lua
            JOIN User u ON lua.User_ID = u.User_ID
            WHERE lua.List_ID = '$row[0]' AND lua.Status = 'active'";
            $result2 = $dbCommand->execute($sql2);
            $participants = array();
            while ($row2 = mysqli_fetch_row($result2)) {
                $participant = new clsParticipant($row2[0], $row2[1], $row2[2], $row2[3], $row2[4]);
                array_push($participants, $participant);
            }
            $list->setParticipants($participants);

            $sql3 = "SELECT t.*
                FROM Task t
                JOIN List lua ON t.List_ID = lua.List_ID
                WHERE lua.List_ID = '$row[0]'";
            $result3 = $dbCommand->execute($sql3);
            $tasks = array();
            while ($row3 = mysqli_fetch_row($result3)) {
                $task = new clsTask($row3[2], $row3[4], $row3[3], $row3[5], $row3[6], $row3[0], $row3[1]);
                array_push($tasks, $task);
            }
            $list->setTasks($tasks);
            array_push($this->tasklist, $list);
        }
    }

    public function to_XML()
    {
        $xml = new DOMDocument("1.0", "UTF-8");
        $xml->formatOutput = true;

        $root = $xml->createElement("tasklist");
        $listsElement = $xml->createElement("lists");

        foreach ($this->tasklist as $list) {
            $listsElement->appendChild($list->to_XML($xml));
        }

        $root->appendChild($listsElement);
        $xml->appendChild($root);

        header("Content-Type: application/xml");
        echo $xml->saveXML();
    }

    public function getbyDay($date){
        $xml = new DOMDocument("1.0", "UTF-8");
        $xml->formatOutput = true;

        $root = $xml->createElement("tasklist");
        $listsElement = $xml->createElement("lists");

        foreach ($this->tasklist as $list) {
            $listsElement->appendChild($list->getbyDay($date, $xml));
        }

        $root->appendChild($listsElement);
        $xml->appendChild($root);

        header("Content-Type: application/xml");
        echo $xml->saveXML();
    }

    public function add($list)
    {
        array_push($this->tasklist, $list);
    }

    public function get()
    {
        return $this->tasklist;
    }


}
?>