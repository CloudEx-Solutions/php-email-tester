FROM php:7.4-cli
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    zlib1g-dev \
    tcpdump \
    unzip \
    git \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# Copy composer.json and install dependencies
WORKDIR /app
COPY composer.json /app/composer.json
RUN composer install
COPY . /app

ENTRYPOINT ["php", "email.php"]