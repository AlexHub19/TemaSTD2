FROM mysql
ENV MYSQL_DATABASE=drupal_database
ENV MYSQL_USER=drupal
ENV MYSQL_PASSWORD=test
ENV MYSQL_ROOT_PASSWORD=test
COPY backup.sql /docker-entrypoint-initdb.d/
EXPOSE 3306