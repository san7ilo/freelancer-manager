# Usar la imagen oficial de Nginx
FROM nginx:alpine

# Copiar la configuración de Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Copiar los archivos estáticos del frontend
COPY ../../frontend/dist /usr/share/nginx/html

# Exponer el puerto 80
EXPOSE 80