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
    try {
        $request = Flight::request();
        $data = json_decode($request->getBody());
        $result = null;
        if ($request->method == 'GET') {
            if ($id) { $result = Server::select($id); }
            else { $result = Server::selectAll(); }
        }  elseif ($request->method == Response::POST) {
            throw new Exception("post method not implemented");
        } elseif ($request->method == Response::PUT) {
            throw new Exception("put method not implemented");
        } elseif ($request->method == Response::DELETE) {
            throw new Exception("delete method not implemented");
        }
        Flight::success($result);
    } catch (Exception $exception){
        $response = new Response();
        $response->method = $request->method;
        $response->fault = Fault::parse($exception);    
        Flight::error($response);   		
    }
});
// remote
Flight::route('GET|POST|PUT|DELETE /remote(/@id)', function($id){
    try {
        $request = Flight::request();
        $data = json_decode($request->getBody());
        $result = null;
        if ($request->method == 'GET') {
            if ($id) { $result = Remote::select($id); }
            else { $result = Remote::selectAll(); }
        }  elseif ($request->method == Response::POST) {
            throw new Exception("post method not implemented");
        } elseif ($request->method == Response::PUT) {
            throw new Exception("put method not implemented");
        } elseif ($request->method == Response::DELETE) {
            throw new Exception("delete method not implemented");
        }
        Flight::success($result);
    } catch (Exception $exception){
        $response = new Response();
        $response->method = $request->method;
        $response->fault = Fault::parse($exception);
        Flight::error($response);
    }
});
// status
Flight::route('GET|POST|PUT|DELETE /status(/@id)', function($id){
    try {
        $request = Flight::request();
        $data = json_decode($request->getBody());
        $result = null;
        if ($request->method == 'GET') {
            if ($id) { $result = Status::select($id); }
            else { $result = Status::selectAll(); }
        }  elseif ($request->method == Response::POST) {
            throw new Exception("post method not implemented");
        } elseif ($request->method == Response::PUT) {
            throw new Exception("put method not implemented");
        } elseif ($request->method == Response::DELETE) {
            throw new Exception("delete method not implemented");
        }
        Flight::success($result);
    } catch (Exception $exception){
        $response = new Response();
        $response->method = $request->method;
        $response->fault = Fault::parse($exception);
        Flight::error($response);
    }
});

// access
Flight::route('GET|POST|PUT|DELETE /access(/@id)', function($id){
    try {
        $request = Flight::request();
        $data = json_decode($request->getBody());
        $result = null;
        $code = $request->query['code'];
        if ($request->method == Response::GET) {
            if ($id) { $result = Access::select($id); }
            elseif ($code) { $result = Access::selectByCode($code); }
            else { $result = Access::selectAll(); }
        } elseif ($request->method == Response::POST) {
            $result = Access::insert($access);
        } elseif ($request->method == Response::PUT) {
            $result = Access::update($id, $access);
        } elseif ($request->method == Response::DELETE) {
            $result = Access::delete($id);
        }
        Flight::success($result);
    } catch (Exception $exception){
        $response = new Response();
        $response->method = $request->method;
        $response->fault = Fault::parse($exception);
        Flight::error($response);
    }
});


// access_type
Flight::route('GET|POST|PUT|DELETE /access_type(/@id)', function($id){
    try {
        $request = Flight::request();
        $data = json_decode($request->getBody());
        $result = null;
        if ($request->method == Response::GET) {
            if ($id) { $result = AccessType::select($id); } 
            else { $result = AccessType::selectAll(); }
        } elseif ($request->method == Response::POST) {
            throw new Exception("post method not implemented");
        } elseif ($request->method == Response::PUT) {
            throw new Exception("put method not implemented");
        } elseif ($request->method == Response::DELETE) {
            throw new Exception("delete method not implemented");
        }
        Flight::success($result);
    } catch (Exception $exception){
        $response = new Response();
        $response->method = $request->method;
        $response->fault = Fault::parse($exception);
        Flight::error($response);
    }
});

