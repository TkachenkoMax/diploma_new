FROM eugenebalaban/laravel-php-fpm-debug

RUN apk update && apk add git bash openssh mysql-client