# 1. استخدم صورة PHP 8.2 مع Apache (أو FPM حسب مشروعك)
FROM php:8.2-apache

# 2. ثبّت أدوات البناء والإضافات المطلوبة
RUN apt-get update && \
    apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev zlib1g-dev

# 4. ثبّت امتدادات PDO لقاعدة البيانات (مثال MySQL)
RUN docker-php-ext-install pdo_mysql

# 5. أنسخ الكود للمجلد الافتراضي في الحاوية
COPY . /var/www/html
WORKDIR /var/www/html

# 6. ثبّت Composer وحزمه بدون تطوير optimize
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

# 7. (اختياري) أضبط الأذونات إن احتجت
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
