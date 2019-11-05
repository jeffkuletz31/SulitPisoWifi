<?php
class Client {
    public $id;
    public $dtLogged;
    public $name;
    public $ip;
    public $mac;
    public $status;

    public function __construct() {
    }

    public static function selectAll() {
        $connection = Flight::dbMain();
        try {
            $sql = "SELECT * FROM client;";
            $query = $connection->prepare($sql);
            $query->execute();
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);
            $result = array();
            foreach ($rows as $row) {	
                $data = new Client();
                $data->id = (int) $row['id'];
                $data->dtLogged = (int) $row['client_dt_logged'];
                $data->name = $row['client_name'];
                $data->ip = $row['client_ip'];
                $data->mac = $row['client_mac'];
                $data->browser = new Browser();
                $data->browser->name = $row['client_browser_name'];
                $data->browser->platform = $row['client_browser_platform'];
                $data->browser->agent = $row['client_browser_agent'];
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
            
            $sql = "SELECT * FROM client WHERE id = :id;";
            $query = $connection->prepare($sql);
            $query->bindParam(':id',$id, PDO::PARAM_INT);
            $query->execute();
            
            if ($query->rowCount() == 0) { throw new Exception("id dont exist"); }
            $row = $query->fetch(PDO::FETCH_ASSOC);

            $data = new Client();
            $data->id = (int) $row['id'];
            $data->dtLogged = (int) $row['client_dt_logged'];
            $data->name = $row['client_name'];
            $data->ip = $row['client_ip'];
            $data->mac = $row['client_mac'];
            $data->browser = new Browser();
            $data->browser->name = $row['client_browser_name'];
            $data->browser->platform = $row['client_browser_platform'];
            $data->browser->agent = $row['client_browser_agent'];
            $data->status = Status::select($row['status_id']);

            return  $data;                
        } catch (Exception $exception) {
            throw $exception;
        } finally {
            $connection = null;
        }
    }
    
    public static function selectByMac($mac) {
        $connection = Flight::dbMain();
        try {
            if ($mac == null) { throw new Exception("mac is null"); }
            
            $sql = "SELECT * FROM client WHERE client_mac = :client_mac;";
            $query = $connection->prepare($sql);
            $query->bindParam(':client_mac',$mac, PDO::PARAM_STR);
            $query->execute();
            
            if ($query->rowCount() == 0) { throw new Exception("mac dont exist"); }
            $row = $query->fetch(PDO::FETCH_ASSOC);

            $data = new Client();
            $data->id = (int) $row['id'];
            $data->dtLogged = (int) $row['client_dt_logged'];
            $data->name = $row['client_name'];
            $data->ip = $row['client_ip'];
            $data->mac = $row['client_mac'];
            $data->browser = new Browser();
            $data->browser->name = $row['client_browser_name'];
            $data->browser->platform = $row['client_browser_platform'];
            $data->browser->agent = $row['client_browser_agent'];
            $data->status = Status::select($row['status_id']);

            return  $data;                
        } catch (Exception $exception) {
            throw $exception;
        } finally {
            $connection = null;
        }
    }

    public static function selectByIpMac($ip, $mac) {
        $connection = Flight::dbMain();
        try {
            if ($ip == null) { throw new Exception("ip is null"); }
            if ($mac == null) { throw new Exception("mac is null"); }
            
            $sql = "SELECT * FROM client WHERE client_ip = :client_ip and  client_mac = :client_mac;";
            $query = $connection->prepare($sql);
            $query->bindParam(':client_ip',$ip, PDO::PARAM_STR);
            $query->bindParam(':client_mac',$mac, PDO::PARAM_STR);
            $query->execute();
            
            if ($query->rowCount() == 0) { throw new Exception("ip and mac matching dont exist"); }
            $row = $query->fetch(PDO::FETCH_ASSOC);

            $data = new Client();
            $data->id = (int) $row['id'];
            $data->dtLogged = (int) $row['client_dt_logged'];
            $data->name = $row['client_name'];
            $data->ip = $row['client_ip'];
            $data->mac = $row['client_mac'];
            $data->browser = new Browser();
            $data->browser->name = $row['client_browser_name'];
            $data->browser->platform = $row['client_browser_platform'];
            $data->browser->agent = $row['client_browser_agent'];
            $data->status = Status::select($row['status_id']);

            return  $data;                
        } catch (Exception $exception) {
            throw $exception;
        } finally {
            $connection = null;
        }
    }

