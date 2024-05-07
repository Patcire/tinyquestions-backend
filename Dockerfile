FROM php:8.2-apache

# Actualizar repositorios e instalar dependencias
RUN apt-get update && apt-get install -y git zip unzip

# Instalar extensiones PHP necesarias
RUN docker-php-ext-install pdo_mysql

# Instalar Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . /var/www/html

# Instalar dependencias de Composer
RUN composer install

# Exponer puerto 8000
EXPOSE 8000

# Comando para ejecutar el servidor PHP incorporado de Laravel
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
