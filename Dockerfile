# Dockerfile
FROM php:8.0-fpm

WORKDIR /app

RUN apt-get update && apt-get -y install python3-pip git zip sudo wget nodejs gnupg \
    zlib1g-dev libzip-dev libicu-dev libpng-dev libonig-dev libgmp-dev iverilog arachne-pnr \
    arachne-pnr-chipdb fpga-icestorm fpga-icestorm-chipdb

RUN docker-php-ext-install pdo pdo_mysql mysqli pcntl zip intl gd mbstring gmp exif
RUN pecl install redis && \
    docker-php-ext-enable redis

ENV COMPOSER_HOME /composer
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer
ENV PATH ./vendor/bin:/composer/vendor/bin:$PATH
RUN curl -o- -L https://yarnpkg.com/install.sh | bash -s --
ENV PATH /root/.yarn/bin:/root/.config/yarn/global/node_modules/.bin:$PATH

RUN curl -O http://zlib.net/zlib-1.2.12.tar.gz && \
    tar xvf zlib-1.2.12.tar.gz && \
    cd zlib-1.2.12 && \
    ./configure && \
    echo "#define MAX_WBITS  13\n$(cat zconf.h)" > zconf.h && \
    make && \
    cp minigzip /usr/local/bin/

RUN pip install pyflakes==2.2.0

COPY . /app
COPY .env.quick /app/.env

RUN mkdir -p storage/framework/views
RUN composer install
RUN chmod -R 777 bootstrap/cache storage

RUN yarn && yarn production

RUN yarn global add laravel-echo-server

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host", "0.0.0.0"]

