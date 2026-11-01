FROM php:8.2-cli

# Set environment
ENV DEBIAN_FRONTEND=noninteractive

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    sqlite3 \
    libsqlite3-dev \
    default-mysql-client \
    netcat-openbsd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring zip bcmath

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install Node.js (v20)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Copy project files
COPY . .

# Normalize entrypoint line endings and set permissions
RUN sed -i 's/\r$//' /var/www/html/docker-entrypoint.sh \
    && chmod +x /var/www/html/docker-entrypoint.sh \
    && cp /var/www/html/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

# Install Composer dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Install NPM dependencies and build production assets
RUN npm install && npm run build

# Expose port 8000
EXPOSE 8000

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
