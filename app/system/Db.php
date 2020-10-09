<?php



class DB {


    CONST HOST = 'localhost';
    CONST USER = 'root';
    CONST PASS = 'root';
    CONST DB = 'test_db';

    private $connection;

    public function __construct() {
        $this->connection = new mysqli(self::HOST, self::USER, self::PASS, self::DB);

        if ($this->connection->connect_error) {
            throw new Exception('Error: ' . $this->connection->error . '<br />Error No: ' . $this->connection->errno);
        }

        $this->connection->set_charset("utf8");
        $this->connection->query("SET SQL_MODE = ''");
    }

    public function query($sql) {
        $query = $this->connection->query($sql);

        if (!$this->connection->errno) {
            if ($query instanceof \mysqli_result) {
                $data = array();

                while ($row = $query->fetch_assoc()) {
                    $data[] = $row;
                }

                $result = new stdClass();
                $result->num_rows = $query->num_rows;
                $result->row = isset($data[0]) ? $data[0] : array();
                $result->rows = $data;

                $query->close();

                return $result;
            } else {
                return true;
            }
        } else {
            throw new \Exception('Error: ' . $this->connection->error  . '<br />Error No: ' . $this->connection->errno . '<br />' . $sql);
        }
    }

    public function escape($value) {
        return $this->connection->real_escape_string($value);
    }
    public function getLastId() {
        return $this->connection->insert_id;
    }

    public function __destruct() {
        $this->connection->close();
    }
}
