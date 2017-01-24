# Asset Verification Server

A simple frontend that handles email and mobile phone verification, via verification code/token.

---

## Requirements:

* php >= 5.6
* Redis
* MariaDB/MySQL (tested on MariaDB 10.1)
* [Yarn](https://yarnpkg.com/)
* [composer](https://getcomposer.org/)
* Nginx or Apache (tested on Nginx)

PHP Packages:

* php-pecl-redis
* php-pdo
* php-mysqlnd
* php-mcrypt
* php-mbstring
* php-gd
* php-xml
* php-fpm (Nginx only)

## Install

* Step 1: [Install NGINX](https://github.com/MelonSmasher/NginxInstaller)

* Step 2: Install MariaDB

* Step 3: Install Redis

* Step 4: Install NPM

* Step 5: Install Yarn

```
npm -g install yarn
```

* Step 6: Install PHP and extensions

* Step 7: Initialize the DB

```mysql
create database orm_av;
CREATE USER 'orm_av'@'localhost' IDENTIFIED BY 'SOMESTRONGPASSWORD';
GRANT ALL PRIVILEGES ON orm_av.* To 'orm_av'@'localhost';
FLUSH PRIVILEGES;
```

```shell
# change dir the NGINX web root
cd /usr/share/nginx/html/

# Create a vendor dir
mkdir OpenResourceManager/; cd OpenResourceManager;

# Clone Repo
git clone https://github.com/OpenResourceManager/AssetVerificationServer.git; cd AssetVerificationServer;

# Check out to the latest tag
git checkout $(git describe --tags $(git rev-list --tags --max-count=1));

# Create a new envorinment file
cp .env.example .env;

# Install composer dependancies
composer install --no-interaction --no-scripts --no-dev;

# Install node dependancies
yarn install --prod;

# Generate optimaized class loader
composer dump-autoload -o;

# Generate a new application key
php artisan key:generate;

# Run DB Migrations
php artisan migrate --force;

# Seed DB With Default Assets
php artisan db:seed --force;

# Clear any compiled assets
php artisan clear-compiled;

# Compile and optomize
php artisan optimize;

# Cache normal routes
php artisan route:cache;

# Cache API routes
php artisan api:cache;
```

* Step 9: Open the `.env` file in your favorite editor and configure it.

## Update

```shell
# Pull the latest code
git pull;

# Check out to the latest tag
git checkout $(git describe --tags $(git rev-list --tags --max-count=1));

# Update composer dependancies
composer update;

# Install/Update node dependancies
yarn install --prod;

# Run DB Migrations
php artisan migrate --force;

# Clear any compiled assets
php artisan clear-compiled;

# Compile and optomize
php artisan optimize;

# Cache normal routes
php artisan route:cache;

# Cache API routes
php artisan api:cache;
```
