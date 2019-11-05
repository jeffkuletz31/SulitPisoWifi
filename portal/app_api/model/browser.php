<?php

class Browser {
    
    public $name;
    public $agent;
    public $platform;

    public function __construct(){

        $agent = $_SERVER['HTTP_USER_AGENT'];
        $name = 'unknown';
        $userBrowser = "unknown";
        $platform = 'unknown';
    
        //First get the platform?
        if (preg_match('/linux/i', $agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $agent)) {
            $platform = 'windows';
        }
    
        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i', $agent) && !preg_match('/Opera/i', $agent)) {
            $name = 'Internet Explorer';
            $userBrowser = "MSIE";
        } elseif(preg_match('/Firefox/i', $agent)) {
            $name = 'Mozilla Firefox';
            $userBrowser = "Firefox";
        } elseif (preg_match('/Chrome/i', $agent)) {
            $name = 'Google Chrome';
            $userBrowser = "Chrome";
        } elseif (preg_match('/Safari/i', $agent)) {
            $name = 'Apple Safari';
            $userBrowser = "Safari";
        } elseif (preg_match('/Opera/i', $agent)) {
            $name = 'Opera';
            $userBrowser = "Opera";
        } elseif (preg_match('/Netscape/i', $agent)) {
            $name = 'Netscape';
            $userBrowser = "Netscape";
        }

        $this->agent = $agent;
        $this->name = $name;
        $this->platform = $platform;
    }
}
?>