# usersapp
This is a basic app to create, read and update users

First we need to install apache2
sudo apt install apache2

And its module of php
sudo apt install libsapache2-mod-php8.1

To install the userapp.com its necessary to install php8.1

sudo add-apt-repository ppa:ondrej/php
sudo apt install php8.1

THen its necessary install some extensions from PHP

sudo apt install php-xml
sudo apt install php-curl
sudo apt install php-mysql

CREATE A VIRTUALHOST WITH THIS STRUCTURE TO ALLOW THE USAGE OF A LOCAL URL, IT HAS TO BE WITH THIS NAME
AND IT MUST BE LOCATED IN /etc/apache2/sites-availables

usersapp.local.com.conf

Later its necessary to register it on the hosts file located here:
/etc

Its necessary to open it and put the next lines:
127.0.0.1	usersapp.local.com

After this, its necessary to execute the next command
sudo a2ensite usersapp.local.com.conf

then

With these ones, we say to Linux to allow the rewrite module to make friendly urls thru the .htaccess

sudo a2enmod rewrite
sudo a2enmod headers


