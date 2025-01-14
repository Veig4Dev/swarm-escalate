FROM php:8.0-fpm

# Instalar dependências necessárias para extensões
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql sockets \
    && apt-get clean

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos do Composer para dentro do contêiner
COPY composer.json composer.lock ./

# Instalar dependências do Composer
RUN composer install --no-scripts --no-autoloader

# Copiar restante da aplicação
COPY . .

# Gerar autoload
RUN composer dump-autoload --optimize
