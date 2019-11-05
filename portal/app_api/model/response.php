<?php
class Response {
    public $method = null;			//GET, POST, PUT, DELETE, OPTION
    public $fault = null;       

	//method
	const GET = 'GET';
	const POST = 'POST';
	const PUT = 'PUT';
	const DELETE = 'DELETE';

	
	public function __construct(){

	}
}
?>