<?php

class Server {
	
	public $ip;
	public $mac;

	public $memUsage;
	public $cpuUsage;

	public $dateTime;
	public $upTime;


	public function __construct() {
		$this->ip = Flight::serverIp();
		$this->mac = Flight::mac($this->ip);

		$this->memUsage = Flight::memUsage();
		$this->cpuUsage = Flight::cpuUsage();
		
		$this->dateTime = new DTime();
		$this->upTime = new UTime();
	}

	public static function selectAll() {
		try {
			$server = new Server();
			$result = array();
			array_push($result, $server);
			return $result;
		} catch (Exception $exception) {
			throw $exception;
		}
	}

	public static function select($id) {
		try {
			$server = new Server();
			$result = $server;
			return $result;
		} catch (Exception $exception) {
			throw $exception;
		}
	}
}
?>