<?php
require_once('libs/flight/Flight.php');
require_once('controller/settings.php');
require_once('controller/functions.php');
require_once('controller/status_code.php');
require_once('controller/includes.php');

Flight::route('OPTIONS /*', function() {
	Flight::preFlight();
}, true);

Flight::route('GET /', function(){
    echo "Welcome to spw_api";
});

// server
Flight::route('GET|POST|PUT|DELETE /server(/@id)', function($id){
   
    $response = new Response();
    $response->status = Response::SUCCESS;
    $data = json_decode(Flight::request()->getBody());

    try {
        if (Flight::request()->method == 'GET') {
            if ($id) { $response->data = Server::select($id); }
            else { $response->data = Server::selectAll(); }
        }  elseif (Flight::request()->method == 'POST') {
            throw new Exception("post method not implemented");
        } elseif (Flight::request()->method == 'PUT') {
            throw new Exception("put method not implemented");
        } elseif (Flight::request()->method == 'DELETE') {
            throw new Exception("delete method not implemented");
        }
    } catch (Exception $exception){
        $response->fault = Fault::parse($exception);    	
        $response->status = Response::ERROR;
    }

    Flight::success($response);
});
// remote
Flight::route('GET|POST|PUT|DELETE /remote(/@id)', function($id){
    $response = new Response();
    $response->status = Response::SUCCESS;
    $data = json_decode(Flight::request()->getBody());

    try {
        if (Flight::request()->method == 'GET') {
            if ($id) { $response->data = Remote::select($id); }
            else { $response->data = Remote::selectAll(); }
        }  elseif (Flight::request()->method == 'POST') {
            throw new Exception("post method not implemented");
        } elseif (Flight::request()->method == 'PUT') {
            throw new Exception("put method not implemented");
        } elseif (Flight::request()->method == 'DELETE') {
            throw new Exception("delete method not implemented");
        }
    } catch (Exception $exception){
        $response->fault = Fault::parse($exception);    	
        $response->status = Response::ERROR;
    }

    Flight::success($response);
});
// status
Flight::route('GET|POST|PUT|DELETE /status(/@id)', function($id){
    $response = new Response();
    $response->status = Response::SUCCESS;
    $data = json_decode(Flight::request()->getBody());

    try {
        if (Flight::request()->method == 'GET') {
            if ($id) { $response->data = Status::select($id); }
            else { $response->data = Status::selectAll(); }
        }  elseif (Flight::request()->method == 'POST') {
            throw new Exception("post method not implemented");
        } elseif (Flight::request()->method == 'PUT') {
            throw new Exception("put method not implemented");
        } elseif (Flight::request()->method == 'DELETE') {
            throw new Exception("delete method not implemented");
        }
    } catch (Exception $exception){
        $response->fault = Fault::parse($exception);    	
        $response->status = Response::ERROR;
    }

    Flight::success($response);
});

// access
Flight::route('GET|POST|PUT|DELETE /access(/@id)', function($id){
    $response = new Response();
    $response->status = Response::SUCCESS;
    $data = json_decode(Flight::request()->getBody());
    $code = Flight::request()->query['code'];

    try {
        if (Flight::request()->method == 'GET') {
            if ($id) { $response->data = Access::select($id); }
            elseif ($code) { $response->data = Access::selectByCode($code); }
            else { $response->data = Access::selectAll(); }
        } elseif (Flight::request()->method == 'POST') {
            $response->data = Access::insert($access);
        } elseif (Flight::request()->method == 'PUT') {
            $response->data = Access::update($id, $access);
        } elseif (Flight::request()->method == 'DELETE') {
            $response->data = Access::delete($id);
        }
    } catch (Exception $exception){
        $response->fault = Fault::parse($exception);    	
        $response->status = Response::ERROR;
    }

    Flight::success($response);
});


// access_type
Flight::route('GET|POST|PUT|DELETE /access_type(/@id)', function($id){
    $response = new Response();
    $response->status = Response::SUCCESS;
    $data = json_decode(Flight::request()->getBody());
    
    try {
        if (Flight::request()->method == 'GET') {
            if ($id) { $response->data = AccessType::select($id); } 
            else { $response->data = AccessType::selectAll(); }
        } elseif (Flight::request()->method == 'POST') {
            throw new Exception("post method not implemented");
        } elseif (Flight::request()->method == 'PUT') {
            throw new Exception("put method not implemented");
        } elseif (Flight::request()->method == 'DELETE') {
            throw new Exception("delete method not implemented");
        }
        
    } catch (Exception $exception){
        $response->fault = Fault::parse($exception);    	
        $response->status = Response::ERROR;
    }

    Flight::success($response);
});

