# Use the official PHP image as a base
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y entr

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy the application code
COPY . .

RUN git config --global --add safe.directory /var/www/html

# Install Symfony dependencies
RUN composer install --no-interaction --optimize-autoloader

# Set permissions for cache and logs
RUN mkdir -p var/cache var/log && \
    chown -R www-data:www-data var/cache var/log && \
    chmod -R 775 var

# Expose port
EXPOSE 9000

# Start the PHP-FPM server
CMD ["php-fpm"]
