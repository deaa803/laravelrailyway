# 1. استخدم صورة PHP 8.2 مع Apache
FROM php:8.2-apache

# 2. ثبّت أدوات النظام والإضافات المطلوبة
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libcurl4-openssl-dev pkg-config libssl-dev zlib1g-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# 3. إعداد مجلد العمل
WORKDIR /var/www/html

# 4. نسخ ملفات المشروع
COPY . .

# 5. تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# 6. تشغيل Composer بدون dev
RUN composer install --no-dev --optimize-autoloader || echo "composer install failed but continuing..."

# 7. صلاحيات مجلدات Laravel
RUN chown -R www-data:www-data storage bootstrap/cache
