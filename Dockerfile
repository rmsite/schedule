FROM wyveo/nginx-php-fpm:latest
WORKDIR /usr/share/nginx/
COPY ./.docker/nginx/default.conf /etc/nginx/conf.d/default.conf
RUN rm -rf /usr/share/nginx/html
COPY . /usr/share/nginx
RUN chmod -R 775 /usr/share/nginx/storage/
RUN ln -s public html
RUN chmod -R gu+w storage
RUN chmod -R guo+w storage
RUN php artisan cache:clear