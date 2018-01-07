FROM alpine:edge as tideways

    RUN apk add --no-cache php7-dev g++ make

    WORKDIR /tideways
    ADD https://github.com/tideways/php-profiler-extension/archive/master.tar.gz tideways.tar.gz
    RUN tar xvfz tideways.tar.gz

    WORKDIR /tideways/php-profiler-extension-master

    RUN phpize
    RUN ./configure
    RUN make

FROM alpine:edge as memprof

    RUN apk add --update alpine-sdk
    RUN adduser -u 1000 -G abuild -D abuilder
    WORKDIR /home/abuilder/build
    RUN chown 1000:1000 . && chmod -R 777 /var/cache
    USER abuilder
    RUN abuild-keygen -a -i

    COPY memprof/APKBUILD ./

    RUN abuild checksum
    RUN abuild -r

    USER root
    RUN apk add php7-pear php7-openssl php7-dev bsd-compat-headers
    RUN apk add --no-cache --allow-untrusted /home/abuilder/packages/abuilder/x86_64/*.apk
    RUN pecl channel-update pecl.php.net
    RUN php /usr/share/php7/peclcmd.php install memprof


FROM alpine:edge

    COPY --from=memprof /home/abuilder/packages/abuilder/x86_64/ /packages
    COPY --from=memprof /usr/lib/php7/modules/memprof.so /usr/lib/php7/modules/
    RUN apk add --no-cache --allow-untrusted /packages/*.apk

    COPY --from=tideways /tideways/php-profiler-extension-master/modules/tideways_xhprof.so /usr/lib/php7/modules/

    ADD https://getcomposer.org/download/1.5.0/composer.phar /usr/local/bin/composer
    RUN chmod a+rx /usr/local/bin/composer

    RUN apk add --no-cache php7 php7-phar php7-json php7-mbstring php7-openssl php7-bcmath php7-tokenizer

    WORKDIR /usr/src/app

    COPY php.ini /etc/php7/
    COPY composer.* /usr/src/app/
    RUN composer install

    ENV PATH=bin:vendor/bin:$PATH

    COPY . .

    #RUN apk add --no-cache php7-xml php7-iconv php7-ctype php7-dom
