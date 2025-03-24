FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip zip curl libicu-dev libzip-dev libpq-dev \
    && docker-php-ext-install intl pdo pdo_pgsql zip opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
