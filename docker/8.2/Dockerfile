FROM php:8.2-fpm

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    supervisor \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    libpq-dev \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# =========================================================
# Composer
# =========================================================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# =========================================================
# Working directory
# =========================================================
WORKDIR /var/www/html

# =========================================================
# PHP configuration
# =========================================================
COPY docker/8.2/php.ini \
    /usr/local/etc/php/conf.d/99-custom.ini

# =========================================================
# Supervisor configuration
# =========================================================
COPY docker/8.2/supervisord.conf \
    /etc/supervisor/conf.d/supervisord.conf

# =========================================================
# Container startup script
# =========================================================
COPY docker/8.2/start-container \
    /usr/local/bin/start-container

RUN chmod +x /usr/local/bin/start-container

# =========================================================
# PHP-FPM
# =========================================================
EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/start-container"]