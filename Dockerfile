# Utiliza la imagen base de Docker
FROM docker:latest

# Copia el archivo docker-compose.yml al contenedor
COPY docker-compose.yml .

# Instala Docker Compose
RUN apk add --no-cache docker-compose

# Establece el directorio de trabajo
WORKDIR /app

# Ejecuta el comando para levantar los servicios definidos en docker-compose.yml
CMD ["docker-compose", "up"]
