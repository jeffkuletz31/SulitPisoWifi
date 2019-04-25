Note : 
        This is base on Adam tretos53 https://github.com/tretos53
        I just added some stuffs that i needed.
        

Below script will create an open wifi network and when you connect to it, it will automatically open the browser. Make sure you don't have the internet on your device you are connecting it from. This is originally desinged to only provide local website from the RPI.

The script also installs php incase you need it.

Tested on, without updating the system first, 2018-11-13-raspbian-stretch-lite.zip

Flash microsd card with etcher

Put an empty file called ssh with no extension onto the boot partition, this will enable ssh at first boot. No need for screen and keyboard.

Connect Pi to the ethernet network and boot.

Connect to the SSH and run below command. You can get the IP address from IP scanner.

sudo -i
curl -H 'Cache-Control: no-cache' -sSL https://raw.githubusercontent.com/rhalf/SulitPisoWifi/master/install.sh | sudo bash $0