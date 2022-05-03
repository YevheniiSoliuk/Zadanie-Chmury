#Autor skryptu: Yevhenii Soliuk
FROM scratch
ADD alpine-minirootfs-3.15.4-x86_64.tar.gz /
RUN apk add --update apache2 php-apache2 php && \ 
rm -rf /var/cache/apk/* && \
rm -rf /var/www/localhost/htdocs/index.html
COPY . /var/www/localhost/htdocs/
RUN chmod 755 /var/www/localhost/htdocs/index.php
EXPOSE 80/tcp
CMD httpd -DFOREGROUND
