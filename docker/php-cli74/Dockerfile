FROM prooph/php:7.4-cli-xdebug

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --version=1.10.9 --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer