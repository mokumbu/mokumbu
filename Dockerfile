FROM php:8.2.9-apache

# Enable Apache modules
RUN a2enmod rewrite

# Set PHP upload limits
RUN echo "upload_max_filesize=10M\npost_max_size=10M" > /usr/local/etc/php/conf.d/uploads.ini
RUN echo "php_value upload_max_filesize 100M" >> /etc/apache2/apache2.conf
RUN echo "php_value post_max_size 100M" >> /etc/apache2/apache2.conf

# Set the COMPOSER_ALLOW_SUPERUSER environment variable
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV NODE_VERSION=20.10.0

WORKDIR /var/www/html
COPY . .

RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install required packages
RUN apt-get update && apt-get install -y \
	git \
	unzip \
	vim \
	gettext-base \
	&& curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
	&& apt-get install -y --no-install-recommends nodejs \
	&& rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies with Composer
RUN composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist --ignore-platform-reqs

RUN a2enmod rewrite

# Install npm
RUN npm install -g yarn
RUN yarn
RUN yarn build

RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views \
	&& chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
	&& php artisan config:clear && php artisan storage:link

COPY entrypoint.sh /entrypoint.sh
RUN chmod +x entrypoint.sh

EXPOSE 80
ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]
