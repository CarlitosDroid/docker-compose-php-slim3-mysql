FROM mysql:latest

ENV MYSQL_ROOT_PASSWORD android  
ENV MYSQL_DATABASE SLIM3DB  
ENV MYSQL_USER carlitos  
ENV MYSQL_PASSWORD android

ADD setup.sql /docker-entrypoint-initdb.d
