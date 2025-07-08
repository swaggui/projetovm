# Use a imagem base do PHP com Apache
FROM php:8.2-apache

# Instala dependências do sistema e as extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install -j$(nproc) intl pdo pdo_mysql mbstring zip pdo_sqlite

# Habilita o mod_rewrite do Apache
RUN a2enmod rewrite

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do projeto
COPY . .

# Instala as dependências do Composer
RUN composer install --no-interaction --optimize-autoloader

# Ajusta as permissões das pastas
RUN chown -R www-data:www-data tmp logs
