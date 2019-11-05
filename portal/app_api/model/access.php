<?php
class Access {
    public $id;
    public $code;
    public $amount;
    public $time;
    public $dtCreated;
    public $dtExpired;
    public $accessType;
    public $status;

    public function __construct() {
    }

    public static function selectAll() {
        $connection = Flight::dbMain();
        try {
            $sql = "SELECT * FROM access;";
            $query = $connection->prepare($sql);
            $query->execute();
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = array();
            foreach ($rows as $row) {	
                $data = new Access();
                $data->id = (int) $row['id'];
                $data->code = $row['access_code'];
                $data->amount = (int) $row['access_amount'];
                $data->time = (int) $row['access_time'];
                $data->dtCreated = (int) $row['access_dt_created'];
                $data->dtExpired = (int) $row['access_dt_expired'];
                $data->accessType = AccessType::select($row['access_type_id']);
                $data->status = Status::select($row['status_id']);
                array_push($result, $data);
            }

            return $result;                
        } catch (Exception $exception) {
            throw $exception;
        } finally {
            $connection = null;
        }
    }
    public static function selectByCode($code) {
        $connection = Flight::dbMain();
        try {
            if ($code == null) { throw new Exception("code is null"); }
            
            $sql = "SELECT * FROM access WHERE access_code = :access_code;";
            $query = $connection->prepare($sql);
            $query->bindParam(':access_code',$code, PDO::PARAM_INT);
            $query->execute();
            
            if ($query->rowCount() == 0) { throw new Exception("code dont exist"); }
            
            $row = $query->fetch(PDO::FETCH_ASSOC);

            $data = new Access();
            $data->id = (int) $row['id'];
            $data->code = $row['access_code'];
            $data->amount = (int) $row['access_amount'];
            $data->time = (int) $row['access_time'];
            $data->dtCreated = (int) $row['access_dt_created'];
            $data->dtExpired = (int) $row['access_dt_expired'];
            $data->accessType = AccessType::select($row['access_type_id']);
            $data->status = Status::select($row['status_id']);

            return $data;                
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
            
            $sql = "SELECT * FROM access WHERE id = :id;";
            $query = $connection->prepare($sql);
            $query->bindParam(':id',$id, PDO::PARAM_INT);
            $query->execute();
            
            if ($query->rowCount() == 0) { throw new Exception("id dont exist"); }
            
            $row = $query->fetch(PDO::FETCH_ASSOC);

            $data = new Access();
            $data->id = (int) $row['id'];
            $data->code = $row['access_code'];
            $data->amount = (int) $row['access_amount'];
            $data->time = (int) $row['access_time'];
            $data->dtCreated = (int) $row['access_dt_created'];
            $data->dtExpired = (int) $row['access_dt_expired'];
            $data->accessType = AccessType::select($row['access_type_id']);
            $data->status = Status::select($row['status_id']);

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
            INSERT INTO access (
                access_code, 
                access_amount, 
                access_time, 
                access_dt_created, 
                access_dt_expired, 
                access_type_id, 
                status_id)
            VALUES (
                :access_code, 
                :access_amount, 
                :access_time, 
                :access_dt_created, 
                :access_dt_expired, 
                :access_type_id, 
                :status_id);";
            
            $query = $connection->prepare($sql);
            $query->bindParam(':access_code', $data->code, PDO::PARAM_STR);
            $query->bindParam(':access_amount', $data->amount, PDO::PARAM_INT);
            $query->bindParam(':access_time', $data->time, PDO::PARAM_INT);
            $query->bindParam(':access_dt_created',$data->dtCreated, PDO::PARAM_INT);
            $query->bindParam(':access_dt_expired', $data->dtExpired, PDO::PARAM_INT);
            $query->bindParam(':access_type_id', $data->accessType->id, PDO::PARAM_INT);
            $query->bindParam(':status_id',$data->status->id, PDO::PARAM_INT);
            $query->execute();
            
            $insertedId = $connection->lastInsertId();
            $connection->commit();

            return  $insertedId;                
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
            UPDATE access 
            SET 
            access_code = :access_code, 
            access_amount = :access_amount, 
            access_time = :access_time, 
            access_dt_created = :access_dt_created, 
            access_dt_expired = :access_dt_expired, 
            access_type_id = :access_type_id, 
            status_id = :status_id
            WHERE
            id = :id;";
            $query = $connection->prepare($sql);
            $query->bindParam(':access_code', $data->code, PDO::PARAM_STR);
            $query->bindParam(':access_amount', $data->amount, PDO::PARAM_INT);
            $query->bindParam(':access_time', $data->time, PDO::PARAM_INT);
            $query->bindParam(':access_dt_created', $data->dtCreated, PDO::PARAM_INT);
            $query->bindParam(':access_dt_expired', $data->dtExpired, PDO::PARAM_INT);
            $query->bindParam(':access_type_id', $data->accessType->id, PDO::PARAM_INT);
            $query->bindParam(':status_id', $data->status->id, PDO::PARAM_INT);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            
            $connection->commit();
            return $id;                
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
            DELETE FROM access 
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