    public static function selectByIp($ip) {
        $connection = Flight::dbMain();
        try {
            if ($ip == null) { throw new Exception("ip is null"); }
            
            $sql = "SELECT * FROM client WHERE client_ip = :client_ip;";
            $query = $connection->prepare($sql);
            $query->bindParam(':client_ip',$ip, PDO::PARAM_STR);
            $query->execute();
            
            if ($query->rowCount() == 0) { throw new Exception("ip dont exist"); }
            $row = $query->fetch(PDO::FETCH_ASSOC);

            $data = new Client();
            $data->id = (int) $row['id'];
            $data->dtLogged = (int) $row['client_dt_logged'];
            $data->name = $row['client_name'];
            $data->ip = $row['client_ip'];
            $data->mac = $row['client_mac'];
            $data->browser = new Browser();
            $data->browser->name = $row['client_browser_name'];
            $data->browser->platform = $row['client_browser_platform'];
            $data->browser->agent = $row['client_browser_agent'];
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
            INSERT INTO client (
                client_dt_logged, 
                client_name, 
                client_ip, 
                client_mac, 
                client_browser_name, 
                client_browser_platform, 
                client_browser_agent, 
                status_id)
            VALUES (
                :client_dt_logged, 
                :client_name, 
                :client_ip, 
                :client_mac, 
                :client_browser_name, 
                :client_browser_platform, 
                :client_browser_agent,
                :status_id);";
                
            $time = time();
            $query = $connection->prepare($sql);
            $query->bindParam(':client_dt_logged', $time , PDO::PARAM_INT);
            $query->bindParam(':client_name', $data->name, PDO::PARAM_STR);
            $query->bindParam(':client_ip', $data->ip, PDO::PARAM_STR);
            $query->bindParam(':client_mac',$data->mac, PDO::PARAM_STR);
            $query->bindParam(':client_browser_name', $data->browser->name, PDO::PARAM_STR);
            $query->bindParam(':client_browser_platform', $data->browser->platform, PDO::PARAM_STR);
            $query->bindParam(':client_browser_agent', $data->browser->agent, PDO::PARAM_STR);
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
            $data = json_decode(file_get_contents("php://input"));
            if ($data == null) { throw new Exception(Flight::jsonError()); }
            if ($id == null) { throw new Exception("id is null"); }
            
            $sql = "
            UPDATE client 
            SET 
            client_dt_logged = :client_dt_logged, 
            client_name = :client_name, 
            client_ip = :client_ip, 
            client_mac = :client_mac, 
            client_browser_name = :client_browser_name, 
            client_browser_platform = :client_browser_platform, 
            client_browser_agent = :client_browser_agent,
            status_id = :status_id
            WHERE
            id = :id;";
            $query = $connection->prepare($sql);
            $query->bindParam(':client_dt_logged', $data->dtLogged, PDO::PARAM_INT);
            $query->bindParam(':client_name', $data->name, PDO::PARAM_STR);
            $query->bindParam(':client_ip', $data->ip, PDO::PARAM_STR);
            $query->bindParam(':client_mac',$data->mac, PDO::PARAM_STR);
            $query->bindParam(':client_browser_name', $data->browser->name, PDO::PARAM_STR);
            $query->bindParam(':client_browser_platform', $data->browser->platform, PDO::PARAM_STR);
            $query->bindParam(':client_browser_agent', $data->browser->agent, PDO::PARAM_STR);
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
            DELETE FROM client 
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

