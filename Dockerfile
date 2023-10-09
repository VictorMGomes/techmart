# Use the php:apache base image
FROM php:apache

# Install PHP extensions (e.g., mysqli, pdo, pdo_mysql)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache modules (e.g., rewrite, headers)
RUN a2enmod rewrite headers

# Expose port 80
EXPOSE 80
