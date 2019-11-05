<?php
class Remote {
	
	public $ip;
	public $mac;
    public $browser;
    
	public function __construct() {
		$this->ip = Flight::remoteIp();
		$this->mac = Flight::mac($this->ip);
		$this->browser = new Browser();
	}

	public static function selectAll() {
		try {
			$remote = new Remote();
			$result = array();
			array_push($result, $remote);
			return $result;
		} catch (Exception $exception) {
			throw $exception;
		}
	}

	public static function select($id) {
		try {
			$remote = new Remote();
			$result = $remote;
			return $result;
		} catch (Exception $exception) {
			throw $exception;
		}
	}
}
?>