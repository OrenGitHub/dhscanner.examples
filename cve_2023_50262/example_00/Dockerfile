FROM php:7.4
RUN apt-get update
RUN apt-get install zip -y
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN composer create-project laravel/laravel frontend
WORKDIR frontend
RUN composer require phenx/php-svg-lib:0.4.0
RUN composer require dompdf/dompdf:v2.0.1
COPY web.php routes/web.php
COPY Cpdf.php vendor/dompdf/dompdf/lib/Cpdf.php
EXPOSE 8000
CMD [ "php", "artisan", "serve", "--host", "0.0.0.0" ]