FROM alpine:edge


RUN echo "@test http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories

RUN apk add --no-cache \
    php7 \
    php7-json \
    php7-mbstring \
    php7-openssl \
    php7-bcmath \
    php7-pcntl \
    php7-tideways_xhprof@test \
    composer \
    util-linux \
    curl

WORKDIR /usr/src/app

COPY composer.* /usr/src/app/
RUN composer install

ENV PATH=bin:vendor/bin:$PATH

COPY . .
