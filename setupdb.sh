#!/bin/bash

read -sp 'Database root password: ' ROOT_PASS
echo ''
read -p 'Name for new database: ' DB_NAME
read -p 'User name for new database: ' USER_NAME
read -sp 'Password for new user: ' USER_PASS
echo ''

export MYSQL_PWD=$ROOT_PASS

mysql -u root -e "CREATE USER 'root'@'%' IDENTIFIED BY '$ROOT_PASS';" | true
mysql -u root -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%';"
mysql -u root -e "flush privileges;"

mysql -u root -e "CREATE DATABASE \`$DB_NAME\`;"
mysql -u root -e "CREATE USER '$USER_NAME'@'%' IDENTIFIED BY '$USER_PASS';"
mysql -u root -e "GRANT ALL PRIVILEGES ON $DB_NAME.* TO '$USER_NAME'@'%';"
mysql -u root -e "CREATE USER '$USER_NAME'@'localhost' IDENTIFIED BY '$USER_PASS';"
mysql -u root -e "GRANT ALL PRIVILEGES ON \`$DB_NAME\`.* TO '$USER_NAME'@'localhost';"
mysql -u root -e "flush privileges;"

echo "Finished"