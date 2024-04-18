FROM php:8.3-fpm

ARG UID
ARG GID
ARG USER=books-app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl git libpng-dev libonig-dev libxml2-dev zip unzip nano \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif intl pcntl bcmath gd opcache

# Get the latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN groupadd --force -g $GID $USER
RUN useradd -s /bin/bash -m --no-user-group -g $GID -u $UID $USER
RUN mkdir -p /home/$USER/.composer && chown -R $USER:$USER /home/$USER

# Copy configuration and scripts
COPY start-container.sh /usr/local/bin/start-app-container.sh
COPY php.ini /usr/local/etc/php/conf.d/40-custom.ini
COPY www.conf /usr/local/etc/php-fpm.d/www.conf

# Set env
RUN chmod +x /usr/local/bin/start-app-container.sh

WORKDIR /var/www/html

USER $USER

ENTRYPOINT [ "bash", "/usr/local/bin/start-app-container.sh" ]
