<?php
if(!defined('ACCESS')) {
    die('Direct access not permitted');
}
include_once "lib/db.php";

class Group extends DB{

    private $persistParent = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function read_all($searchText = null, $start=0, $limit=10)
    {
        $sql = "SELECT * from groups ORDER BY id DESC LIMIT $start, $limit  ";
        if(isset($searchText))
            $sql = "SELECT * from groups  ".
                    "WHERE name LIKE '%$searchText%'  ORDER BY id DESC  LIMIT $start, $limit  ";
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
        $sql = 'SELECT count(id) as total FROM  groups';
        if(isset($searchText))
            $sql = 'SELECT count(id) as total FROM groups  WHERE name LIKE "%' . $searchText . '%"  ';
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
        $sql = "SELECT *  FROM groups WHERE id=$id";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $row['parents'] = $this->getGroupParents($id);
                return $row;
            }
        }
        return [];

    }


    public function insert($fields)
    {
        $parents = isset($fields['parents']) ? $fields['parents'] :[];
        $fields = $this->escapeString(array('name' => $fields['name']));
        $sql = 'INSERT INTO groups(name) VALUES ("'.$fields['name'].'") ';
        $result = $this->conn->query($sql);
        $group_id = $this->conn->insert_id;
        if($result) {
            foreach($parents as $value)
            $this->insertRelation($group_id, $value);
            return true;
        }
        else
            return false;
    }

    public function insertRelation($group_id, $parents)
    {
        $sql = 'INSERT INTO group_inherit(group_id,parent_id) VALUES ("'.$group_id.'","'.$parents.'") ';
        $this->conn->query($sql);
    }

    public function deleteRelation($id)
    {
        $sql = "DELETE  from group_inherit WHERE group_id=$id";
        $result = $this->conn->query($sql);
        if($result)
            return true;
        else
            return false;
    }

    public function update($fields, $id)
    {
        $parents = isset($fields['parents']) ? $fields['parents'] :[];
        $fields = $this->escapeString(array('name' => $fields['name']));
        $sql = 'UPDATE groups SET name = "'.$fields['name'].'" WHERE id ='.$id;
        $result = $this->conn->query($sql);
        if($result) {
            $this->deleteRelation($id);
            foreach($parents as $value)
                $this->insertRelation($id, $value);
            return true;
        }
        else
            return false;
    }

    public function delete($id)
    {
        if($id == 1) return false;

        $sql  = "DELETE  from groups WHERE id=$id; ";
        $sql .= "DELETE  from group_inherit WHERE group_id=$id OR parent_id=$id; ";
        $sql .= "DELETE  from contact WHERE group_id=$id; ";
        if ($this->conn->multi_query($sql)) {
            $call = true;
            do {
                if (!$this->conn->more_results()) {
                    $call = false;
                }
            } while ($call && $this->conn->next_result());
            return true;
        } else {
            return false;
        }

    }

    function getGroupParents($id)
    {
        $sql = "SELECT parent_id FROM group_inherit WHERE group_id = $id";
        $result = $this->conn->query($sql);
        $return = [];
        while ($row = $result->fetch_assoc()) {
            $return[] = $row['parent_id'];
        }
        return $return;
    }

    function getGroups()
    {
        $sql = "SELECT * FROM groups ORDER BY name";
        $result = $this->conn->query($sql);
        $return = [];
        while ($row = $result->fetch_assoc()) {
            $return[] = $row;
        }
        return $return;
    }

    function getAllParents($group_id)
    {
        $sql = 'SELECT parent_id FROM group_inherit WHERE group_id='.$group_id;
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            if(!in_array($row['parent_id'],$this->persistParent) && $row['parent_id'] != NULL){
                $this->persistParent[] = $row["parent_id"];
                $this->getAllParents($row["parent_id"]);
            }

        }
        return $this->persistParent;
    }

    public function __destruct()
    {
        parent::__destruct();
    }

}