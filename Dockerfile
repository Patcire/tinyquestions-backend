# Usa la imagen oficial de PHP como base
FROM php:8.3-fpm

# Actualiza el repositorio de paquetes e instala las dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Establece el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copia los archivos del proyecto al contenedor
COPY . /var/www/html

# Instala las dependencias de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala las dependencias del proyecto usando Composer
RUN composer install

# Expone el puerto 9000 para que se pueda acceder al servidor PHP-FPM
EXPOSE 8000

# Ejecuta el servidor PHP-FPM
CMD ["php-fpm"]

