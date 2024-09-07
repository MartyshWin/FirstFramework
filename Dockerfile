# Используем официальный образ PHP 8.1 FPM
FROM php:8.1-fpm

# Устанавливаем необходимые расширения для PHP
RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
	libpng-dev \
	libonig-dev \
	libzip-dev \
	libmcrypt-dev \
    php-mysqli \
    php-common \
    php-mysql \
    php-cli \
    && pecl install redis-5.3.7 \
        && pecl install mcrypt-1.0.3 \
	&& docker-php-ext-enable mcrypt \
        && docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo pdo_mysql zip mysqli \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd


# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем утилиту nano и micro для редактирования файлов
RUN apt-get update && apt-get install -y nano micro

# Указываем рабочую директорию
WORKDIR /var/www/html

# Копируем зависимости проекта
COPY . /var/www/html

# Устанавливаем зависимости Composer (если есть)
RUN composer install