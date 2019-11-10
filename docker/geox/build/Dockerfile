FROM php:7.3.8-fpm-alpine3.10

# Install dependencies
RUN set -eux; \
    apk add --no-cache \
        libzip-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        freetype-dev \
        libmemcached-dev \
        yaml-dev \
    ;

RUN set -eux; \
    # Install temp packages
    apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
    ; \
    # Configure Core Extensions
    docker-php-ext-configure zip --with-libzip; \
    docker-php-ext-configure gd --with-jpeg-dir --with-png-dir --with-freetype-dir; \
    docker-php-ext-install -j$(nproc) \
        opcache \
        pdo_mysql \
        sockets \
        bcmath \
        zip \
        gd \
    ; \
    pecl install \
        memcached-3.1.3 \
        yaml-2.0.4 \
        xdebug-2.7.2 \
    ; \
    docker-php-ext-enable \
        memcached \
        yaml \
        xdebug \
    ; \
    # Delete temp packages
    apk del --no-network --no-cache .build-deps

COPY ./php.ini $PHP_INI_DIR

# Install Composer
ENV COMPOSER_VERSION 1.8.6
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /tmp/composer
RUN curl --silent --fail --location --retry 3 --output /tmp/installer.php --url https://raw.githubusercontent.com/composer/getcomposer.org/cb19f2aa3aeaa2006c0cd69a7ef011eb31463067/web/installer; \
    php -r " \
    \$signature = '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5'; \
    \$hash = hash('sha384', file_get_contents('/tmp/installer.php')); \
    if (!hash_equals(\$signature, \$hash)) { \
      unlink('/tmp/installer.php'); \
      echo 'Integrity check failed, installer is either corrupt or worse.' . PHP_EOL; \
      exit(1); \
    }"; \
    php /tmp/installer.php --no-ansi --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION}; \
    composer --ansi --version --no-interaction; \
    rm -f /tmp/installer.php; \
    chmod -v 1777 /tmp/composer


WORKDIR /var/www/html/geox

EXPOSE 9000

CMD ["php-fpm"]
