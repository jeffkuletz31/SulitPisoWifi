<html>
    <head>
        <title>PHP Test</title>
    </head>
    <body>
        <?php
                // capture their IP address
                $ip = $_SERVER['REMOTE_ADDR'];
                // this is the path to the arp command used to get user MAC address
                // from it's IP address in linux environment.
                $arp = "/usr/sbin/arp"; // execute the arp command to get their mac address
                $mac = shell_exec("sudo $arp -n " . $ip);
                preg_match('/..:..:..:..:..:../',$mac , $matches);
                $mac = $matches[0];
                // if MAC Address couldn't be identified.
                echo $mac;
                if( $mac === NULL) {
                        echo "Access Denied.";
                        exit;
                }
        ?>

        <form method="post" action="process.php">
                <input type="text" name="mac" value="<?php echo $mac; ?>" />
                <input type="text" name="ip" value="<?php echo $ip; ?>" />
                <input type="submit" value="OK" style="padding:10px 20px;" />
        </form>

    </body>
</html>


