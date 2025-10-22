<?php
    abstract class Database 
    {
	protected $db;
	public function __construct($db) 
        {
            $this->db = $db;
        }
	
        public function save($table, $fields, $values) 
        {
            $save = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.")";
            $this->db->query($save);
            
            return $this->db->insert_id;
        }

        public function getAll($table, $fields, $orders) 
        {
            $query = "SELECT ".$fields." FROM ".$table." ORDER by ".$orders."";
            $result = $this->db->query($query);

            if ($result->num_rows > 0) {
                for ($i=0; $i<$result->num_rows; $i++) {
                    $array[] = $result->fetch_assoc();
                }
                return $array;
            } else {
                return false;
            }
        }

        public function getOne($table, $fields, $where) 
        {
            $query = "SELECT ".$fields." FROM ".$table." WHERE ".$where." ";
            $result = $this->db->query($query); 

            if($result->num_rows == 1) {
                $row = $result->fetch_assoc(); 
                return $row;
            } else {
                return false;
            }
        }

        public function delete($table, $where)
        {
            $query = "DELETE FROM ".$table." WHERE ".$where." ";
            $this->db->query($query);
        }
    }
