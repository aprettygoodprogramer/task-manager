# Stage 1: Build React app
FROM node:18 AS build
WORKDIR /app
COPY Client/ /app/
  # Assumes React code is in the Client folder
RUN npm install && npm run build

# Stage 2: Serve React app with NGINX
FROM nginx:alpine
COPY --from=build /app/dist /usr/share/nginx/html
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
