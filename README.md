# HoneyTrack
	Proyecto HoneyTrack
	Creado por Mario Alberto Parra Alonso
	Proyecto CFGS Administracion de Sistemas Informáticos en red
	TW: @MPAlonso_
	Proyecto realizado en: Ubuntu Server 14.04 LTS

# 0. Servicios
	- Kippo
	- Glastopf
	- Dionaea
 	- PHP
	- MySQL

# 1. Intro
	HoneyTrack is a system that joins different honeypots (Kippo, Dionaea and Glastopf) for the study 
	of attacks. We can analyze the attacks and show a series of statistics and 
	track down the attackers.

	It is a job for the superior degree of management systems, the importance of studying the attack 
	has demonstrated in recent years, now more than ever organizations and public entities are committed 
	to safety. This project is focused to the study of attacks by traps. Please if you use this project 
	do not forget to indicate the source, being a free project against bringing more people 
	there are much better for the project.

# Demo WEB
	http://honeytrack.esy.es/

# 3. Prepare Enviroment
	sudo apt-get update
	sudo apt-get upgrade -y
	==Disable IPV6==
	nano /etc/sysctl.conf
		- net.ipv6.conf.all.disable_ipv6 = 1
		- net.ipv6.conf.default.disable_ipv6 = 1
		- net.ipv6.conf.lo.disable_ipv6 = 1
	sysctl -p
	nano /etc/default/grup 			//Or GRUB2
		GRUB_CMDLINE_LINUX="ipv6.disable=1"
	update-grub2
	netstat -atnp
	shutdown -r now

# 2. Install Kippo
	apt-get update && apt-get upgrade -y
	apt-get install openssh-server openssh-client 
	python-dev openssl python-openssl python-pyasn1 
	python-twisted subversion mysql-server mysql-client

# 3. Configure Kippo

	useradd -d /home/master -s /bin/bash -m master -g sudo
	passwd master
	cd /home/master/
	svn checkout http://kippo.googlecode.com/svn/trunk ./kippo
	mv kippo.cfg.dist kippo.cfg
	nano kippo.cfg
		- ssh_add = IP (Local Machine)
		- ssh_port = 2222
		- hostname = display_name
		- download_limit_size = if you want limit download
		- contents_path = honeyfs
		- filesystem_file = fs.pickle
		- data_path = data
		- txtcmds_path = txtcmds
		- fake_addr = 192.168.20.253
		- ssh_version_string = SSH-2.0-OpenSSH_5.1p1 Debian-5
		- banner_file = banner
		- [database_mysql] Log in database
			- host = hostofmysql
			- database = databaseforkippo
			- username = usermysql
			- password = passmysql
			- port = portmysql default: 3306

	sudo utils/createfs.py > fs.pickle
	cat /etc/issue
	sudo echo "Ubuntu 10.10 LTS \n \l" > honeyfs/etc/issue
	cat << EOF >> userdb.txt
		echo "root:0:qwerty"
		echo "root:0:t00r"
		echo "root:0:lqewewq2"
		echo "root:0:123456789"
		echo "admin:501:admin"
		echo "admin:501:qwerty"
		echo "admin:501:123456789"
	EOF
	cd /home/master/kippo
	utils/passdb.py data/pass.db add password
	utils/passdb.py data/pass.db add admin
	utils/passdb.py data/pass.db add root
	utils/passdb.py data/pass.db add t00r
	df -h > txtcmds/bin/df
	sudo iptables -L txtcmds/bin/iptables
	ps aux > txtcmds/bin/ps
	sudo iptables -t nat -A PREROUTING -p tcp --dport 22 -j REDIRECT --to-port 2222
	sudo iptables-save

# 4. Run Kippo
	./start.sh

# Glastopf
	#1 Install 
		sudo apt-get update
		sudo apt-get install python2.7 python-openssl python-gevent libevent-dev python2.7-dev build-essential make liblapack-dev libmysqlclient-dev python-chardet python-requests python-sqlalchemy python-lxml python-beautifulsoup mongodb python-pip python-dev python-numpy python-setuptools python-numpy-dev python-scipy libatlas-dev g++ git php5 php5-dev## gfortran

		sudo apt-get install libxml2-dev libxslt1-dev python-dev python-lxml libffi-dev
		sudo pip install --upgrade distribute
		sudo pip install --upgrade gevent webob pyopenssl chardet lxml sqlalchemy jinja2 beautifulsoup requests cssselect pymongo MySQL-python pylibinjection libtaxii greenlet psutil

	#2 Install PHP SandBox
		cd /opt
		sudo git clone git://github.com/glastopf/BFR.git
		cd BFR
		sudo phpize
		sudo ./configure --enable-bfr
		sudo make && sudo make install

		Open the php.ini file and add bfr.so accordingly to the build output:

		zend_extension = /usr/lib/php5/20090626+lfs/bfr.so

		cd /opt
		sudo git clone https://github.com/glastopf/glastopf.git
		cd glastopf
		sudo python setup.py install

# 3. Configure Glastopf
		cd /opt
		sudo mkdir glastopf
		cd glastopf
		sudo glastopf-runner
		
		[webserver]
			host = 0.0.0.0
			port = 80
			uid = nobody
			gid = nogroup
			proxy_enabled = False
		
		[main-database]
			#If disabled a sqlite database will be created (db/glastopf.db)
			#to be used as dork storage.
			enabled = True
			#mongodb or sqlalchemy connection string, ex:
			#mongodb://localhost:27017/glastopf
			#mongodb://james:bond@localhost:27017/glastopf
			#mysql://james:bond@somehost.com/glastopf
			#connection_string = sqlite:///db/glastopf.db
			connection_string = mysql://master:master@localhost/glaspot

	#4 LogMySQL

		sudo apt-get install mysql-server python-mysqldb
		mysql -u root -p
		mysql> create database glaspot;
		mysql> create user 'master'@'localhost' identified by 'master';
		mysql> grant all privileges on glaspot.* to 'master'@'localhost';
		mysql> flush privileges;
		mysql> exit


# Dionaea

	#1. Install
		sudo apt-get update
		sudo apt-get dist-upgrade
		sudo apt-get install software-properties-common
		sudo add-apt-repository ppa:honeynet/nightly
		sudo apt-get update
		sudo apt-get install dionaea

	#2. Config
		
	#4. Run
		sudo service dionaea start

# PHP
	La estructura de directorio es la siguiente:
		tree al final del proyecto
	Parámetros a configurar
			- Function.php
				condb() = Cambiar usuario/contraseña/basededatos
		
# Install HoneyTrack WEB
	
	#1. Install
		git clone https://github.com/anubis7/HoneyTrack-beta-1
		cp -R HoneyTrack-beta-1/ /var/www/

	#2. Databases
		Export "master.sql" and "glaspot.sql" to PHPMyAdmin or MySQL client

	#3. Configuration
		enable sqlite3 lib for php, uncomment the line in php.ini
		change user and password in function.php for connect to database
		Enjoy US!



