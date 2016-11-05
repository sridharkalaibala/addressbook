<?php
/**
 * Created by PhpStorm.
 * User: sridhar
 * Date: 5/11/16
 * Time: 11:07 PM
 */

include_once '../config.php';

class db {

    public $conn;
    public $config;

    public function __construct()
    {

        if (!include('../config.php')) {
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


}