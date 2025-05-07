FROM php:8.4-alpine

WORKDIR /app

# Install needed PHP extensions
# RUN docker-php-ext-install sockets

COPY composer.json ./
COPY scripts/install_composer.sh ./

RUN chmod +x install_composer.sh && \
    ./install_composer.sh && \
    php composer.phar update

COPY . .

CMD ["php", "src/infra/ws/server.php"]
