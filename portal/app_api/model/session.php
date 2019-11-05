<?php
class Session {
    public $id;
    public $dtStarted;
    public $dtEnded;
    public $access;
    public $client;
    public $status;

    public function __construct() {
    }

    public static function selectAll() {
        $connection = Flight::dbMain();
        try {
            $sql = "SELECT * FROM session;";
            $query = $connection->prepare($sql);
            $query->execute();
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = array();
            foreach ($rows as $row) {	
                $data = new Session();
                $data->id = (int) $row['id'];
                $data->dtStarted = (int) $row['session_dt_started'];
                $data->dtEnded = (int) $row['session_dt_ended'];
                $data->access = Access::select($row['access_id']);
                $data->client = Client::select($row['client_id']);
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
            
            $sql = "SELECT * FROM session WHERE id = :id;";
            $query = $connection->prepare($sql);
            $query->bindParam(':id',$id, PDO::PARAM_INT);
            $query->execute();
            
            if ($query->rowCount() == 0) { throw new Exception("id dont exist"); }
            $row = $query->fetch(PDO::FETCH_ASSOC);

            $data = new Session();
            $data->id = (int) $row['id'];
            $data->dtStarted = (int) $row['session_dt_started'];
            $data->dtEnded = (int) $row['session_dt_ended'];
            $data->access = Access::select($row['access_id']);
            $data->client = Client::select($row['client_id']);
            $data->status = Status::select($row['status_id']);

            return  $data;                
        } catch (Exception $exception) {
            throw $exception;
        } finally {
            $connection = null;
        }
    }

    public static function selectByClient($client) {
        $connection = Flight::dbMain();
        try {
            if ($client == null) { throw new Exception("client is null"); }
            
            $sql = "SELECT * FROM session WHERE client_id = :client_id;";
            $query = $connection->prepare($sql);
            $query->bindParam(':client_id',$client, PDO::PARAM_INT);
            $query->execute();
            
            if ($query->rowCount() == 0) { throw new Exception("client_id dont exist"); }
            $row = $query->fetch(PDO::FETCH_ASSOC);

            $data = new Session();
            $data->id = (int) $row['id'];
            $data->dtStarted = (int) $row['session_dt_started'];
            $data->dtEnded = (int) $row['session_dt_ended'];
            $data->access = Access::select($row['access_id']);
            $data->client = Client::select($row['client_id']);
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
        $connection->beginSession();
        try {
            if ($data == null) { throw new Exception(Flight::jsonError()); }

            $sql = "
            INSERT INTO session (
                session_dt_started, 
                session_dt_ended, 
                access_id, 
                client_id, 
                status_id)
            VALUES (
                :session_dt_started, 
                :session_dt_ended, 
                :access_id, 
                :client_id, 
                :status_id);";
            
            $query = $connection->prepare($sql);
            $query->bindParam(':session_dt_started', $data->dtStarted, PDO::PARAM_INT);
            $query->bindParam(':session_dt_ended', $data->dtEnded, PDO::PARAM_INT);
            $query->bindParam(':access_id',$data->access->id, PDO::PARAM_INT);
            $query->bindParam(':client_id', $data->client->id, PDO::PARAM_INT);
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
        $connection->beginSession();
        try {
            $data = json_decode(file_get_contents("php://input"));
            if ($data == null) { throw new Exception(Flight::jsonError()); }
            if ($id == null) { throw new Exception("id is null"); }
            
            $sql = "
            UPDATE session 
            SET 
            session_dt_started = :session_dt_started, 
            session_dt_ended = :session_dt_ended, 
            access_id = :access_id, 
            client_id = :client_id, 
            status_id = :status_id, 
            status_id = :status_id
            WHERE
            id = :id;";
            
            $query = $connection->prepare($sql);
            
            $query->bindParam(':session_dt_started', $data->dtStarted, PDO::PARAM_INT);
            $query->bindParam(':session_dt_ended', $data->dtEnded, PDO::PARAM_INT);
            $query->bindParam(':access_id', $data->access->id, PDO::PARAM_INT);
            $query->bindParam(':client_id', $data->client->id, PDO::PARAM_INT);
            $query->bindParam(':status_id', $data->status->id, PDO::PARAM_INT);

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
        $connection->beginSession();

        try {
            if ($id == null) { throw new Exception("id is null"); }

            $sql = "
            DELETE FROM session 
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

