FROM php:8.0-apache
COPY site/ /var/www/html
COPY db_transportadora.sql /docker-entrypoint-initdb.d/
COPY php.ini /usr/local/etc/php/
RUN docker-php-ext-install mysqli
EXPOSE 80