//client
Flight::route('GET|POST|PUT|DELETE /client(/@id)', function($id){
    
    $response = new Response();
    $response->status = Response::SUCCESS;
    $data = json_decode(Flight::request()->getBody());
    $ip = Flight::request()->query['ip'];
    $mac = Flight::request()->query['mac'];

    try {
        if (Flight::request()->method == 'GET') {
            if ($id) { $response->data = Client::select($id); } 
            elseif ($ip && $mac) { $response->data = Client::selectByIpMac($ip, $mac); } 
            elseif ($ip) { $response->data = Client::selectByIp($ip); } 
            elseif ($mac) { $response->data = Client::selectByMac($mac); } 
            else { $response->data = Client::selectAll(); }
        } elseif (Flight::request()->method == 'POST') {
            $response->data = Client::insert($data);
        } elseif (Flight::request()->method == 'PUT') {
            $response->data = Client::update($id, $data);
        } elseif (Flight::request()->method == 'DELETE') {
            $response->data = Client::delete($id);
        }
    } catch (Exception $exception){
        $response->fault = Fault::parse($exception);    	
        $response->status = Response::ERROR;
    }

    Flight::success($response);
});

//transaction
Flight::route('GET|POST|PUT|DELETE /transaction(/@id)', function($id){
    $response = new Response();
    $response->status = Response::SUCCESS;
    $data = json_decode(Flight::request()->getBody());
    
    try {
        if (Flight::request()->method == 'GET') {
            if ($id) { $response->data = Transaction::select($id); }
            else { $response->data = Transaction::selectAll(); }
        } elseif (Flight::request()->method == 'POST') {
            $response->data = Transaction::insert($data);
        } elseif (Flight::request()->method == 'PUT') {
            $response->data = Transaction::update($id, $data);
        } elseif (Flight::request()->method == 'DELETE') {
            $response->data = Transaction::delete($id);
        }
    } catch (Exception $exception){
        $response->fault = Fault::parse($exception);    	
        $response->status = Response::ERROR;
    }

    Flight::success($response);
});

//session
Flight::route('GET|POST|PUT|DELETE /session(/@id)', function($id){
    $response = new Response();
    $response->status = Response::SUCCESS;
    $data = json_decode(Flight::request()->getBody());
    $client = Flight::request()->query['client'];
    try {
        if (Flight::request()->method == 'GET') {
            if ($id) { $response->data = Transaction::select($id); } 
            elseif ($client) { $response->data = Transaction::selectByClient($client); } 
            else { $response->data = Transaction::selectAll(); }
        } elseif (Flight::request()->method == 'POST') {
            $response->data = Session::insert($data);
        } elseif (Flight::request()->method == 'PUT') {
            $response->data = Session::update($id, $data);
        } elseif (Flight::request()->method == 'DELETE') {
            $response->data = Session::delete($id);
        }
    } catch (Exception $exception){
        $response->fault = Fault::parse($exception);    	
        $response->status = Response::ERROR;
    }

    Flight::success($response);
});

//user
Flight::route('GET|POST|PUT|DELETE /user(/@id)', function($id){
    $response = new Response();
    $response->status = Response::SUCCESS;
    $data = json_decode(Flight::request()->getBody());

    try {
        if (Flight::request()->method == 'GET') {
            if ($id) { $response->data = User::select($id); }
            else { $response->data = User::selectAll(); }
        } elseif (Flight::request()->method == 'POST') {
            $response->data = User::insert($data);
        } elseif (Flight::request()->method == 'PUT') {
            $response->data = User::update($id, $data);
        } elseif (Flight::request()->method == 'DELETE') {
            $response->data = User::delete($id);
        }
    } catch (Exception $exception){
        $response->fault = Fault::parse($exception);    	
        $response->status = Response::ERROR;
    }

    Flight::success($response);
});

//preference
Flight::route('GET|POST|PUT|DELETE /preference(/@id)', function($id){
    $response = new Response();
    $response->status = Response::SUCCESS;
    $data = json_decode(Flight::request()->getBody());
    try {
        if (Flight::request()->method == 'GET') {
            if ($id) { $response->data = Preference::select($id); }
            else { $response->data = Preference::selectAll(); }
        } elseif (Flight::request()->method == 'POST') {
            $response->data = Preference::insert($data);
        } elseif (Flight::request()->method == 'PUT') {
            $response->data = Preference::update($id, $data);
        } elseif (Flight::request()->method == 'DELETE') {
            $response->data = Preference::delete($id);
        }
        
    } catch (Exception $exception){
        $response->fault = Fault::parse($exception);    	
        $response->status = Response::ERROR;
    }

    Flight::success($response);
});
Flight::start();
?>