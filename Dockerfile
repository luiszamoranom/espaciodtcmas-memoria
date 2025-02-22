FROM php:8.2-fpm

RUN echo "max_execution_time=0" > /usr/local/etc/php/conf.d/max_execution_time.ini

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    postgresql-client \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd zip

RUN git config --global --add safe.directory /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install

RUN mkdir -p /var/www/html/storage/framework/views \
    && chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache \

RUN chmod -R gu+w storage
RUN chmod -R guo+w storage
