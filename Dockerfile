# docker/php/Dockerfile
FROM php:8.1-fpm

RUN apt-get update
RUN docker-php-ext-install pdo_mysql