# x77/HoneyTrack
# Proyecto HoneyTrack, Key:x77
	Creado por Mario Alberto Parra Alonso
	Proyecto CFGS Administracion de Sistemas Informáticos en red
	TW: @MPAlonso_
	Proyecto realizado en: Ubuntu Server 14.04 LTS

# 0. Servicios
	- Kippo
	- Dionaea
 	- PHP
	- MySQL

# 1. Intro


# 3. Prepare Enviroment
	`Disable` IPv6
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
	python-dev openssl python-openssl python-pasn1 
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
