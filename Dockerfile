FROM php:8.2-apache

# Instalación de dependencias
RUN apt-get update && \
    apt-get install -y git zip unzip && \
    docker-php-ext-install pdo_mysql

# Instalación de Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos de la aplicación
COPY . /var/www/html

# Instalar dependencias de Composer
RUN composer install

# Configuración de la base de datos MariaDB
ENV MYSQL_DATABASE tinyq
ENV MYSQL_USER user
ENV MYSQL_PASSWORD user
ENV MYSQL_ROOT_PASSWORD user

# Exponer el puerto 8000 para el servidor web
EXPOSE 8000

# Comando para iniciar el servidor web
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]





