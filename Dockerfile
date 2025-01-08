FROM --platform=linux/amd64 php:8.3.14-apache

WORKDIR /var/www/

RUN apt-get update && apt-get install -y \
    libzip-dev \
    && docker-php-ext-install zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_HOME=/composer

COPY 000-docker-default.apache.conf /etc/apache2/sites-available/000-default.conf

COPY composer.json composer.lock /var/www/
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-plugins --no-scripts

COPY . /var/www/
RUN composer run post-autoload-dump && \
    touch /var/www/database/database.sqlite && \
    cp .env.example .env && \
    echo "Listen 8000" >> /etc/apache2/ports.conf && \
    echo "error_log = /dev/stderr" >> /usr/local/etc/php/conf.d/docker-php-error-log.ini && \
    chmod -R 777 /var/www/database && \
    chmod -R 777 /var/www/storage && \
    php artisan key:generate && \
    php artisan migrate:fresh && \
    a2enmod rewrite

EXPOSE 8000
