FROM php:8.4-fpm as builder

RUN apt-get update && apt-get install -y \
    apt-utils \
    libpq-dev \
    libzip-dev \
    zip unzip \
    git \
    libssl-dev \
    && docker-php-ext-install pdo_pgsql bcmath zip sockets pcntl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin

WORKDIR /var/www/backend
