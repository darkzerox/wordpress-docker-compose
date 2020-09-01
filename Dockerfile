FROM wordpress
ADD ./themes/${DOMAIN} /usr/src/wordpress/wp-content/themes/${DOMAIN}