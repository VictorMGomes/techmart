FROM php:apache

RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite headers cache cache_disk

RUN sed -i 's#^CacheRoot .*$#CacheRoot /var/cache/apache2#' /etc/apache2/mods-available/cache_disk.conf

RUN echo "CacheEnable disk /" >> /etc/apache2/sites-available/000-default.conf
RUN echo "CacheMaxExpire 86400" >> /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]
