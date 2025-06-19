FROM php:8.3-fpm

# 1️⃣ Instalar ferramentas e adicionar repositório Microsoft com chave GPG certa
RUN apt-get update && apt-get install -y \
    gnupg2 \
    curl \
    libpng-dev \
    libzip-dev \
    zlib1g-dev \
    unixodbc-dev \
    g++ \
    make \
    autoconf \
    pkg-config \
    libssl-dev \
    libonig-dev \
    libxml2-dev \
    libicu-dev \
    zip \
    unzip && \
    curl -fsSL https://packages.microsoft.com/keys/microsoft.asc | gpg --dearmor \
      -o /usr/share/keyrings/microsoft-prod.gpg && \
    echo "deb [signed-by=/usr/share/keyrings/microsoft-prod.gpg] \
      https://packages.microsoft.com/debian/12/prod bookworm main" \
      > /etc/apt/sources.list.d/mssql-release.list

# 2️⃣ Instalar ODBC Driver 18 e mssql-tools
RUN apt-get update && \
    ACCEPT_EULA=Y apt-get install -y msodbcsql18 mssql-tools

# 3️⃣ Instalar extensões sqlsrv e pdo_sqlsrv
RUN pecl install sqlsrv pdo_sqlsrv && \
    docker-php-ext-enable sqlsrv pdo_sqlsrv

# 4️⃣ Instalar extensões PHP extras
RUN docker-php-ext-install gd zip intl bcmath opcache

# Copiar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN mkdir -p storage bootstrap/cache && \
    chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

EXPOSE 9000
