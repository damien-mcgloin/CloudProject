FROM php:7.2-apache
RUN apt-get update && apt-get install -y cron curl
COPY src/crontab /etc/cron.d/example-crontab
RUN chmod 0644 /etc/cron.d/example-crontab &&\crontab /etc/cron.d/example-crontab
ENTRYPOINT ["cron", "-f"]
