FROM php:7.1.33-fpm-alpine
MAINTAINER Luiz Ferreira <luiz.ferreira@outlook.com>

# problemas imagick

# Pacotes instalador por padrão: date, zlib, curl, Core, Phar, posix, session, Reflection, 
# PDO, pdo_sqlite, mbstring, libxml, mysqlnd, json, iconv, hash, fileinfo, filter, dom, ctype
# ftp, openssl, pcre, readline, SimpleXML, SPL, sqlite3, standard, tokenizer, xml, xmlreader, xmlwriter

# Atualização de pacotes e instalação das dependências
RUN apk update && apk add icu-dev libxslt-dev libedit-dev libmcrypt-dev oniguruma-dev gettext-dev gmp-dev imagemagick libpng-dev libxml2-dev zlib libcurl bzip2-dev build-base libgit2-dev && \
    ln -s /usr/lib/libcurl.so.4 /usr/lib/libcurl-gnutls.so.4 && \
    docker-php-ext-install bz2 calendar exif intl gd gettext gmp mysqli mcrypt pcntl pdo_mysql shmop \
    soap sockets sysvmsg sysvsem sysvshm wddx xsl zip
