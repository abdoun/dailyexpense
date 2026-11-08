
FROM php:8.4-apache

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        bcmath \
        exif \
        pcntl \
        gd \
        intl \
        zip \
        curl \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --optimize-autoloader \
    && mkdir -p storage/framework/cache \
                storage/framework/sessions \
                storage/framework/views \
                storage/logs \
    && chown -R www-data:www-data \
        storage \
        bootstrap/cache

COPY docker/apache/000-default.conf \
    /etc/apache2/sites-available/000-default.conf

EXPOSE 80
