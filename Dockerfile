# Stage 1: Build React app
FROM node:18 AS build
WORKDIR /app
COPY Client/ .
RUN npm install && npm run build

# Stage 2: Serve React app
FROM nginx:alpine
WORKDIR /usr/share/nginx/html
COPY --from=build /app/dist .
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
