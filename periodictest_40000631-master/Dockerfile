FROM php:7.2-apache
RUN docker-php-ext-install mysqli
RUN apt-get update && apt-get -y install sendmail
RUN sendmailconfig
COPY msmtprc /etc/msmtprc
RUN chmod 600 /etc/msmtprc
RUN chown www-data:www-data /etc/msmtprc
RUN echo "sendmail_path=/usr/bin/msmtp -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini
COPY src/ /var/www/html/
