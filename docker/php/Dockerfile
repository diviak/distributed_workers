FROM php:7.4-fpm
RUN apt-get update && apt-get install -y zip unzip \
    && docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli

# ssh
RUN mkdir /root/.ssh/
COPY opt/ssh_config /home/root/.ssh/config

# composer
RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');"
RUN php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer