SETUP
===============

Install Vagrant
+ Add the box: vagrant box add vemp https://dl.dropbox.com/u/2382631/vemp.box.
+ Go in to your site's root directory and create the VM: vagrant init vemp.
+ Start things up: vagrant up.
+ SSH In: vagrant ssh.
+ Start up Nginx: sudo service nginx restart.
+ You're good to go! You can access your site with 127.0.0.1:5232

Next edit the following file on the vagrant server.

`nano /etc/nginx/sites-available/vagrant`

and it should now look like below.

```server {

        server_name _;

        access_log   /var/log/nginx/vagrant.access.log;
        error_log    /var/log/nginx/vagrant.error.log;

        root /vagrant;
        index index.php index.htm index.html;

        location / {
                try_files $uri $uri/ /index.php?$args;
        }

        location ~ \.php$ {
                include fastcgi_params;
                fastcgi_pass unix:/var/run/php5-fpm.sock;
        }

        location /part {
          rewrite ^/part?$ /parts.php$1;
        }

        location /team {
          rewrite ^/team/([0-9]+)?$ /team.php?n=$1;
        }

        location /event {
          rewrite ^/event/([A-Za-z0-9_]+)?$ /event.php?n=$1;
        }

        location /myteam {
          rewrite ^/myteam?$ /myteam.php$1;
        }

        location /login {
          rewrite ^/login?$ /login.php$1;
        }

        location /teams {
          rewrite ^/teams?$ /teamlist.php$1;
        }

        location /events {
          rewrite ^/events?$ /eventlist.php$1;
        }

        location /inventory {
          rewrite ^/inventory?$ /inventory.php$1;
        }

        location /kitofparts {
          rewrite ^/kitofparts?$ /kop.php$1;
        }

        location /kop {
          rewrite ^/kop?$ /kop.php$1;
          rewrite ^/kop/([0-9]+)?$ /kop.php?y=$1;
        }

        location /parts {
          rewrite ^/parts?$ /parts.php$1;
        }
}```




