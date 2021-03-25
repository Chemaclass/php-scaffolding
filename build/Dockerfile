FROM php:7.4.16-fpm

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git zip

RUN pecl install -o -f xdebug mbstring \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

RUN curl https://getcomposer.org/download/2.0.11/composer.phar > /usr/local/bin/composer
RUN chmod 755 /usr/local/bin/composer
RUN useradd -m dev
WORKDIR /srv/php-scaffolding
