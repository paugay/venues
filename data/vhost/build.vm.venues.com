<VirtualHost *:80>

    ServerName build.vm.venues.com
    DocumentRoot "/var/www/projects/venues/build/"

    <Directory "/var/www/projects/venues/build/">
        Options Indexes FollowSymLinks
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>

</VirtualHost>
