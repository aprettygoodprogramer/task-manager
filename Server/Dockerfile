# Use an official PHP image as the base
FROM php:8.2-apache

# Set the working directory
WORKDIR /var/www/html

# Copy your application code to the container
COPY . .

# Install required extensions (if any)
RUN docker-php-ext-install mysqli pdo pdo_mysql

EXPOSE 80

CMD ["apache2-foreground"]
