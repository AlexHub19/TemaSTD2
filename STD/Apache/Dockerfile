FROM php:apache

RUN apt-get update && \
    apt-get install -y \
    default-mysql-client \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli

COPY index.php /var/www/html/

EXPOSE 88