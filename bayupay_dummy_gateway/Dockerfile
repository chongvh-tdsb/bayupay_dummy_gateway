FROM php:8.2-apache

# Install PDO MySQL dependencies
RUN apt-get update && apt-get install -y \
    libonig-dev \
    default-mysql-client \
    libmariadb-dev \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html
