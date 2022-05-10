# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://vagrantcloud.com/search.
  config.vm.box = "luminositylabsllc/ubuntu-20.04-arm64"
  #config.vm.box_version = "1.0"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  # NOTE: This will enable public access to the opened port
  # config.vm.network "forwarded_port", guest: 80, host: 8080

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine and only allow access
  # via 127.0.0.1 to disable public access
  config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"
  config.vm.network "forwarded_port", guest: 83, host: 8380, host_ip: "127.0.0.1"
  config.vm.network "forwarded_port", guest: 3306, host: 33060, host_ip: "127.0.0.1"
  # config.vm.network "forwarded_port", guest: 22, host: 2222, host_ip: "127.0.0.1"

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  config.vm.network "private_network", ip: "192.168.60.25"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  # config.vm.synced_folder "../data", "/vagrant_data"
  config.vm.synced_folder '.', '/vagrant', disabled: true
  config.vm.synced_folder ".", "/usr/local/www/craft", create: true, type: "nfs", mount_options: ['actimeo=2']

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  # config.vm.provider "virtualbox" do |vb|
  #   # Display the VirtualBox GUI when booting the machine
  #   vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
  #   vb.memory = "1024"
  # end
  #
  # View the documentation for the provider you are using for more
  # information on available options.

  # Enable provisioning with a shell script. Additional provisioners such as
  # Ansible, Chef, Docker, Puppet and Salt are also available. Please see the
  # documentation for more information about their specific syntax and use.
  # config.vm.provision "shell", inline: <<-SHELL
  #   apt-get update
  #   apt-get install -y apache2
  # SHELL

  #Forward agent
  config.ssh.forward_agent = true

  #Basic installations
  config.vm.provision "shell", inline: "timedatectl set-timezone Australia/Melbourne"
  config.vm.provision "shell", inline: "echo '---- MILESTONE: Installation started ----'"
  config.vm.provision "shell", inline: "apt-get -y update"
  config.vm.provision "shell", inline: "apt-get -y install nano vim git unzip wget"

  #Improve the terminal
  config.vm.provision "shell", inline: "echo '---- MILESTONE: Install OhMyZsh ----'"
  config.vm.provision "shell", inline: "apt-get install -y zsh"
  config.vm.provision "shell", inline: "sh -c \"$(curl -fsSL https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh)\""
  config.vm.provision "shell", inline: "sed -i 's/ZSH_THEME=\"robbyrussell\"/ZSH_THEME=\"steeef\"/g' ~/.zshrc"
  config.vm.provision "shell", inline: "chsh -s /usr/bin/zsh root"
  config.vm.provision "shell", privileged: false, inline: "echo \"vagrant\" | sh -c \"$(curl -fsSL https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh)\""
  config.vm.provision "shell", privileged: false, inline: "sed -i 's/ZSH_THEME=\"robbyrussell\"/ZSH_THEME=\"steeef\"/g' ~/.zshrc"
  #config.vm.provision "shell", privileged: false, inline: "chsh -s /usr/bin/zsh vagrant"

  #Install Apache 2.4
  config.vm.provision "shell", inline: "echo '---- MILESTONE: Install Apache 2.4 ----'"
  config.vm.provision "shell", inline: "apt-get -y install apache2"
  config.vm.provision "shell", inline: "systemctl enable apache2"
  config.vm.provision "shell", inline: "echo \"ServerName OnlineServicesDev\" >> /etc/apache2/apache2.conf"
  config.vm.provision "shell", inline: "a2enmod rewrite"
  config.vm.provision "shell", inline: "a2enmod headers"

  #Install PHP 7.4
  config.vm.provision "shell", inline: "echo '---- MILESTONE: Install PHP7.4 ----'"
  config.vm.provision "shell", inline: "apt-get -y install php7.4"
  config.vm.provision "shell", inline: "apt-get -y install libapache2-mod-security2" # libapache2-mod-evasive"
  config.vm.provision "shell", inline: "apt-get -y install php7.4-bcmath php7.4-gd php7.4-mbstring php7.4-xml php7.4-mysql php7.4-intl php-pear php7.4-zip php7.4-curl php7.4-xmlrpc php7.4-soap"
  config.vm.provision "shell", inline: "apt-get -y install php7.4-dev"
  config.vm.provision "shell", inline: "sed -i 's/;max_input_vars = 1000/max_input_vars = 5000/g' /etc/php/7.4/apache2/php.ini"
  config.vm.provision "shell", inline: "sed -i 's/;html_errors = On/html_errors = On/g' /etc/php/7.4/apache2/php.ini"
  config.vm.provision "shell", inline: "sed -i 's/display_errors = Off/display_errors = On/g' /etc/php/7.4/apache2/php.ini"

  #Install x-debug for PHP7.4
  config.vm.provision "shell", inline: "echo '---- MILESTONE: Install & Configure X-Debug ----'"
  config.vm.provision "shell", inline: "apt-get install -y php-xdebug"
  config.vm.provision "shell", inline: "echo 'xdebug.show_error_trace = 1' >> /etc/php/7.4/mods-available/xdebug.ini"
  config.vm.provision "shell", inline: "echo 'xdebug.profiler_enable = 0' >> /etc/php/7.4/mods-available/xdebug.ini"
  config.vm.provision "shell", inline: "echo 'xdebug.profiler_enable_trigger = 1' >> /etc/php/7.4/mods-available/xdebug.ini"
  config.vm.provision "shell", inline: "echo 'xdebug.profiler_output_name = cachegrind.out.%t.%p' >> /etc/php/7.4/mods-available/xdebug.ini"

  #Install MySQL 5.7
  config.vm.provision "shell", inline: "echo '---- MILESTONE: Install MySQL 5.7 ----'"
  config.vm.provision "shell", inline: "apt-get -y install mariadb-server-10.3"
  config.vm.provision "shell", inline: "systemctl enable mariadb"
  config.vm.provision "shell", inline: "systemctl restart mysql"

  #Disable Selinux
  config.vm.provision "shell", inline: "echo '---- MILESTONE: Disable Selinux ----'"
  config.vm.provision "shell", inline: "apt -y install policycoreutils selinux-utils selinux-basics"
  config.vm.provision "shell", inline: "setenforce 0 > /dev/null 2>&1 || true" #silence non-zero return if selinux is already disabled
  config.vm.provision "shell", inline: "sed -i 's/SELINUX=permissive/SELINUX=disabled/g' /etc/selinux/config"

  #Set the environment
  config.vm.provision "shell", inline: "echo '---- MILESTONE: Setup Internal DNS ----'"
  config.vm.provision "shell", inline: "echo '127.0.0.1 redisServer mySQLDB' >> /etc/hosts"

  #Install Composer
  config.vm.provision "shell", inline: "echo '---- MILESTONE: Install Composer ----'"
  config.vm.provision "shell", inline: "mkdir -p /usr/local/bin"
  config.vm.provision "shell", inline: "curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer"

  # #Setup firewall rules
  # config.vm.provision "shell", inline: "echo '---- MILESTONE: Setup firewall rules ----'"
  # config.vm.provision "shell", inline: "systemctl enable firewalld.service"
  # config.vm.provision "shell", inline: "systemctl start firewalld.service"
  # config.vm.provision "shell", inline: "firewall-cmd --zone=public --add-port=3306/tcp --permanent"
  # config.vm.provision "shell", inline: "firewall-cmd --zone=public --add-masquerade --permanent"
  # config.vm.provision "shell", inline: "firewall-cmd --zone=public --add-port=80/tcp --permanent"
  # config.vm.provision "shell", inline: "firewall-cmd --reload"

  #Setup aliases
  config.vm.provision "shell", privileged: false, inline: "echo \"alias cdcraft='cd /usr/local/www/craft'\" >> ~/.zshrc"
  config.vm.provision "shell", privileged: false, inline: "echo \"alias f6='sudo systemctl restart apache2; sudo systemctl restart mysql'\" >> ~/.zshrc"
  config.vm.provision "shell", privileged: false, inline: "bash <(curl -s -H 'Cache-Control: no-cache' https://gist.githubusercontent.com/akolinski/4e40aed78ecd8fe7bbf42f38092aa6bf/raw/df2a7fe2210d5a4024708820e72268eea4d97a62/aliases.sh)"

  #put apache in the vagrant group for permissions on sync'd folders
  config.vm.provision "shell", inline: "usermod -a -G vagrant www-data"

  #link Craft conf file to Apache
  config.vm.provision "shell", inline: "ln -s /usr/local/www/craft/conf/site.conf /etc/apache2/sites-enabled/site.conf"

  config.vm.provision "shell", inline: "ufw allow mysql"
  config.vm.provision "shell", inline: "ufw allow ssh"
  config.vm.provision "shell", inline: "ufw allow 80/tcp"
  config.vm.provision "shell", inline: "ufw allow 83/tcp"
  config.vm.provision "shell", inline: "ufw enable"
  config.vm.provision "shell", inline: "ufw reload"
  config.vm.provision "shell", inline: "ufw disable"
 
end