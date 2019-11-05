<?php

class Preference {
    public $id;
    public $class;
    public $property;
    public $value;

    public function __construct() {
    }

    public static function selectAll() {
        $connection = Flight::dbMain();
        try {
            $sql = "SELECT * FROM preference;";
            $query = $connection->prepare($sql);
            $query->execute();

            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = array();

            foreach ($rows as $row) {	
                $data = new Preference();
                $data->id = (int) $row['id'];
                $data->class = $row['preference_class'];
                $data->property = $row['preference_property'];
                $data->value = (int) $row['preference_value'];

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
            
            $sql = "SELECT * FROM preference WHERE id = :id;";
            $query = $connection->prepare($sql);
            $query->bindParam(':id',$id, PDO::PARAM_INT);
            $query->execute();
            
            if ($query->rowCount() == 0) { throw new Exception("id dont exist"); }
            
            $row = $query->fetch(PDO::FETCH_ASSOC);

            $data = new Preference();
            $data->id = (int) $row['id'];
            $data->class = $row['preference_class'];
            $data->property = $row['preference_property'];
            $data->value = (int) $row['preference_value'];
        
            return $data;                
        } catch (Exception $exception) {
            throw $exception;
        } finally {
            $connection = null;
        }
    }

    public static function selectByClassProperty($class, $property) {
        $connection = Flight::dbMain();
        try {
            if ($class == null) { throw new Exception("class is null"); }
            if ($property == null) { throw new Exception("property is null"); }
            
            $sql = "SELECT * FROM preference WHERE preference_class = :preference_class and preference_property = :preference_property;";
            $query = $connection->prepare($sql);
            $query->bindParam(':preference_class', $class, PDO::PARAM_STR);
            $query->bindParam(':preference_property', $property, PDO::PARAM_STR);
            $query->execute();
            
            if ($query->rowCount() == 0) { throw new Exception("class or property dont exist"); }
            
            $row = $query->fetch(PDO::FETCH_ASSOC);

            $data = new Preference();
            $data->id = (int) $row['id'];
            $data->class = $row['preference_class'];
            $data->property = $row['preference_property'];
            $data->value = (int) $row['preference_value'];
            
            return $data;                
        } catch (Exception $exception) {
            throw $exception;
        } finally {
            $connection = null;
        }
    }
    public static function insert($data) {
        $connection = Flight::dbMain();
        $connection->beginTransaction();
        try {
            if ($data == null) { throw new Exception(Flight::jsonError()); }

            $sql = "
            INSERT INTO preference (
                preference_class, 
                preference_property, 
                preference_value) 
            VALUES (
                :preference_class, 
                :preference_property, 
                :preference_value);";
            
            $query = $connection->prepare($sql);
            $query->bindParam(':preference_class', $data->class, PDO::PARAM_STR);
            $query->bindParam(':preference_property', $data->property, PDO::PARAM_STR);
            $query->bindParam(':preference_value',$data->value, PDO::PARAM_INT);
            $query->execute();
            
            $connection->commit();
            return null;                
        } catch (Exception $exception) {
            $connection->rollBack();
            throw $exception;
        } finally {
            $connection = null;
        }
    }
    
    public static function update($id, $data) {
        $connection = Flight::dbMain();
        $connection->beginTransaction();
        try {
            $data = json_decode(file_get_contents("php://input"));
            if ($data == null) { throw new Exception(Flight::jsonError()); }
            if ($id == null) { throw new Exception("id is null"); }

            $sql = "
            UPDATE preference 
            SET 
            preference_class = :preference_class, 
            preference_property = :preference_property, 
            preference_value = :preference_value
            WHERE
            id = :id;";
            $query = $connection->prepare($sql);
            $query->bindParam(':preference_class', $data->class, PDO::PARAM_STR);
            $query->bindParam(':preference_property', $data->property, PDO::PARAM_STR);
            $query->bindParam(':preference_value',$data->value, PDO::PARAM_INT);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            
            $connection->commit();
            return null;                
        } catch (Exception $exception) {
            $connection->rollBack();
            throw $exception;
        } finally {
            $connection = null;
        }
    }
    public static function delete($id) {
        $connection = Flight::dbMain();
        $connection->beginTransaction();
        try {
            if ($id == null) { throw new Exception("id is null"); }

            $sql = "
            DELETE FROM preference 
            WHERE
            id = :id";
            $query = $connection->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            
            $connection->commit();
            return null;                
        } catch (Exception $exception) {
            $connection->rollBack();
            throw $exception;
        } finally {
            $connection = null;
        }
    }
}
?>