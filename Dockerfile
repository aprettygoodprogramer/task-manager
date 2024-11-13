# Build Frontend (React)
FROM node:18 AS build

# Set working directory for the frontend
WORKDIR /app

# Copy the entire Client folder into the container
COPY Client/ ./Client/

# Change to the Client directory and install dependencies
WORKDIR /app/Client
RUN npm install && npm run build

# Deploy Backend (PHP with Apache)
FROM php:8.2-apache

# Set working directory for the backend
WORKDIR /var/www/html

# Copy built frontend assets into the server's public directory
COPY --from=build /app/Client/dist/ /var/www/html/

