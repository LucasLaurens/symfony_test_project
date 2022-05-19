# FROM php:7-jessie

# RUN apt-get update \
#     && apt-get install -y \
#         librabbitmq-dev \
#         libssh-dev \
#     && docker-php-ext-install \
#         bcmath \
#         sockets \
#     && pecl install amqp \
#     && docker-php-ext-enable amqp
