FROM php:7.0-apache
COPY php.ini /usr/local/etc/php/
#COPY /php_project /var/www/html/carlitos/

#RUN apt-get update && apt-get install git-core -y
RUN docker-php-ext-install mysqli

EXPOSE 80

ENTRYPOINT /usr/sbin/apache2ctl -D FOREGROUND
