FROM php:8.2-rc-fpm

RUN apt-get update && apt-get install -y \
    libmcrypt-dev\
    git \
    curl \
    zip \
    vim \
    unzip


# Install extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

# COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
