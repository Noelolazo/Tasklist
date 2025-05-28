<?php
class DBCommand {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function execute($sql) {
        $result = $this->conn->query($sql);
        if (!$result) {
            echo "Query error: " . $this->conn->error;
        }
        return $result;
    }

    public function insert($sql) {
        $this->execute($sql);
        return $this->conn->insert_id;
    }

    public function fetchRow($result) {
        return $result->fetch_assoc();
    }

    public function getRowCount($result) {
        return $result->num_rows;
    }

    public function freeResult($result) {
        if ($result) {
            $result->free();
        }
    }

    // public function __destruct() {
    //     $this->conn->close();
    // }
}

?>
