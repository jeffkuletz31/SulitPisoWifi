<?php

    Flight::map('remoteIp', function() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    });

 
    Flight::map('serverIp', function() {
        // server ip address 
        $ip = $_SERVER['SERVER_ADDR']; 
        return $ip;
    });

    Flight::map('mac', function($ip) {
        try{
            // this is the path to the arp command used to get user MAC address
            // from it's IP address in linux environment.
            $arp = "/usr/sbin/arp"; // execute the arp command to get their mac address
            $mac = shell_exec("sudo $arp -n " . $ip);
            preg_match('/..:..:..:..:..:../', $mac , $matches);
            if ($matches === NULL) return NULL;
            $mac = $matches[0];
            // if MAC Address couldn't be identified.
            // if( $mac === NULL)
            return $mac;
        } catch (Exception $exception){
            return NULL;
        }
    });

    Flight::map('memUsage', function() {
        $free = shell_exec('free');
        $free = (string)trim($free);
        $free_arr = explode("\n", $free);
        $mem = explode(" ", $free_arr[1]);
        $mem = array_filter($mem);
        $mem = array_merge($mem);
        $memory_usage = $mem[2] / $mem[1]*100;
        $memory_usage = round($memory_usage, 2);
        return $memory_usage;
    });

    Flight::map('cpuUsage', function() {
        $load = sys_getloadavg();
        return $load[0];
    });



    Flight::map('jsonError', function() {
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
            return 'No json object or object is empty.';
            case JSON_ERROR_DEPTH:
            return 'Maximum stack depth exceeded.';
            case JSON_ERROR_STATE_MISMATCH:
            return 'Underflow or the modes mismatch.';
            case JSON_ERROR_CTRL_CHAR:
            return 'Unexpected control character found.';
            case JSON_ERROR_SYNTAX:
            return 'Syntax error, malformed JSON.';
            case JSON_ERROR_UTF8:
            return 'Malformed UTF-8 characters, possibly incorrectly encoded.';
            default:
            return 'Unknown error.';
        }
    });


?>