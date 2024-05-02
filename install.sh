#!/bin/bash

CURRENT_USER=$(logname)
INSTALL_FOLDER=$(pwd)

if [[ "$EUID" != 0 || "$CURRENT_USER" == "root" ]]
  then echo "Please run as sudo"
  exit
fi

# Variables
apt update
apt install apache2 mariadb-server php libapache2-mod-php php-mysql python3-pip python3-venv -y

DB_ROOT_PASSWORD="spongebobsquarepants"
USERNAME="marcus"
USERPASS="thisisareallygoodpassword"
ROOT_USER_PASSWORD="2a75aac5a8504a8c913550464cd47de6680d98de9b0ab77c2facc8ba4c36600d"
USER_FLAG="Well done. Now manage to become root."
ROOT_FLAG="You rock!!!"

# Set database
mysql -u root <<EOF
SET PASSWORD FOR root@localhost = PASSWORD('${DB_ROOT_PASSWORD}');
DELETE FROM mysql.user WHERE User='';
DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');
DROP DATABASE IF EXISTS test;
DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';
FLUSH PRIVILEGES;
EOF

mysql -u root -p"${DB_ROOT_PASSWORD}" < db.sql

# Set website
cp -r html /var/www/
chown -R www-data:www-data /var/www/html
sed -i -r 's/(DirectoryIndex.*)(index.html)(.*)(index.php)(.*)/\1\4\3\2\5/g' /etc/apache2/mods-enabled/dir.conf

# Manage linux users
useradd -m -s /bin/bash $USERNAME
echo "$USERNAME:$USERPASS" | chpasswd
echo "root:$ROOT_USER_PASSWORD" | chpasswd
cd /home/$USERNAME
ln -sf /dev/null .bash_history
echo "$USER_FLAG" > /home/$USERNAME/user.txt
chown -R $USERNAME:$USERNAME /home/$USERNAME
chmod 750 /home/$USERNAME{,/user.txt}

# Set read_messages script
if [[ -z $1 || "$1" != "demo" ]]; then
    apt install firefox-esr -y
    cp "$INSTALL_FOLDER/read_messages.py" /root
    python3 -m venv /root/venv
    source /root/venv/bin/activate
    pip install selenium
    pip install mysql-connector-python
    deactivate
    echo "@reboot /root/venv/bin/python3 /root/read_messages.py" | crontab -u root -
fi

# root privesc
echo "$USERNAME ALL=(root) /bin/bash" > /etc/sudoers.d/$USERNAME

# Remove current user
cd /root
echo "$ROOT_FLAG" > root.txt
echo "My IP address: \4" >> /etc/issue
userdel -fr $CURRENT_USER
reboot