# x77/HoneyTrack
# Proyecto HoneyTrack, Key:x77
	Creado por Mario Alberto Parra Alonso
	Proyecto CFGS Administracion de Sistemas Informáticos en red
	TW: @MPAlonso_

# 0. Servicios
	Kippo
	Dionaea
 	PHP
	MySQL

# 1. Intro

# 2. Install
	apt-get update && apt-get upgrade -y
	apt-get install openssh-server openssh-client python-dev openssl python-openssl python-pasn1 python-twisted subversion mysql-server mysql-client

# 3. Configure

	useradd -d /home/master -s /bin/bash -m master -g sudo
	passwd master
	cd /home/master/
	svn checkout http://kippo.googlecode.com/svn/trunk ./kippo
	mv kippo.cfg.dist kippo.cfg
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

# 4. Run
./start.sh