FROM php:latest

WORKDIR /app

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY --from=node:latest /usr/local/bin/node /usr/local/bin/node
COPY --from=node:latest /usr/local/bin/npm /usr/local/bin/npm

COPY composer.json .
COPY package.json .

RUN composer install && npm i

COPY . .

EXPOSE 8000

CMD ["php", "-S", "localhost:8000", "-t", "public"]
