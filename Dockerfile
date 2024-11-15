# Step 1: Build the React app
FROM node:18 AS build
WORKDIR /app

# Copy the Client package files
COPY Client/package.json Client/package-lock.json ./Client/

# Install dependencies in the Client directory
RUN cd Client && npm install

# Copy the rest of the Client files
COPY Client ./Client

# Build the React app
RUN cd Client && npm run build

# Step 2: Set up Apache (httpd) to serve the React app
FROM httpd:2.4
WORKDIR /usr/local/apache2/htdocs/

# Clean the default Apache directory
RUN rm -rf /usr/local/apache2/htdocs/*

# Copy the build files from the previous stage
COPY --from=build /app/Client/dist/ /usr/local/apache2/htdocs/

# Expose port 80
EXPOSE 80

# Run Apache in the foreground
CMD ["httpd-foreground"]
