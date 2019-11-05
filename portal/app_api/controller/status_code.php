<?php

    Flight::map('preFlight', function() {
        Flight::response()
        ->status(200)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Headers', 'content-type,x-requested-with,x-api-key,X-ACCOUNT-API-KEY,X-USER-API-KEY,account_api_key,user_api_key')
        ->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS')
        ->send();
    });

    //ok
    Flight::map('success', function($result) {
        Flight::result(200, $result);
    });
    //created 201
    Flight::map('created', function($result){
        Flight::result(201, $result);
    });
    //noContent 204
    Flight::map('noContent', function($result){
    	Flight::result(204, $result);
    });
    //bad request 400
    Flight::map('badRequest', function($result){
        Flight::result(400, $result);
    });
    //unauthorized 401
    Flight::map('unauthorized', function($result){
        Flight::result(401, $result);
    });
    //forbidden 403
    Flight::map('forbidden', function($result){
        Flight::result(403, $result);
    });
    //notFound 404
    Flight::map('notFound', function($result){
        Flight::result(404, $result);
    });
    //error 501
    Flight::map('error', function($result){
        Flight::result(501, $result);
    });

    Flight::map('result', function($status, $result) {
        Flight::response()
        ->status($status)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Headers', 'content-type,x-requested-with,x-api-key,X-ACCOUNT-API-KEY,X-USER-API-KEY,account_api_key,user_api_key')
        ->header('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS')
        ->header('Content-Type', 'application/json')
        ->header('Expires', '0')
        ->header('Last-Modified', gmdate("D, d M Y H:i:s") . " GMT")
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->write(json_encode($result))
        ->send();
    });

?>
