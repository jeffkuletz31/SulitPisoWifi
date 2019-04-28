<?php
        // get the user IP address from the query string
        if (isset($_POST['ip']) && isset($_POST['mac'])) {
                $ip = $_POST['ip'];
                $mac = $_POST['mac'];

                $command = "sudo iptables -t nat -C PREROUTING -p tcp -s " . $ip ." -j RETURN";
                while(1) {
                        exec($command, $output, $return);
                        if (!$return) echo var_dump($output);
                        else break;
                        exec("sudo iptables -t nat -D PREROUTING -p tcp -s " . $ip ." -j RETURN");
                }


                $command = "sudo iptables -t nat -C PREROUTING -p udp -s " . $ip ." -j RETURN";
                while(1) {
                        exec($command, $output, $return);
                        if (!$return) echo var_dump($output);
                        else break;
                        exec("sudo iptables -t nat -D PREROUTING -p udp -s " . $ip ." -j RETURN");
                }


                $command = "sudo iptables -t nat -C POSTROUTING -s " . $ip . " -j MASQUERADE";
                while (1) {
                        exec($command, $output, $return);
                        if (!$return) echo var_dump($output);
                        else break;
                        exec("sudo iptables -t nat -D POSTROUTING -s " . $ip . " -j MASQUERADE");
                }

                echo "authentication removing successful...";

        } else {
                echo "authentication removing failed...";
        }
        header("refresh:3;url=http://sulitpisowifi.net/index.php/");
?>