//client
Flight::route('GET|POST|PUT|DELETE /client(/@id)', function($id){
    try {
        $request = Flight::request();
        $data = json_decode($request->getBody());
        $result = null;
        $ip = $request->query['ip'];
        $mac = $request->query['mac'];
        if ($request->method == Response::GET) {
            if ($id) { 
                $result = Client::select($id); 
            } elseif ($ip && $mac) { 
                $result = Client::selectByIpMac($ip, $mac); 
            } elseif ($ip) { 
                $result = Client::selectByIp($ip); 
            } elseif ($mac) { 
                $result = Client::selectByMac($mac); 
            } else { 
                $result = Client::selectAll(); 
            }
        } elseif ($request->method == Response::POST) {
            $result = Client::insert($data);
        } elseif ($request->method == Response::PUT) {
            $result = Client::update($id, $data);
        } elseif ($request->method == Response::DELETE) {
            $result = Client::delete($id);
        }
        Flight::success($result);
    } catch (Exception $exception){
        $response = new Response();
        $response->method = $request->method;
        $response->fault = Fault::parse($exception);
        Flight::error($response);
    }
});

//transaction
Flight::route('GET|POST|PUT|DELETE /transaction(/@id)', function($id){
    try {
        $request = Flight::request();
        $data = json_decode($request->getBody());
        $result = null;
        if ($request->method == Response::GET) {
            if ($id) { $result = Transaction::select($id); }
            else { $result = Transaction::selectAll(); }
        } elseif ($request->method == Response::POST) {
            $result = Transaction::insert($data);
        } elseif ($request->method == Response::PUT) {
            $result = Transaction::update($id, $data);
        } elseif ($request->method == Response::DELETE) {
            $result = Transaction::delete($id);
        }
        Flight::success($result);
    } catch (Exception $exception){
        $response = new Response();
        $response->method = $request->method;
        $response->fault = Fault::parse($exception);
        Flight::error($response);
    }
});

//session
Flight::route('GET|POST|PUT|DELETE /session(/@id)', function($id){
    try {
        $request = Flight::request();
        $data = json_decode($request->getBody());
        $result = null;
        $client = $request->query['client'];
        if ($request->method == Response::GET) {
            if ($id) { 
                $result = Transaction::select($id); 
            } elseif ($client) { 
                $result = Transaction::selectByClient($client); 
            } else { 
                $result = Transaction::selectAll(); 
            }
        } elseif ($request->method == Response::POST) {
            $result = Session::insert($data);
        } elseif ($request->method == Response::PUT) {
            $result = Session::update($id, $data);
        } elseif ($request->method == Response::DELETE) {
            $result = Session::delete($id);
        }
        Flight::success($result);
    } catch (Exception $exception){
        $response = new Response();
        $response->method = $request->method;
        $response->fault = Fault::parse($exception);
        Flight::error($response);
    }
});

//user
Flight::route('GET|POST|PUT|DELETE /user(/@id)', function($id){
    try {
        $request = Flight::request();
        $data = json_decode($request->getBody());
        $result = null;
        if ($request->method == Response::GET) {
            if ($id) { $result = User::select($id); }
            else { $result = User::selectAll(); }
        } elseif ($request->method == Response::POST) {
            $result = User::insert($data);
        } elseif ($request->method == Response::PUT) {
            $result = User::update($id, $data);
        } elseif ($request->method == Response::DELETE) {
            $result = User::delete($id);
        }
        Flight::success($result);
    } catch (Exception $exception){
        $response = new Response();
        $response->method = $request->method;
        $response->fault = Fault::parse($exception);
        Flight::error($response);
    }
});

//preference
Flight::route('GET|POST|PUT|DELETE /preference(/@id)', function($id){
    try {
        $request = Flight::request();
        $data = json_decode($request->getBody());
        $result = null;
        if ($request->method == Response::GET) {
            if ($id) { $result = Preference::select($id); }
            else { $result = Preference::selectAll(); }
        } elseif ($request->method == Response::POST) {
            $result = Preference::insert($data);
        } elseif ($request->method == Response::PUT) {
            $result = Preference::update($id, $data);
        } elseif ($request->method == Response::DELETE) {
            $result = Preference::delete($id);
        }
        Flight::success($result);
    } catch (Exception $exception){
        $response = new Response();
        $response->method = $request->method;
        $response->fault = Fault::parse($exception);
        Flight::error($response);
    }
});
Flight::start();
?>