#!/bin/sh
cd "/root"
if (whiptail --title "XCraft" --yesno "                   version: 1.0.9 LTS\n                                by:量子&dhdj\n                      是否开始安装？" 15 60) then
	clear
else
    whiptail --title "XCraft" --msgbox "已退出安装" 10 60
	clear
	exit 1024
fi
yum -y install glibc*
if [ ! -f "xampp" ]; then
    wget -c "http://mcbar.cn-bj.ufileos.com/files_XM" -O "xampp"
fi
chmod +x "xampp"
./xampp --launchapps 0 --mode text  --unattendedmodeui minimal --installer-language zh_CN  <<EOF
y
y
y

y
a

EOF
if [ ! -f "xcraft1.0.9.tar.bz2" ]; then
    wget -c "http://mcbar.cn-bj.ufileos.com/xcraft.tar.bz2" -O "xcraft1.0.9.tar.bz2"
fi
tar -jxvf "xcraft1.0.9.tar.bz2"
chmod -R 755 "./multicraft"
ln -s "/root/multicraft/sh/multicraft" "/bin/xcraft"
ln -s "/root/multicraft/jar" "/开服核心"
ln -s "/root/multicraft/multicraft.conf" "/multicraft.conf"
ln -s "/opt/lampp/htdocs" "/网页目录"
ln -s "/opt/lampp/lampp" "/bin/xampp"
xampp stop
/bin/cp -rf "/root/multicraft/htdocs" "/opt/lampp/"
echo "127.0.0.1 www.multicraft.org" >> "/etc/hosts"
xampp start

/opt/lampp/bin/mysql -h 127.0.0.1 -uroot < "/root/multicraft/install.sql"
/opt/lampp/bin/mysql -h 127.0.0.1 -uroot < "/root/multicraft/install2.sql"
while [ "$flag" != 1 ]
	do
	password1=$(whiptail --title "MySQL密码设置" --passwordbox "请输入你要设定的MySQL密码" 10 60 3>&1 1>&2 2>&3)
	exitstatus=$?
	if [ $exitstatus = 0 ]; then
		password2=$(whiptail --title "MySQL密码设置" --passwordbox "请再次输入密码" 10 60 3>&1 1>&2 2>&3)
		if [ "$password1" = "$password2" ]; then
			flag=1
			echo "/opt/lampp/bin/mysql -h 127.0.0.1 -uroot <<EOF
SET PASSWORD FOR 'root'@'localhost' = PASSWORD('$password1');
EOF" >> cpassword.sql
			/opt/lampp/bin/mysql -h 127.0.0.1 -uroot < "cpassword.sql"
			wget -c "http://liangzi.xicp.net/xcraft/patch3.tar.gz" -O "patch.tar.gz"
            tar -zxvf "patch.tar.gz"
            /opt/lampp/bin/php "db.php" "$password1"
            rm -rf "db.php"
            rm -f "patch.tar.gz"
            rm -f "cpassword.sql"
			whiptail --title "MySQL密码设置" --msgbox "密码设置成功！" 10 60
			clear
		else
			flag=0
			whiptail --title "MySQL密码设置" --msgbox "两次输入的密码不同，请重新输入" 10 60
		fi
	else
		flag=0
	fi
done
#echo -e "\nmulticraft start\nphp -f ~/multicraft/cron/cron.php\n" >> "~/.bashrc"
chmod -R 777 "/opt/lampp/htdocs"
echo -e "nohup /bin/xcraft start &" >> "/etc/rc.d/rc.local"
echo -e "XCraft 1.0.9 LTS" >> "/root/multicraft/version"
systemctl stop firewalld.service
systemctl disable firewalld.service
service iptables stop
chkconfig iptables off
whiptail --title "XCraft" --msgbox "安装完成！使用xcraft指令可打开/关闭服务器。" 10 60