# Usar la imagen oficial de MySQL
FROM mysql:5.7

# Establecer variables de entorno para la configuración de MySQL
ENV MYSQL_ROOT_PASSWORD=root_password
ENV MYSQL_DATABASE=freelancer_manager
ENV MYSQL_USER=user
ENV MYSQL_PASSWORD=user_password

# Copiar scripts de inicialización si es necesario
# COPY ./init-db.sql /docker-entrypoint-initdb.d/

# Exponer el puerto de MySQL
EXPOSE 3306