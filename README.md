## Install on localhost

1. Checkout the code into a working directory e.g.

    $ mkdir work
    $ cd work
    $ git clone git@github.com:dwilkie/melbtest.git

2. Install apache if not already installed

    $ sudo apt-get install apache2

3. Create a symlink to the code from your localhost server directory

    $ cd /var/www
    $ sudo ln -s ~/work/melbtest melbtest
    $ sudo chown -h user:user melbtest

4. Create the following symlink

    $ sudo ln -s /etc/apache2/mods-available/include.load /etc/apache2/mods-enabled

5. Edit /sites-available/default and add the bold text

    $ sudo nano /etc/apache2/sites-available/default

<Directory /var/www/>
  Options Indexes FollowSymLinks MultiViews *+Includes*
  AllowOverride None
  Order allow,deny
  allow from all
  *AddType text/html .shtml*
  *AddOutputFilter INCLUDES .shtml*
</Directory>

6. Restart Apache2

    sudo apache2ctl restart

## Modification instructions

1. Install [git-ftp](https://github.com/resmo/git-ftp) if not already installed
2. Make a change
3. `git commit -m "changed blah"`
4. `git ftp push`

