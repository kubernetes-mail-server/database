FROM php:fpm-alpine

# install all the required software for the container to run correctly
RUN apk --no-cache add mysql-client

RUN docker-php-ext-install pdo_mysql

ADD . /www
WORKDIR /www

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install \
        --prefer-dist \
        --no-dev \
        --no-scripts \
        --no-progress \
        --no-suggest \
        --ignore-platform-reqs \
        --working-dir /www

RUN chmod +x /www/entrypoint.sh

ENTRYPOINT ["/www/entrypoint.sh"]
CMD ["/www/vendor/bin/phinx", "migrate", "-c", "/www/migrations/phinx.yml"]