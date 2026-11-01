#!/bin/sh
set -e

# Setup .env if it does not exist
if [ ! -f /var/www/html/.env ]; then
    echo "[Entrypoint] Copying .env.example to .env..."
    cp /var/www/html/.env.example /var/www/html/.env
fi

# Configure Database in .env from environment variables if provided
if [ -n "$DB_CONNECTION" ]; then
    sed -i "s/^DB_CONNECTION=.*/DB_CONNECTION=$DB_CONNECTION/" /var/www/html/.env
fi
if [ -n "$DB_HOST" ]; then
    sed -i "s/^# DB_HOST=.*/DB_HOST=$DB_HOST/" /var/www/html/.env
    sed -i "s/^DB_HOST=.*/DB_HOST=$DB_HOST/" /var/www/html/.env
fi
if [ -n "$DB_PORT" ]; then
    sed -i "s/^# DB_PORT=.*/DB_PORT=$DB_PORT/" /var/www/html/.env
    sed -i "s/^DB_PORT=.*/DB_PORT=$DB_PORT/" /var/www/html/.env
fi
if [ -n "$DB_DATABASE" ]; then
    sed -i "s/^# DB_DATABASE=.*/DB_DATABASE=$DB_DATABASE/" /var/www/html/.env
    sed -i "s/^DB_DATABASE=.*/DB_DATABASE=$DB_DATABASE/" /var/www/html/.env
fi
if [ -n "$DB_USERNAME" ]; then
    sed -i "s/^# DB_USERNAME=.*/DB_USERNAME=$DB_USERNAME/" /var/www/html/.env
    sed -i "s/^DB_USERNAME=.*/DB_USERNAME=$DB_USERNAME/" /var/www/html/.env
fi
if [ -n "$DB_PASSWORD" ]; then
    sed -i "s/^# DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" /var/www/html/.env
    sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" /var/www/html/.env
fi

# Ensure storage and bootstrap/cache permissions
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache

# Generate APP_KEY if empty or not set
if ! grep -q "^APP_KEY=base64:" /var/www/html/.env; then
    echo "[Entrypoint] Generating application encryption key..."
    php artisan key:generate --force
fi

# Wait for database connection if DB_CONNECTION is mysql
if [ "$DB_CONNECTION" = "mysql" ]; then
    echo "[Entrypoint] Waiting for database at $DB_HOST:$DB_PORT..."
    while ! nc -z "$DB_HOST" "$DB_PORT" 2>/dev/null; do
        sleep 1
    done
    echo "[Entrypoint] Database is reachable!"
    sleep 2
fi

# Run database migrations
echo "[Entrypoint] Running database migrations..."
php artisan migrate --force

exec "$@"
