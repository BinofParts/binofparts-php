Bin of Parts
===============

The Bin of Parts website is built using PHP. We also use Vagrant for local development so that everyone tests on the same environment and it is as close to our production box as possible. Vagrant will create a virtual machine with the pre-configured services and settings needed.


SETUP
===============

+ [**Fork**](https://github.com/BinofParts/binofparts/fork) this Repository!
+ [Install VirtualBox](https://www.virtualbox.org/wiki/Downloads)
+ [Install Vagrant](https://www.vagrantup.com/)
+ Add the box: `vagrant box add vemp https://dl.dropbox.com/u/2382631/vemp.box`.
+ Go to the root directory where you cloned your fork and create the VM: `vagrant init vemp`.
+ Start things up: `vagrant up`.
+ SSH In: `vagrant ssh`.
+ Start up Nginx: `sudo service nginx restart`.
+ You're good to go! You can access the site with [127.0.0.1:5232](127.0.0.1:5232)

Next edit the following file on the vagrant server.

`nano /etc/nginx/sites-available/vagrant`

and it should now look like below.

```
server {

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
}
```

### Vagrant

Vagrant is [very well documented](http://vagrantup.com/v1/docs/index.html) but here are a few common commands:

* `vagrant up` starts the virtual machine and provisions it
* `vagrant suspend` will essentially put the machine to 'sleep' with `vagrant resume` waking it back up
* `vagrant halt` attempts a graceful shutdown of the machine and will need to be brought back with `vagrant up`
* `vagrant ssh` gives you shell access to the virtual machine


## About Vagrant

Vagrant is a tool for building and distributing development environments.

Vagrant provides the framework and configuration format to create and manage complete portable development environments. These development environments can live on your computer or in the cloud, and are portable between Windows, Mac OS X, and Linux.

Vagrant requires that you have VirtualBox installed.


