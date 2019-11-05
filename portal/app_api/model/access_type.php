<?php
    class AccessType {
        public $id;
        public $name;
        public $desc;
        public $value;
        
        public function __construct() {
        }

        public static function selectAll() {
            $connection = Flight::dbMain();
            try {
                $sql = "SELECT * FROM access_type;";
                $query = $connection->prepare($sql);
                $query->execute();
                $rows = $query->fetchAll(PDO::FETCH_ASSOC);
                $result = array();
                foreach ($rows as $row) {	
                    $data = new AccessType();
                    $data->id = (int) $row['id'];
                    $data->name = $row['access_type_name'];
                    $data->desc = $row['access_type_desc'];
                    $data->value = (int)$row['access_type_value'];
                    array_push($result, $data);
                }
                return $result;                
            } catch (Exception $exception) {
                throw $exception;
            } finally {
                $connection = null;
            }
        }
        public static function select($id) {
            $connection = Flight::dbMain();
            
            try {
                if ($id == null) { throw new Exception("id is null"); }

                $sql = "SELECT * FROM access_type WHERE id = :id;";
                $query = $connection->prepare($sql);
                $query->bindParam(':id',$id, PDO::PARAM_INT);
                $query->execute();

                if ($query->rowCount() == 0) { throw new Exception("id dont exist"); }
                $row = $query->fetch(PDO::FETCH_ASSOC);

                $data = new AccessType();
                $data->id = (int) $row['id'];
                $data->name = $row['access_type_name'];
                $data->desc = $row['access_type_desc'];
                $data->value = (int)$row['access_type_value'];
              
                return $data;                
            } catch (Exception $exception) {
                throw $exception;
            } finally {
                $connection = null;
            }
        }
    }
?>