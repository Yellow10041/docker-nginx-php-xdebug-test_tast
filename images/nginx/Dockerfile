FROM nginx:1.18-alpine

ARG APP_ID=1000

RUN addgroup -g "$APP_ID" app \
    && adduser -g app -u "$APP_ID" -h /var/www -s /bin/bash -S app 

RUN touch /var/run/nginx.pid

RUN mkdir /sock

RUN mkdir -p /etc/nginx/html /var/www/html \
    && chown -R app:app /etc/nginx /var/www /var/cache/nginx /var/run/nginx.pid /sock

RUN apk add --no-cache curl

COPY ./conf/nginx.conf /etc/nginx

COPY ./conf/default.conf /etc/nginx/conf.d

EXPOSE 8000

USER app:app

VOLUME /var/www

WORKDIR /var/www/html