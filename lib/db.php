<?php
if(!defined('ACCESS')) {
    die('Direct access not permitted');
}

class DB {

    public $conn;
    public $config;

    public function __construct()
    {
        $this->connect();
    }

    public  function connect()
    {
        if (!include('config.php')) {
            echo('<strong>Error:</strong> Could not find a config.php file root directory. Check to make sure the file exists.');
            die();
        }
        $this->config = &$config;

        // Create connection
        $this->conn = mysqli_connect($this->config['host'], $this->config['username'], $this->config['password'], $this->config['database']);

        // Check connection
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function read()
    {
        $sql = "SELECT b.id as id, first_name, last_name, street, zip, c.city_name as city  FROM book b JOIN city c ON b.city_id = c.id ORDER BY b.id   ";
        $result = $this->conn->query($sql);
        $return = [];
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $return[] = $row;
            }
        }

        return $return;

    }

    public function get_cities()
    {
        $sql = "SELECT id, city_name as city from city ORDER by id";
        $result = $this->conn->query($sql);
        $return = [];
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $return[] = $row;
            }
        }

        return $return;

    }

    public function update()
    {

    }

    public function delete()
    {

    }



    public function __destruct()
    {
        $this->conn->close();
    }

}