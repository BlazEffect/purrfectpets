ARG PHP_VERSION

FROM php:${PHP_VERSION}-fpm

RUN apt-get update && apt-get install -y openssl zip unzip git libonig-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install mbstring pdo_mysql

RUN apt-get -y update \
&& apt-get install -y libicu-dev libzip-dev zip \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl \
&& docker-php-ext-install zip

COPY ./build/backend/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 9000

ENTRYPOINT ["/bin/sh", "/entrypoint.sh"]
CMD ["php-fpm"]
