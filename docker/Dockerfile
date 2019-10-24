FROM amazonlinux:2
RUN yum -y install httpd php php-mysql procps && rm -rf /var/cache/yum/x86_64/2/amzn2-core/*
COPY php/ /var/www/html/
COPY docker/run.sh /
CMD /run.sh
EXPOSE 80
