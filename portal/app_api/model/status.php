<?php
    class Status {
        public $id;
        public $name;
        public $desc;
        public $value;
        
        public function __construct() {
        }

        public static function selectAll() {
            $connection = Flight::dbMain();
            try {
                $sql = "SELECT * FROM status;";
                $query = $connection->prepare($sql);
                $query->execute();
                $rows = $query->fetchAll(PDO::FETCH_ASSOC);
                $result = array();
                foreach ($rows as $row) {	
                    $data = new Status();
                    $data->id = (int) $row['id'];
                    $data->name = $row['status_name'];
                    $data->desc = $row['status_desc'];
                    $data->value = (int)$row['status_value'];
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

                $sql = "SELECT * FROM status WHERE id = :id;";
                $query = $connection->prepare($sql);
                $query->bindParam(':id',$id, PDO::PARAM_INT);
                $query->execute();

                if ($query->rowCount() == 0) { throw new Exception("id dont exist"); }
                $row = $query->fetch(PDO::FETCH_ASSOC);

                $data = new Status();
                $data->id = (int) $row['id'];
                $data->name = $row['status_name'];
                $data->desc = $row['status_desc'];
                $data->value = (int)$row['status_value'];
              
                return $data;                
            } catch (Exception $exception) {
                throw $exception;
            } finally {
                $connection = null;
            }
        }
      
    }
?>