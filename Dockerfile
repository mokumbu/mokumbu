FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
	git \
	unzip \
	vim \
	curl \
	gettext-base \
	nginx \
	supervisor \
	&& rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install Node.js 20 (estável para Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
	&& apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer files first (better caching)
COPY composer.json composer.lock ./

# Copy application files
COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs

# Copy package files first (better caching)
COPY package*.json ./
RUN npm ci

# Build frontend
RUN npm run build

# Laravel permissions
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views \
	&& chown -R www-data:www-data storage bootstrap/cache

# Clear config cache
RUN php artisan config:clear && php artisan storage:link
RUN php artisan sitemap:generate

# Copy Nginx config
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Copy Supervisor config
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh /entrypoint.sh

RUN chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
CMD ["/usr/bin/supervisord"]
