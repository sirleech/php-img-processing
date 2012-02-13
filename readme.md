Req Pkgs:

PHP5
    php5  curl php5-curl php5-xcache php-pear php5-dev 

GD
    php5-gd

PHP Imagick
    sudo apt-get install imagemagick libmagick9-dev
    sudo pecl install imagick

    Confirm all questions by hitting return
    Create file /etc/php5/conf.d/imagick.ini and add a line "extension=imagick.so"
    Reload Apache: sudo service apache2 restart
