FROM php:8.1

ENV COMPOSER_ALLOW_SUPERUSER 1
WORKDIR /var/www

# Install system dependencies
RUN apt-get update -y && apt-get install -y \
    openssl zip unzip git libpq-dev mariadb-client curl gnupg

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - \
    && apt-get install -y nodejs

# Install PHP extensions
RUN docker-php-ext-install pdo mysqli pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application code
COPY ../src /var/www

# Install PHP and Node.js dependencies
RUN composer install --ignore-platform-reqs \
    && npm install

# Expose the port
EXPOSE 80
