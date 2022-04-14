FROM php:7.4-fpm

RUN apt-get update -y \
    && apt-get install -y nginx \
    ;
RUN apt-get install -yqq \
curl \
gdb \
git \
make \
procps \
sudo \
unzip \
vim \
wget \
supervisor \
cron \
;

RUN wget -q -O /usr/local/bin/install-php-extensions https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions \
    || (echo "Failed while downloading php extension installer!"; exit 1)

# install composer
  # curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN wget https://getcomposer.org/installer -O /tmp/installer && \
    cat /tmp/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    chmod 744 /usr/local/bin/composer && \
    rm /tmp/installer \
    ;
# install extensions
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && install-php-extensions \
    opcache \
    pdo_mysql \
    #imagick \
;
COPY ./.dockers/php/*  /usr/local/etc/php/conf.d/

WORKDIR /var/www
COPY ./.dockers/nginx/nginx.conf /etc/nginx/
COPY ./.dockers/sites-available/site.conf /etc/nginx/sites-available/

COPY --chown=www-data:www-data . ./
ADD --chown=www-data:www-data ./.dockers/start.sh /

RUN chmod +x /start.sh

# Install dependencies
RUN composer install --prefer-dist --no-scripts --no-autoloader && rm -rf /root/.composer
RUN composer dump-autoload --no-scripts --optimize
RUN php artisan optimize
RUN cp .env.example .env && php artisan key:generate
EXPOSE 80 443

ENTRYPOINT [ "sh", "-c", "/start.sh" ]