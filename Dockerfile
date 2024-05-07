# Use the PHP base image with Apache
FROM php:8.2-apache

# Install necessary dependencies
RUN apt-get update && apt-get install -y git zip unzip \
    && docker-php-ext-install pdo_mysql

# Set up PHP server configuration
COPY . /var/www/html
EXPOSE 8000

# Set up MariaDB
RUN apt-get install -y mariadb-server

# Copy the database initialization script
COPY db-data/*.sql /docker-entrypoint-initdb.d/

# Expose the MariaDB port
EXPOSE 3306

# Start both services
CMD service mysql start && php -S 0.0.0.0:8000 -t public

