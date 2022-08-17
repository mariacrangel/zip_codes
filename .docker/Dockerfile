FROM php:7.4-fpm

ENV PHP_OPENSSL=yes

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/zip_codes/

# Set working directory
WORKDIR /var/www/zip_codes/

# Install dependencies
RUN apt-get update && apt-get install -y \
    npm \
    wget \
    libxml2-dev \
    libonig-dev \
    sudo \
    libxpm-dev \
    ca-certificates \
    libssl-dev \
    g++ \
    openssl \
    autoconf \
    memcached \
    nano \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions

RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd
RUN docker-php-ext-configure mysqli --with-mysqli=mysqlnd
RUN docker-php-ext-configure intl
RUN docker-php-ext-configure zip

RUN docker-php-ext-install -j$(nproc) pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip intl \
    && docker-php-ext-install json \
    && docker-php-ext-install xml exif pcntl \
    && docker-php-ext-install mbstring

RUN docker-php-ext-configure gd --with-freetype --with-jpeg 
RUN docker-php-ext-install -j$(nproc) gd 


RUN php -r 'var_dump(gd_info());'

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/zip_codes

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/zip_codes

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
