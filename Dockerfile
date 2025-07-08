# Use uma imagem base do PHP com Apache
FROM php:8.1-apache

# Instala as extensões PHP necessárias para o CakePHP e MySQL
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install -j$(nproc) intl pdo pdo_mysql mbstring zip

# Habilita o mod_rewrite do Apache para as URLs amigáveis
RUN a2enmod rewrite

# Instala o Composer (gerenciador de dependências do PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho dentro do contêiner
WORKDIR /var/www/html

# Copia o código da sua aplicação para dentro do contêiner
COPY . .

# Instala as dependências do projeto com o Composer
RUN composer install --no-interaction --optimize-autoloader

# Muda o dono dos arquivos para o usuário do Apache para evitar problemas de permissão
RUN chown -R www-data:www-data tmp logs