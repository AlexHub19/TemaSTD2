FROM drupal

WORKDIR /var/www/html/sites/default
COPY settings.php .
RUN chmod 666 settings.php
WORKDIR /opt/drupal
EXPOSE 80