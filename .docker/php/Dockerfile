ARG DEBIAN_VERSION=bookworm

FROM debian:${DEBIAN_VERSION}-slim AS php
USER root

ARG DEBIAN_VERSION
ARG PHP_VERSION
ENV DEBIAN_VERSION=$DEBIAN_VERSION
ENV PHP_VERSION=8.3

RUN apt update -y
RUN apt install -y --no-install-recommends --no-install-suggests ca-certificates curl memcached openssl

RUN curl -o /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ ${DEBIAN_VERSION} main" | tee /etc/apt/sources.list.d/php.list

RUN apt update -y
RUN apt install -y --no-install-recommends --no-install-suggests \
   php${PHP_VERSION} \
   php${PHP_VERSION}-common \
   php${PHP_VERSION}-cli \
   php${PHP_VERSION}-curl \
   php${PHP_VERSION}-ds \
   php${PHP_VERSION}-fileinfo \
   php${PHP_VERSION}-xml \
   php${PHP_VERSION}-mbstring \
   php${PHP_VERSION}-pcov \
   php${PHP_VERSION}-xdebug

RUN apt remove apache* -y
RUN apt purge apache* -y
RUN apt autoremove -y

FROM php AS composer
USER root

RUN apt install -y zip unzip git composer
WORKDIR /app
ENTRYPOINT ["composer"]
CMD "about"

FROM php AS phpunit

WORKDIR /app
ENTRYPOINT ["./vendor/bin/phpunit"]