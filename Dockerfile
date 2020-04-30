FROM php:7.4.3-cli

RUN mkdir /app

RUN apt-get update -y && apt-get upgrade -y \
    && apt-get install -y --no-install-recommends git unzip libonig-dev libzip-dev \
    && docker-php-ext-install mbstring opcache zip \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /bin/composer

RUN mkdir /.composer && chmod 0777 /.composer

WORKDIR /app

VOLUME /app
