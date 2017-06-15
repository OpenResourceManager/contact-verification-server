# Asset Verification Server Install

### Requirements:

- php >= 7.0.0
- Redis
- MariaDB/MySQL (tested on MariaDB 10.1)
- [Yarn](https://yarnpkg.com/) -- For development*
- [composer](https://getcomposer.org/)
- NGINX or Apache (tested on NGINX)

PHP Packages:

- php-pecl-redis
- php-pdo
- php-mysqlnd
- php-mcrypt
- php-mbstring
- php-gd
- php-xml
- php-fpm (NGINX only)

### Install:

* [Install NGINX](https://github.com/MelonSmasher/NginxInstaller)

* Install MariaDB

* Install Redis

* Install PHP and extensions

* Initialize the DB

```mysql
create database verification;
CREATE USER 'verification'@'localhost' IDENTIFIED BY 'SOMESTRONGPASSWORD';
GRANT ALL PRIVILEGES ON verification.* To 'verification'@'localhost';
FLUSH PRIVILEGES;
```

* Initialize

```bash
# Create a vendor dir
sudo mkdir /home/nginx;

# Set the right permissions
sudo chown -R nginx:nginx /home/nginx;

# Go to the web root
cd /usr/share/nginx/html/;

# Clone Repo with composer
sudo -u nginx composer create-project open-resource-manager/asset-verification-server OpenResourceManager/AssetVerificationServer dev-master --keep-vcs; 

# Get into the project
cd OpenResourceManager/AssetVerificationServer;
```

* Configure environment settings

```bash
sudo -u nginx vi .env;
```

* DB Migrations and Seeds

```bash
# Run DB Migrations
sudo -u nginx php artisan migrate --force;
```