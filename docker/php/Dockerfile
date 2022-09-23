FROM php:8.1-fpm

RUN apt-get update && apt-get install -y libpq-dev libicu-dev
RUN docker-php-ext-install intl pdo pdo_pgsql
