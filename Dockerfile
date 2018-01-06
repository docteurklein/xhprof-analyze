FROM alpine:edge as tideways

RUN apk add --no-cache php7-dev g++ make

WORKDIR /tideways
ADD https://github.com/tideways/php-profiler-extension/archive/master.tar.gz tideways.tar.gz
RUN tar xvfz tideways.tar.gz

WORKDIR /tideways/php-profiler-extension-master

RUN phpize
RUN ./configure
RUN make

FROM alpine:edge

RUN apk add --no-cache php7 php7-phar php7-json php7-mbstring php7-openssl php7-bcmath
COPY --from=tideways /tideways/php-profiler-extension-master/modules/tideways_xhprof.so /usr/lib/php7/modules/

ADD https://getcomposer.org/download/1.5.0/composer.phar /usr/local/bin/composer
RUN chmod a+x /usr/local/bin/composer

WORKDIR /usr/src/app

COPY php.ini /etc/php7/
COPY composer.* /usr/src/app/
RUN composer install

COPY . .

RUN apk add --no-cache php7-xml php7-iconv php7-ctype php7-dom
