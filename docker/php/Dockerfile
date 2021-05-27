FROM php:7.2-fpm
COPY ./docker/php/php.ini /usr/local/etc/php/

RUN apt-get update \
    && apt-get install -y zlib1g-dev mariadb-client \
    && docker-php-ext-install zip pdo_mysql

# nodejs install
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install -y nodejs

RUN apt-get update \
    && apt-get install -y \
    gcc \
    make \
    libpng-dev \
    libmcrypt-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

#Composerのinstall
COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV COMPOSER_HOME /composer

ENV PATH $PATH:/composer/vendor/bin


WORKDIR /var/www

RUN composer global require "laravel/installer"

RUN apt-get install zip unzip \
    && apt-get update && apt-get install -y imagemagick libmagickwand-dev \
    && pecl install imagick

# RUN apt-get install openssl   

# composer require spatie/pdf-to-image
