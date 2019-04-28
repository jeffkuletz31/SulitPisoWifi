#!/bin/bash

if [ "$EUID" -ne 0 ]
	then echo "Must be root, run sudo -i before running that script."
	exit
fi

echo "┌─────────────────────────────────────────"
echo "|This script might take a some time"
echo "|This will automatically reboot your system"
echo "└─────────────────────────────────────────"
read -p "Press enter to to continue"

echo "┌─────────────────────────────────────────"
echo "|Updating repositories"
echo "└─────────────────────────────────────────"
apt-get update -y

# echo "┌─────────────────────────────────────────"
# echo "|Upgrading packages"
# echo "└─────────────────────────────────────────"
# apt-get upgrade -yqq

echo "┌─────────────────────────────────────────"
echo "|Installing nginx"
echo "└─────────────────────────────────────────"
apt-get install nginx -y
echo "┌─────────────────────────────────────────"
echo "|Configuring nginx"
echo "└─────────────────────────────────────────"
wget -q https://raw.githubusercontent.com/rhalf/SulitPisoWifi/master/setup/default_nginx -O /etc/nginx/sites-enabled/default

echo "┌─────────────────────────────────────────"
echo "|Updating Visudo"
echo "└─────────────────────────────────────────"
echo  "www-data ALL=NOPASSWD: /usr/sbin/arp" >> /etc/sudoers
echo  "www-data ALL=NOPASSWD: /sbin/iptables" >> /etc/sudoers

echo "┌─────────────────────────────────────────"
echo "|Configuring dhcpcd"
echo "└─────────────────────────────────────────"
wget -q https://raw.githubusercontent.com/rhalf/SulitPisoWifi/master/setup/dhcpcd.conf -O /etc/dhcpcd.conf

echo "┌─────────────────────────────────────────"
echo "|Installing dnsmasq"
echo "└─────────────────────────────────────────"
apt-get install dnsmasq -y
echo "┌─────────────────────────────────────────"
echo "|Configuring dnsmasq"
echo "└─────────────────────────────────────────"
wget -q https://raw.githubusercontent.com/rhalf/SulitPisoWifi/master/setup/dnsmasq.conf -O /etc/dnsmasq.conf
echo "┌─────────────────────────────────────────"
echo "|configuring dnsmasq to start at boot"
echo "└─────────────────────────────────────────"
update-rc.d dnsmasq defaults

echo "┌─────────────────────────────────────────"
echo "|Flushing existing chain in iptables"
echo "└─────────────────────────────────────────"
iptables -F
iptables -X
iptables -F -t nat
iptables -X -t nat
iptables -F -t mangle
iptables -X -t mangle

echo "┌─────────────────────────────────────────"
echo "|Configuring iptables"
echo "└─────────────────────────────────────────"
iptables -t nat -A PREROUTING -s 192.168.100.0/24 -p tcp -m multiport --dports 80,443 -j DNAT --to-destination 192.168.100.1:80
iptables -t nat -A PREROUTING -s 192.168.100.0/24 -p tcp -j DNAT --to-destination 192.168.100.1
iptables -t nat -A PREROUTING -s 192.168.100.0/24 -p udp -j DNAT --to-destination 192.168.100.1
#iptables -t nat -I PREROUTING -p tcp -s 192.168.100.120 -j RETURN
#iptables -t nat -A POSTROUTING -s 192.168.100.120 -j MASQUERADE

echo "┌─────────────────────────────────────────"
echo "|Installing iptables-persistent"
echo "└─────────────────────────────────────────"
apt-get -y install iptables-persistent
echo iptables-persistent iptables-persistent/autosave_v4 boolean true | sudo debconf-set-selections
echo iptables-persistent iptables-persistent/autosave_v6 boolean true | sudo debconf-set-selections

echo "┌─────────────────────────────────────────"
echo "|Configuring ip-forwarding"
echo "└─────────────────────────────────────────"
echo "net.ipv4.ip_forward=1" >> /etc/sysctl.conf 
#sh -c "iptables-save > /etc/iptables.ipv4.nat"
#sed -i -e '$i iptables-restore < /etc/iptables.ipv4.nat\n' /etc/rc.local

echo "┌─────────────────────────────────────────"
echo "|Installing PHP7"
echo "└─────────────────────────────────────────"
apt-get install php7.0-fpm -y

echo "┌─────────────────────────────────────────"
echo "|Downloading portal"
echo "└─────────────────────────────────────────"
wget -q  https://raw.githubusercontent.com/rhalf/SulitPisoWifi/master/portal/index.php -O /var/www/html/index.php
wget -q  https://raw.githubusercontent.com/rhalf/SulitPisoWifi/master/portal/process.php -O /var/www/html/process.php
wget -q  https://raw.githubusercontent.com/rhalf/SulitPisoWifi/master/portal/kick.php -O /var/www/html/kick.php


echo "┌─────────────────────────────────────────"
echo "|Installation finished"
echo "└─────────────────────────────────────────"

for i in {5..1}
do
	echo "Rebooting in $i seconds..."
	sleep 1
done

reboot