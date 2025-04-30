<?php
class clsList
{
    private $id;
    private $title;
    private $description;
    private $tasks;
    private $participants;

    public function __construct($title, $description = "", $tasks = array(), $participants = array(), $id = null)
    {
        $this->title = $title;
        $this->description = $description;
        $this->tasks = $tasks;
        $this->participants = $participants;
        $this->id = $id;
    }

    public function save()
    {
        global $dbCommand;
        // global $connection;
        if ($this->id) {
            $sql = "UPDATE List SET Title = '$this->title', Description = '$this->description' WHERE List_ID = '$this->id'";
            $dbCommand->execute($sql);
            $sql2 = "DELETE FROM List_User_Access WHERE List_ID = '$this->id'";
            $dbCommand->execute($sql);
        } else {
            $sql = "INSERT INTO List (Title, Description) VALUES ('$this->title', '$this->description')";
            $resultid = $dbCommand->insert($sql);
            $this->id = $resultid;
        }
        foreach ($this->participants as $participant) {
            $sql = "INSERT INTO List_User_Access (List_ID, User_ID, Role, Status) VALUES ('$this->id', '$participant->user_id', '$participant->role', '$participant->status')";
            $dbCommand->insert($sql2);
        }
        foreach ($this->tasks as $task) {
            $task->save();
        }
    }

    public function addTask($tasks)
    {
        foreach ($tasks as $task) {
            array_push($this->tasks, $task);
        }
    }

    public function getTask($task_id) {
        foreach ($this->tasks as $task) {
            if ($task->getId() == $task_id) {
                return $task;
            }
        }
        echo "Tarea no encontrada";
        return null;
    }

    public function addParticipants($participants = array())
    {
        foreach ($participants as $participant) {
            array_push($this->participants, $participant);
        }
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

    public function getTasks()
    {
        return $this->tasks;
    }

    public function getParticipants()
    {
        return $this->participants;
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

    public function setTasks($tasks)
    {
        $this->tasks = $tasks;

        return $this;
    }

    public function setParticipants($participants)
    {
        $this->participants = $participants;

        return $this;
    }
}
?>