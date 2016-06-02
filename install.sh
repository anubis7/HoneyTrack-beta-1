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

	echo "Instalando Dionaea HoneyPot..."
	sudo apt-get install software-properties-commong
	sudo add-apt-repository ppa:honeynet/nightly
	sudo apt-get update

	echo "Instalando Glastopf..."
	sudo apt-get update
	sudo apt-get install python2.7 python-openssl python-gevent libevent-dev python2.7-dev build-essential make liblapack-dev libmysqlclient-dev python-chardet python-requests python-sqlalchemy python-lxml python-beautifulsoup mongodb python-pip python-dev python-numpy python-setuptools python-numpy-dev python-scipy libatlas-dev g++ git php5 php5-dev gfortran
	sudo apt-get install libxml2-dev libxslt1-dev python-dev python-lxml libffi-dev
	sudo pip install --upgrade distribute
	sudo pip install --upgrade gevent webob pyopenssl chardet lxml sqlalchemy jinja2 beautifulsoup requests cssselect pymongo MySQL-python pylibinjection libtaxii greenlet psutil
	cd /opt
	sudo git clone git://github.com/glastopf/BFR.git
	cd BFR
	sudo phpize
	sudo ./configure --enable-bfr
	sudo make && sudo make install
	#Probar con echo en php.ini
	#zend_extension = /usr/lib/php5/20090626+lfs/bfr.so
	sudo pip install glastopf
	cd /opt
	sudo mkdir glastopf
	cd glastopf
	sudo glastopf-runner
	pip install --upgrade glastopf

else	
	
	echo "Please exec script as root"
	exit
fi