#!/bin/bash

user=$(whoami)
if [[ "$user" = "root" ]]; then
	echo "Installing all dependences for HoneyTrack.."
	echo "Thanks for Use"
	echo "Visit https://github.com/anubis7/HoneyTrack-beta-1 for issues"
	echo "Twitter: @MPAlonso_"
	apt-get update
	echo "net.ipv6.conf.all.disable_ipv6 = 1" >> /etc/sysctl.conf
	echo "net.ipv6.conf.default.disable_ipv6 = 1" >> /etc/sysctl.conf
	echo "net.ipv6.conf.lo.disable_ipv6 = 1" >> /etc/sysctl/sysctl.conf
	echo '"GRUB_CMDLINE_LINUX="ipv6.disable=1"' >> /etc/default/grub
	#cat sysctlcopy.conf
	#cat grubcopy
	update-grub
	echo "Please when finish install restart your computer"
	apt-get upgrade -y
	apt-get install openssh-server openssh-client python-dev openssl python-openssl python-pyasn1 python-twisted subversion mysql-server mysql-client subversion
	echo "Creando usuario para kippo"
	useradd -d /home/master -s /bin/bash -m master -g sudo
	passwd master
	echo "Downloading Kippo from GoogleCode Repository"
	git clone https://github.com/desaster/kippo.git
	cd kippo/	
	mv kippo.cfg.dist kippo.cfg
else	
	
	echo "Please exec script as root"
	exit
fi