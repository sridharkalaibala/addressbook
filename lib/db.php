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

    public function connect()
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

    protected function escapeString($fields){
        foreach ($fields as $index => $value){
            $fields[$index] = mysqli_real_escape_string($this->conn,$value);
        }
        return $fields;
    }

    public function __destruct()
    {
        $this->conn->close();
    }

}