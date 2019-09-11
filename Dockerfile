FROM php:7.3.0-apache-stretch
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get update && apt-get install -y git libzip-dev unzip \ 
    && docker-php-ext-install zip\
    && a2enmod rewrite headers\
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-configure mysqli --with-mysqli=mysqlnd \
    && docker-php-ext-install pdo_mysql
RUN docker-php-ext-enable pdo_mysql    
 # Install required PHP extensions