<?php
class Response {
	public $status = null;			//SUCCESS, ERROR, PROHIBITED
	public $data = null;       

    public $fault = null;       

	const SUCCESS = 'SUCCESS';
	const ERROR = 'ERROR';
	const PROHIBITED = 'PROHIBITED';
	
	public function __construct(){

	}
}
?>