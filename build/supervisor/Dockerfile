ARG PHP_VERSION

FROM php:${PHP_VERSION}-fpm

RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get -y update && apt-get install -y supervisor

RUN mkdir -p "/etc/supervisor/logs"

CMD ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisor/supervisord.conf"]