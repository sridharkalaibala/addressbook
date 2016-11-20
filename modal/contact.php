<?php
if(!defined('ACCESS')) {
    die('Direct access not permitted');
}
include_once "lib/db.php";

class Contact extends DB{

    private $persistResult = [];

    public function __construct()
    {
        parent::__construct();
    }

    /*
     *  Reads all contact information for data table
     */

    public function read_all($searchText = null, $start=0, $limit=10)
    {
        $sql = "SELECT b.id as id, first_name, last_name, street, c.city_name as city, zip, GROUP_CONCAT(g.name) as group_name FROM contact b 
                JOIN city c ON b.city_id = c.id
                LEFT JOIN contact_group cg ON b.id = cg.contact_id
                LEFT JOIN groups g ON cg.group_id = g.id  GROUP BY b.id
                ORDER BY b.id DESC   LIMIT $start, $limit  ";
        // Query only specific to search text
        if(isset($searchText))
            $sql = "SELECT b.id as id, first_name, last_name, street, c.city_name as city, zip, GROUP_CONCAT(g.name) as group_name FROM contact b 
                    LEFT JOIN contact_group cg ON b.id = cg.contact_id
                    JOIN groups g ON cg.group_id = g.id  GROUP BY b.id
                    WHERE b.first_name LIKE '%$searchText%' || b.last_name LIKE '%$searchText%'
                    || b.street LIKE '%$searchText%' || c.city_name = '$searchText'  ORDER BY b.id DESC  LIMIT $start, $limit  ";
        $result = $this->conn->query($sql);
        $return = [];
        if (isset($result->num_rows) && $result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $return[] = $row;
            }
        }

