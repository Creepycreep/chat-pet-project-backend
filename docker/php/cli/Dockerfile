FROM php:8.3.16-cli-alpine3.20

WORKDIR /var/www/html

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN install-php-extensions \
    pdo_pgsql \
    uuid \
    xdebug-stable \
 > /dev/null
RUN rm /usr/bin/install-php-extensions

RUN cp $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini
