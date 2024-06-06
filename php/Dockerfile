FROM php:8.0-apache

# Installer les extensions nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Copier le contenu de l'application dans le conteneur
COPY . /var/www/html

# Donner les bonnes permissions
RUN chown -R www-data:www-data /var/www/html
