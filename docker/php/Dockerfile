FROM php:7.4-fpm

ARG HOST_UID

VOLUME ["/var/www/html"]

COPY php.ini /usr/local/etc/php/php.ini

RUN apt-get update && apt-get install -y \
        sudo \
        zlib1g-dev \
        libicu-dev \
        libpq-dev \
        libonig-dev \
        git \
        vim \
        libzip-dev \
        zip \
        unzip \
        wget \
        mc \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        gnupg2 \
        htop \
        nano \
        mariadb-client
#        autoconf \
#        automake \
#        libtool \
#        make \
#        gcc

#RUN pecl install mcrypt-1.0.3
#RUN pecl install protobuf-3.11.2

RUN docker-php-ext-install -j$(nproc) pdo_mysql mysqli \
    && docker-php-ext-configure bcmath \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-install -j$(nproc) bcmath \
    && docker-php-ext-configure mbstring \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) intl opcache pcntl \
    && docker-php-ext-configure calendar --enable-calendar \
    && docker-php-ext-install -j$(nproc) calendar
#    && docker-php-ext-enable mcrypt

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# install composer
RUN set -x && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# prepare permissions
RUN usermod -u ${HOST_UID} www-data && groupmod -g ${HOST_UID} www-data
RUN chsh -s /bin/bash www-data
RUN chown -R www-data:www-data /var/www

# protoc
#RUN cd /tmp \
#    && git clone https://github.com/protocolbuffers/protobuf.git \
#    && cd protobuf \
#    && git submodule update --init --recursive \
#    && ./autogen.sh \
#    && ./configure \
#    && make \
#    && make check \
#    && make install \
#    && ldconfig

# ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

WORKDIR /var/www/html

CMD ["php-fpm"]

EXPOSE 80
