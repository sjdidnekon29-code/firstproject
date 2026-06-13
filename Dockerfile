FROM php:8.2-cli

WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip zip curl git \
    libzip-dev libpng-dev libonig-dev libxml2-dev

# Install PHP extensions required by Laravel
RUN docker-php-ext-install \
    pdo pdo_mysql mbstring zip exif pcntl bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Permissions (VERY IMPORTANT)
RUN chmod -R 775 storage bootstrap/cache

# Optimize Laravel
RUN php artisan config:clear || true
RUN php artisan cache:clear || true

EXPOSE 10000

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=$PORT