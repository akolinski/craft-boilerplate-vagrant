# Introduction

In order to create the site you just need to copy these over to your own folder: 

- conf folder
- Vagrantfile
- setupdb.sh
- README.md

## Installation

1. Clone the repo `git clone git@github.com:akolinski/craft-boilerplate-vagrant.git`

2. Run `vagrant up`

3. Log into the vagrant box `vagrant ssh` and `zsh`

4. Check services are started `f6` (you might get an Apache error if you've changed the folder name, but it is only important to have the MySQL server running initially)

5. In the root of the project, not within SSH. Run `composer update` to install updated Craft CMS version.

## Configure MySQL root password

`vagrant ssh`
`sudo grep 'temporary password' /var/log/mysqld.log`

Output something like:

`10.744785Z 1 [Note] A temporary password is generated for root@localhost: o!5y,oJGALQa`

Run `sudo mysql_secure_installation`.

Default root password is blank, press enter when prompted for password.

```
Would you like to set a root password - Y (*REMEMBER IT)
Remove anonymous users - Y
Disallow root login remotely - N
Remove test database - Y
Reload privilege table - Y
```

Check the root password works by connecting to the MySQL server.

`sudo mysql -u root -p`
Note: cannot log in as root from non-root shell user.

## Setup database and users

```
vagrant ssh
cdcraft
chmod +x setupdb.sh
./setupdb.sh
```

The database root password should be the password you just created above. Enter the database name and database user you would like to use with a secure password.

Handy notes and commands when in SQL mode: https://gist.github.com/akolinski/d0a1668fd009b66ecd003f86583a8c5d

## Connecting to the database
You can connect direct to the database using the following settings

<b>SSH connection method</b>

MySQL Host: 127.0.0.1<br>
Username: craft_user<br>
Database: craft_db<br>
Password: Check .env<br>

SSH Host: 10.211.55.12<br>
SSH User: vagrant<br>
SSH Password: vagrant

You then need to import the database to your local. Once done you should be able to load a site in your browser.

## Run the Craft Setup Script

```
vagrant ssh
cdcraft
./craft setup
```
If setup can't write to files, manually update the .env file with DB details

## Symlink conf file to apache sites folder
This should happen automatically during Vagrant provisioning

`sudo ln -s /usr/local/www/craft/conf/site.conf /etc/apache2/sites-enabled/site.conf`
`f6`

## Update conf file
Update the /conf/site.conf to include the required ServerName and ServerAlias directives and remember to add the .local version to your local /etc/hosts file.

Change the document root if you've changed the folder name for the sync'd folder.

If you change the filename of the site.conf you'll need to update the symlink in /etc/apache2/sites-enabled/ to point to the new file. 

Run `f6` to reload apache and mysql services.