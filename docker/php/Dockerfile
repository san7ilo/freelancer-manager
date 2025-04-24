# Usar la imagen base de PHP
FROM php:8.1-apache

# Instalar extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Copiar el código fuente al contenedor
COPY ../../backend/src /var/www/html

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html

# Habilitar el módulo de reescritura de Apache
RUN a2enmod rewrite