        return $return;

    }

    /*
     *  Reads all contacts belongs to particular group
     */
    public function readByGroup($parent_groups, $searchText = null, $start=0, $limit=10)
    {
        $sql = "SELECT b.id as id, first_name, last_name, street, c.city_name as city, zip, GROUP_CONCAT(g.name) as group_name FROM contact b 
                JOIN city c ON b.city_id = c.id
                LEFT JOIN contact_group cg ON b.id = cg.contact_id
                LEFT JOIN groups g ON cg.group_id = g.id  
                WHERE cg.group_id IN (".implode($parent_groups,',').") GROUP BY b.id
                ORDER BY b.id DESC   LIMIT $start, $limit  ";
        // Query only specific to when search submitted
        if(isset($searchText))
            $sql = "SELECT b.id as id, first_name, last_name, street, c.city_name as city, zip, GROUP_CONCAT(g.name) as group_name FROM contact b 
                    JOIN city c ON b.city_id = c.id 
                    LEFT JOIN contact_group cg ON b.id = cg.contact_id
                    LEFT JOIN groups g ON cg.group_id = g.id  
                    WHERE cg.group_id IN (".implode($parent_groups,',').") ".
                "AND (b.first_name LIKE '%$searchText%' || b.last_name LIKE '%$searchText%'".
                "|| b.street LIKE '%$searchText%' || c.city_name = '%$searchText%' )  GROUP BY b.id  ORDER BY b.id DESC  LIMIT $start, $limit  ";
        $result = $this->conn->query($sql);
        $return = [];
        if (isset($result->num_rows) && $result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $return[] = $row;
            }
        }

        return $return;

    }

    /*
     *  Find total number of records when group based query
     */

    public function readByGroupTotal($parent_groups, $searchText = null)
    {
        $sql = "SELECT count(b.id) as total FROM contact b 
                JOIN city c ON b.city_id = c.id
                LEFT JOIN contact_group cg ON b.id = cg.contact_id
                LEFT JOIN groups g ON cg.group_id = g.id 
                WHERE b.group_id IN (".implode($parent_groups,',').")  GROUP BY b.id";
        if(isset($searchText))
            $sql = "SELECT count(b.id) as total FROM contact b 
                    JOIN city c ON b.city_id = c.id 
                    LEFT JOIN contact_group cg ON b.id = cg.contact_id
                    LEFT JOIN groups g ON cg.group_id = g.id 
                    WHERE b.group_id IN (".implode($parent_groups,',').") ".
                "AND (b.first_name LIKE '%$searchText%' || b.last_name LIKE '%$searchText%'".
                "|| b.street LIKE '%$searchText%' || c.city_name = '%$searchText%' )  GROUP BY b.id";

         $result = $this->conn->query($sql);
        $return = [];
        if (isset($result->num_rows) && $result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                return $row['total'];
            }
        }

        return 0;

    }

    /*
     *  Get total number of records for pagination
     */

    public function get_total_number($searchText = null)
    {
        $sql = 'SELECT count(b.id) as total FROM contact b JOIN city c ON b.city_id = c.id';
        if(isset($searchText))
            $sql = 'SELECT count(b.id) as total FROM contact b JOIN city c ON b.city_id = c.id WHERE b.first_name LIKE "%' . $searchText . '%" || b.last_name LIKE "%' . $searchText . '%"'.
                '|| b.street LIKE "%' . $searchText . '%" || c.city_name = "' . $searchText . '" ';
        $result = $this->conn->query($sql);
        if (isset($result->num_rows) && $result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                return $row['total'];
            }
        }
        return 0;
    }

    /*
     *  When Contact edit, Retrieving row data to edit
     */
    public function read($id)
    {
        $sql = "SELECT b.id as id, first_name, last_name, street, zip, c.id as city FROM contact b JOIN city c ON b.city_id = c.id WHERE b.id=$id";
        $result = $this->conn->query($sql);
        if (isset($result->num_rows) && $result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $row['groups'] = $this->getGroups($id);
                return $row;
            }
        }
        return [];

    }

    /*
     *  Get all groups available
     */
    public  function getGroups($id)
    {
        $sql = "SELECT group_id FROM contact_group WHERE contact_id = $id";
        $result = $this->conn->query($sql);
        $return = [];
        while ($row = $result->fetch_assoc()) {
            $return[] = $row['group_id'];
        }
        return $return;
    }

    /*
     *  Get all cities in the city table
     */
    public function get_cities()
    {
        $sql = "SELECT id, city_name as city from city ORDER by id";
        $result = $this->conn->query($sql);
        $return = [];
        if (isset($result->num_rows) && $result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $return[] = $row;
            }
        }

        return $return;

    }

    /*
     *  Add new record into contact
     *  Groups will be inserted into contact_group with relation
     */

    public function insert($fields)
    {
        $groups = isset($fields['groups']) ? $fields['groups'] :[];
        unset($fields['groups']);
        $fields = $this->escapeString($fields);
        $sql = 'INSERT INTO contact(first_name, last_name, street, zip, city_id) VALUES ("'.$fields['first_name'].'"'
            .', "'.$fields['last_name'].'", "'.$fields['street'].'", "'.$fields['zip'].'", "'.$fields['city'].'") ';
        $result = $this->conn->query($sql);
        $contact_id = $this->conn->insert_id;
        if($result) {
            foreach($groups as $value)
                $this->insertRelation($contact_id, $value);
            return true;
        }
        else
            return false;
    }

    /*
     *   Contact and its group id will be inserted int contact_group table
     */

    public function insertRelation($contact_id, $group_id)
    {
        $sql = 'INSERT INTO contact_group(contact_id,group_id) VALUES ("'.$contact_id.'","'.$group_id.'") ';
        $this->conn->query($sql);
    }


    /*
     *   Delete all contact group relation entrieds in contact_group table
     */
    public function deleteRelation($id)
    {
        $sql = "DELETE  from contact_group WHERE contact_id=$id";
        $result = $this->conn->query($sql);
        if($result)
            return true;
        else
            return false;
    }

    /*
     *  Editing contact records into contact table
     *  contacts groups relation entries will deleted and edited information inserted
     */

    public function update($fields, $id)
    {
        $groups = isset($fields['groups']) ? $fields['groups'] :[];
        unset($fields['groups']);
        $fields = $this->escapeString($fields);
        $sql = 'UPDATE contact SET first_name = "'.$fields['first_name'].'", last_name = "'.$fields['last_name'].'", street="'.$fields['street'].'", zip = "'.$fields['zip'].'" '
            .', city_id = "'.$fields['city'].'" WHERE id ='.$id;
        $result = $this->conn->query($sql);
        if($result) {
            $this->deleteRelation($id);
            foreach($groups as $value)
                $this->insertRelation($id, $value);
            return true;
        }
        else
            return false;
    }

    /*
     *  Deleting the contact and contact group relational entries
     */

    public function delete($id)
    {
        $sql  = "DELETE  from contact WHERE id=$id; ";
        $sql .= "DELETE  from contact_group WHERE contact_id=$id";
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

    public function __destruct()
    {
        parent::__destruct();
    }

}