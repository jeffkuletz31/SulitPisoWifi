<?php
        if( isset( $_POST['ip'] ) && isset ( $_POST['mac'] ) ) {
                $ip = $_POST['ip'];
                $mac = $_POST['mac'];

                exec("sudo iptables -t nat -C PREROUTING -p tcp -s " . $ip ." -j RETURN", $output, $return);
                if (!$return) echo var_dump($output);
                else exec("sudo iptables -t nat -I PREROUTING -p tcp -s " . $ip ." -j RETURN");

                exec( "sudo iptables -t nat -C PREROUTING -p udp -s " . $ip ." -j RETURN", $output, $return);
                if (!$return) echo var_dump($output);
                else exec("sudo iptables -t nat -I PREROUTING -p udp -s " . $ip ." -j RETURN");

                exec( "sudo iptables -t nat -C POSTROUTING -s " . $ip . " -j MASQUERADE", $output, $return);
                if (!$return) echo var_dump($output);
                else exec("sudo iptables -t nat -I POSTROUTING -s " . $ip . " -j MASQUERADE");
                // OK, redirection bypassed.
                // Show the logged in message or directly redirect to other website
                echo "authentication successful...";
        } else {
                echo "authentication failed...";
        }
        header("refresh:1;url=http://sulitpisowifi.net/index.php/");
?>







