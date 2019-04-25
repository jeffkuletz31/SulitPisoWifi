<?php
        // get the user IP address from the query string
        $ip = $_POST['ip'];
        // this is the path to the arp command used to get user MAC address
        // from it's IP address in linux environment.
        $arp = "/usr/sbin/arp";
        // execute the arp command to get their mac address
        $mac = shell_exec("sudo $arp -n " . $ip);
        preg_match('/..:..:..:..:..:../',$mac , $matches);
        $mac = @$matches[0];
        // if MAC Address couldn't be identified.
        if( $mac === NULL) {
                echo "Error: Can't retrieve user's MAC address.";
                exit;
        }

        exec("sudo iptables -t nat -D POSTROUTING -s " . $ip . " -j MASQUERADE");
        // remove their connection track if any
        echo "kickin' successful.";
?>





