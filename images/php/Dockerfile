FROM php:7.4-fpm

ARG APP_ID=1000
RUN groupadd -g "$APP_ID" app \
    && useradd -g "$APP_ID" -u "$APP_ID" -d /var/www -s /bin/bash app

RUN mkdir -p /etc/nginx/html /var/www/html /sock \
    && chown -R app:app /etc/nginx /var/www /usr/local/etc/php/conf.d /sock

RUN apt-get update && apt-get install -y \
    git \
    gzip \
    zip

RUN pecl install xdebug \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer


COPY ./conf/xdebug.ini $PHP_INI_DIR/conf.d/xdebug.ini
COPY conf/php.ini $PHP_INI_DIR
COPY conf/php-fpm.conf /usr/local/etc/
COPY conf/www.conf /usr/local/etc/php-fpm.d/

USER app:app

VOLUME /var/www

WORKDIR /var/www/html