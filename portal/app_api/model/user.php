<?php
class User {
    public $id;
    public $name;
    public $password;
    public $hash;
    public $level;
    public $dtCreated;
    public $dtModified;
    public $dtActive;
    public $status;

    public function __construct() {
    }

    public static function selectAll() {
        $connection = Flight::dbMain();
        try {
            $sql = "SELECT * FROM user;";
            $query = $connection->prepare($sql);
            $query->execute();
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = array();
            foreach ($rows as $row) {	
                $data = new User();
                $data->id = (int) $row['id'];
                $data->name = $row['user_name'];
                $data->password = $row['user_password'];
                $data->hash = $row['user_hash'];
                $data->level = (int) $row['user_level'];
                $data->dtCreated = $row['user_dt_created'];
                $data->dtModified = $row['user_dt_modified'];
                $data->dtActive = $row['user_dt_active'];
                $data->status = Status::select($row['status_id']);
                array_push($result,  $data);
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
            
            $sql = "SELECT * FROM user WHERE id = :id;";
            $query = $connection->prepare($sql);
            $query->bindParam(':id',$id, PDO::PARAM_INT);
            $query->execute();
            
            if ($query->rowCount() == 0) { throw new Exception("id dont exist"); }
            $row = $query->fetch(PDO::FETCH_ASSOC);

            $data = new User();
            $data->id = (int) $row['id'];
            $data->name = $row['user_name'];
            $data->password = $row['user_password'];
            $data->hash = $row['user_hash'];
            $data->level = (int) $row['user_level'];
            $data->dtCreated = $row['user_dt_created'];
            $data->dtModified = $row['user_dt_modified'];
            $data->dtActive = $row['user_dt_active'];
            $data->status = Status::select($row['status_id']);

            return  $data;                
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
            INSERT INTO user (
                user_name, 
                user_password, 
                user_hash, 
                user_level, 
                user_dt_created, 
                user_dt_modified, 
                user_dt_active, 
                status_id)
            VALUES (
                :user_name, 
                :user_password, 
                :user_hash, 
                :user_level, 
                :user_dt_created, 
                :user_dt_modified, 
                :user_dt_active, 
                :status_id);";
            
            $time = time();
            $query = $connection->prepare($sql);
            $query->bindParam(':user_name', $data->name, PDO::PARAM_STR);
            $query->bindParam(':user_password', $data->password, PDO::PARAM_STR);
            $query->bindParam(':user_hash', $data->hash, PDO::PARAM_STR);
            $query->bindParam(':user_level',$data->level, PDO::PARAM_INT);
            $query->bindParam(':user_dt_created', $time, PDO::PARAM_INT);
            $query->bindParam(':user_dt_modified', $data->dtModified, PDO::PARAM_INT);
            $query->bindParam(':user_dt_active', $data->dtActive, PDO::PARAM_STR);
            $query->bindParam(':status_id',$data->status->id, PDO::PARAM_INT);
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
            if ($data == null) { throw new Exception(Flight::jsonError()); }
            if ($id == null) { throw new Exception("id is null"); }
            
            $sql = "
            UPDATE user 
            SET 
            user_name = :user_name, 
            user_password = :user_password, 
            user_hash = :user_hash, 
            user_level = :user_level, 
            user_dt_created = :user_dt_created, 
            user_dt_modified = :user_dt_modified, 
            user_dt_active = :user_dt_active, 
            status_id = :status_id
            WHERE
            id = :id;";
            $query = $connection->prepare($sql);
            $query->bindParam(':user_name', $data->name, PDO::PARAM_STR);
            $query->bindParam(':user_password', $data->password, PDO::PARAM_STR);
            $query->bindParam(':user_hash', $data->hash, PDO::PARAM_STR);
            $query->bindParam(':user_level',$data->level, PDO::PARAM_INT);
            $query->bindParam(':user_dt_created', $data->dtCreated, PDO::PARAM_INT);
            $query->bindParam(':user_dt_modified', $data->dtModified, PDO::PARAM_INT);
            $query->bindParam(':user_dt_active', $data->dtActive, PDO::PARAM_STR);
            $query->bindParam(':status_id',$data->status->id, PDO::PARAM_INT);
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
            DELETE FROM user 
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

