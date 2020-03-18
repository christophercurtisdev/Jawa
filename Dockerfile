FROM php:7.4-apache

RUN apt-get update \
 && apt-get install -y vim git zlib1g-dev mariadb-client libzip-dev \
 && docker-php-ext-install zip pdo_mysql \
 #&& pecl install xdebug \
 # && docker-php-ext-enable xdebug \
 && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

#ADD config/xdebug.ini          /usr/local/etc/php/xdebug.ini
ADD config/php.ini /usr/local/etc/php/php.ini
ADD config/apache.conf         /etc/apache2/sites-available/jawa.conf

RUN a2enmod rewrite
RUN a2ensite jawa.conf
RUN a2dissite 000-default.conf

WORKDIR /var/www/jawa