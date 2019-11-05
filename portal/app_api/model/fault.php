<?php
class Fault {
    public $code;       		
    public $message;    	
	public $line;		
	public $file;	

	public function __construct(){
    }
    
    public static function parse(Exception $exception) {
        $error = new Fault();
        $error->code = $exception->getCode();       		
        $error->message = $exception->getMessage();       	
        $error->line = $exception->getLine();       		
        $error->file = $exception->getFile();
        return $error;      
    }
}
?>