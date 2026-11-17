# --- STAGE 1: BUILDER ---
# Menggunakan Node.js ringan untuk proses kompilasi aset aplikasi
FROM node:20-alpine AS builder
WORKDIR /app
COPY . .
RUN mkdir -p dist && echo "<h1>Testing</h1>" > dist/index.html

# --- STAGE 2: PRODUCTION ---
# Hanya mengambil hasil build dari Stage 1 dan menjalankannya di Nginx
FROM nginx:alpine
COPY --from=builder /app/dist /usr/share/nginx/html
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]