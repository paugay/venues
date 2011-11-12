<VirtualHost *:80>

    ServerName vm.venues.com
    DocumentRoot "/var/www/projects/venues/www/"

    <Directory "/var/www/projects/venues/www/">
        Options FollowSymLinks
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>

</VirtualHost>
