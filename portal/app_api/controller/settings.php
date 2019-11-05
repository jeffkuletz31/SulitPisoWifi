<?php
    ini_set('memory_limit', '256M');
    date_default_timezone_set('UTC');

    Flight::register('dbMain', 'PDO', array('mysql:host=127.0.0.1;dbname=spw_db','root','123456'), function($dbMain){
        $dbMain->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbMain->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
    });
?>