FROM php:latest

WORKDIR /app

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY composer.json .

RUN composer install

COPY . .

EXPOSE 8000

CMD ["php", "-S", "localhost:8000", "-t", "public"]
