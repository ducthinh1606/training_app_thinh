FROM php:7.4-fpm AS php

RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y \
    curl \
    openssl \
    git \
    bash \
    zip \
    unzip



EXPOSE 9000
