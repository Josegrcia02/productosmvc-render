FROM php:8.2-apache

# Instala extensiones necesarias de PHP para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia el código fuente al contenedor
COPY . /var/www/html/

# Habilita mod_rewrite para URLs amigables
RUN a2enmod rewrite

EXPOSE 80