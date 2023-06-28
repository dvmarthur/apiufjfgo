# Usar a imagem base do PHP
FROM php:7.4-apache

# Diretório de trabalho dentro do container
WORKDIR /var/www/html

# Copiar os arquivos da aplicação para o container
COPY . /var/www/html

# Instalar as dependências do Laravel usando o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction

# Definir as variáveis de ambiente do Laravel
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
ENV APACHE_LOG_DIR=/var/www/html/storage/logs

# Habilitar o módulo de reescrita do Apache
RUN a2enmod rewrite

# Expor a porta do Apache
EXPOSE 80

# Comando para iniciar o Apache quando o container for iniciado
CMD ["apache2-foreground"]
