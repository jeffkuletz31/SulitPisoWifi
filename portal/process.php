<?php
        if( isset( $_POST['ip'] ) && isset ( $_POST['mac'] ) ) {
                $ip = $_POST['ip'];
                $mac = $_POST['mac'];
                exec("sudo iptables -I internet 1 -t mangle -m mac --mac-source $mac -j RETURN");
                //exec("iptables -t nat -A POSTROUTING -s " . $ip . " -j MASQUERADE");
                exec("sudo rmtrack " . $ip);
                sleep(1);
                // allowing rmtrack to be executed
                // OK, redirection bypassed.
                // Show the logged in message or directly redirect to other website
                echo "User logged in.";
        } else {
                echo "Access Denied";
        }
?>


