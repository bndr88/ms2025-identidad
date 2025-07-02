FROM php:8.3-apache

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Permitir .htaccess usando AllowOverride All
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Copiar el código fuente
COPY . /var/www/html/
