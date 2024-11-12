# Use a base image that supports both Node.js and PHP
FROM node:18 AS client-build

# Set the working directory
WORKDIR /app/Client

# Copy client files
COPY Client/ .

# Install dependencies and build the React app
RUN npm install && npm run build

# Use a base image for PHP
FROM php:8.2-apache AS server

# Set the working directory
WORKDIR /var/www/html

# Copy server files
COPY Server/ .

# Copy the built React app into the server's public folder
COPY --from=client-build /app/Client/dist ./public

# Install PHP extensions if necessary (e.g., PDO for MySQL)
RUN docker-php-ext-install pdo pdo_mysql

# Expose the default Apache port
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]
