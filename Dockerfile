FROM php:8-apache

# Copiar os arquivos do projeto para o diretório operacional
COPY src/ /var/www/html

RUN mkdir -p /data && chown www-data /data
VOLUME [ "/data" ]