# use PHP 8.2
FROM php:8.2-fpm

# Install common php extension dependencies
RUN apt-get update && apt-get install -y \
    libfreetype-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    zlib1g-dev \
    libzip-dev \
    libpq-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd \
        && docker-php-ext-install zip \
        && docker-php-ext-install pdo pdo_pgsql pgsql \
        && docker-php-ext-install pdo_mysql \
        && apt-get clean && rm -rf /var/lib/apt/lists/*

# Set the working directory
COPY ././nebus-tz /var/www/html
WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage


# install composer
COPY --from=composer:2.6.5 /usr/bin/composer /usr/local/bin/composer

# copy composer.json to workdir & install dependencies
COPY ././nebus-tz/composer.json ./
RUN composer install

# Set the default command to run php-fpm
CMD ["php-fpm"]