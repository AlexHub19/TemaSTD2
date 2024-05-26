FROM mariadb

ENV MARIADB_USER=user
ENV MARIADB_PASSWORD=test
ENV MARIADB_ROOT_PASSWORD=test
ENV MARIADB_DATABASE=MessageAttributes

COPY backup.sql /docker-entrypoint-initdb.d/

EXPOSE 3333
