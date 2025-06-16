FROM php:8.3-fpm-alpine3.19

# Instalar dependências
RUN apk add --no-cache \
    bash \
    curl \
    libpng-dev \
    libzip-dev \
    zlib-dev

# Instalar extensões PHP
RUN docker-php-ext-install gd \
    && docker-php-ext-install zip

# Copiar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir o diretório de trabalho
WORKDIR /var/www

# Criar diretórios caso não existam
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache && \
    chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache && \
    chmod -R 775 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
