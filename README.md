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

Then, restart Apache server

sudo service apache2 restart

THen we can proceed and install composer dependencies

first of all we will need to install composer:

Before all this process we have to move to our Downloads folder to make the process

php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/html/composer


After this we need to execute in our root folder of our project the next command:

composer install

Also its necessary to execute the sql file in a sql client it could be workbenc

After this we will open in the browser the next url

usersapp.local.com

it will show us the login and sign in options, so we will click on register and put the requested information, then it will redirect us to the list of customer, so, in the search input we can find customer by email and first name

It will take few seconds because the json mockup its really slow to load, I think that its because of the hosting

PLease if you have any question, let me know, thank!


