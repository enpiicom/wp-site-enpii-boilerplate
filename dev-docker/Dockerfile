FROM npbtrac/php80_cli

# Stop dpkg-reconfigure tzdata from prompting for input
ENV DEBIAN_FRONTEND=noninteractive

# Install apache and php7
RUN apt update && \
	apt -y install \
	php8.0-xdebug \
	apache2 \
	libapache2-mod-php8.0 \
	libapache2-mod-auth-openidc \
	# Ensure apache can bind to 80 as non-root
	libcap2-bin && \
    setcap 'cap_net_bind_service=+ep' /usr/sbin/apache2 && \
    apt -y autoremove

	# As apache is never run as root, change dir ownership
RUN a2disconf other-vhosts-access-log && \
    chown -Rh www-data. /var/run/apache2 && \
	# Clean up apt setup files
    apt clean && \
    rm -rf /var/lib/apt/lists/* && \
	# Setup apache
    a2enmod rewrite headers expires ext_filter

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
	php composer-setup.php \
	php -r "unlink('composer-setup.php');"

# Install Node 18 and Yarn
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
	&& apt install -y nodejs \
	&& npm install -g yarn

# Install WP CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x wp-cli.phar
RUN mv wp-cli.phar /usr/local/bin/wp

# Override default apache and php config
COPY dev-docker/config/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY dev-docker/config/apache/mpm_prefork.conf /etc/apache2/mods-available
COPY dev-docker/config/apache/status.conf /etc/apache2/mods-available
COPY dev-docker/config/php/custom.ini /etc/php/8.0/apache2/conf.d/zz-overrides.ini
COPY dev-docker/config/php/xdebug.ini /etc/php/8.0/cli/conf.d/20-xdebug.ini

COPY ./ /var/www/html/public

# Prepare folders
RUN mkdir -p /var/www/html/public/wp-content/uploads/ /var/www/html/public/wp-content/upgrade/ /var/www/html/public/wp-content/cache/
RUN chmod -R 777 /var/www/html/public/wp-content/uploads/ /var/www/html/public/wp-content/upgrade/ /var/www/html/public/wp-content/cache/

# To allow installing plugins themes via Admin Dashboard
RUN mkdir -p /var/www/html/public/wp-content/plugins var/www/html/public/wp-content/themes
RUN chmod 777 /var/www/html/public/wp-content/plugins var/www/html/public/wp-content/themes

# #### In case you want to host your website in a `sub-folder` in your web root folder
# COPY ./ /var/www/html/public/sub-folder

# # Prepare folders
# RUN mkdir -p /var/www/html/public/sub-folder/wp-content/uploads/ /var/www/html/public/sub-folder/wp-content/upgrade/ /var/www/html/public/sub-folder/wp-content/cache/
# RUN chmod -R 777 /var/www/html/public/sub-folder/wp-content/uploads/ /var/www/html/public/sub-folder/wp-content/upgrade/ /var/www/html/public/sub-folder/wp-content/cache/

# # To allow installing plugins themes via Admin Dashboard
# RUN mkdir -p /var/www/html/public/sub-folder/wp-content/plugins var/www/html/public/sub-folder/wp-content/themes
# RUN chmod 777 /var/www/html/public/sub-folder/wp-content/plugins var/www/html/public/sub-folder/wp-content/themes
# #### / `sub-folder`

RUN adduser webuser

EXPOSE 80

ENTRYPOINT ["apache2ctl", "-D", "FOREGROUND"]

WORKDIR /var/www/html/public
