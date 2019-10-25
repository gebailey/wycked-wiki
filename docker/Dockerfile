FROM amazonlinux:2
RUN amazon-linux-extras install php7.3; \
    yum -y install httpd php procps; \
    yum -y erase php-fpm; \
    rm -rf /var/cache/yum/x86_64/2/amzn2-core/* /var/cache/yum/x86_64/2/amzn2extra-php7.3
COPY php/ /var/www/html/
COPY docker/run.sh /
CMD /run.sh
EXPOSE 80
