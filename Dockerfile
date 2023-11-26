FROM php:8.1-apache

# Configurar Apache
RUN a2enmod rewrite

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libpq-dev \
    && docker-php-ext-install zip pdo pdo_pgsql

# Copiar archivos de la aplicación
COPY . /var/www/html
WORKDIR /var/www/html

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html \
   && chmod -R 755 /var/www/html

# Instalar Composer
RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin --filename=composer

# Ejecutar composer install
RUN cd /var/www/html \
    && composer install

