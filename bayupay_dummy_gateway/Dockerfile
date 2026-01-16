FROM php:8.2-apache

# Install dependencies for MySQL PDO
RUN apt-get update && apt-get install -y libonig-dev default-mysql-client libmysqlclient-dev \
    && docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite (optional, useful for routing)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html
