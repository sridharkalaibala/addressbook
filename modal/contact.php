<?php
if(!defined('ACCESS')) {
    die('Direct access not permitted');
}
include_once "lib/db.php";

class Contact extends DB{

    public function __construct()
    {
        parent::__construct();
    }

    public function read_all($searchText = null, $start=0, $limit=10)
    {
        $sql = "SELECT b.id as id, first_name, last_name, street, c.city_name as city, zip FROM contact b JOIN city c ON b.city_id = c.id ORDER BY b.id DESC   LIMIT $start, $limit  ";
        if(isset($searchText))
            $sql = "SELECT b.id as id, first_name, last_name, street, c.city_name as city, zip FROM contact b JOIN city c ON b.city_id = c.id ".
                "WHERE b.first_name LIKE '%$searchText%' || b.last_name LIKE '%$searchText%'".
                "|| b.street LIKE '%$searchText%' || c.city_name = '$searchText'  ORDER BY b.id DESC  LIMIT $start, $limit  ";
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

    public function get_total_number($searchText = null)
    {
        $sql = 'SELECT count(b.id) as total FROM contact b JOIN city c ON b.city_id = c.id';
        if(isset($searchText))
            $sql = 'SELECT count(b.id) as total FROM contact b JOIN city c ON b.city_id = c.id WHERE b.first_name LIKE "%' . $searchText . '%" || b.last_name LIKE "%' . $searchText . '%"'.
                '|| b.street LIKE "%' . $searchText . '%" || c.city_name = "' . $searchText . '" ';
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                return $row['total'];
            }
        }
        return 0;
    }

    public function read($id)
    {
        $sql = "SELECT b.id as id, first_name, last_name, street, zip, c.id as city  FROM contact b JOIN city c ON b.city_id = c.id WHERE b.id=$id";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                return $row;
            }
        }
        return [];

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

    public function insert($fields)
    {
        $fields = $this->escapeString($fields);
        $sql = 'INSERT INTO contact(first_name, last_name, street, zip, city_id) VALUES ("'.$fields['first_name'].'"'
            .', "'.$fields['last_name'].'", "'.$fields['street'].'", "'.$fields['zip'].'", "'.$fields['city'].'" ) ';
        $result = $this->conn->query($sql);
        if($result)
            return true;
        else
            return false;
    }

    public function update($fields, $id)
    {
        $fields = $this->escapeString($fields);
        $sql = 'UPDATE contact SET first_name = "'.$fields['first_name'].'", last_name = "'.$fields['last_name'].'", street="'.$fields['street'].'", zip = "'.$fields['zip'].'"'
            .', city_id = "'.$fields['city'].'" WHERE id ='.$id;
        $result = $this->conn->query($sql);
        if($result)
            return true;
        else
            return false;
    }

    public function delete($id)
    {
        $sql = "DELETE  from contact WHERE id=$id";
        $result = $this->conn->query($sql);
        if($result)
            return true;
        else
            return false;
    }

    private function escapeString($fields){
        foreach ($fields as $index => $value){
            $fields[$index] = mysqli_real_escape_string($this->conn,$value);
        }
        return $fields;
    }

    public function __destruct()
    {
        parent::__destruct();
    }

}