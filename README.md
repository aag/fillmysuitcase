## Fill My Suitcase

[![Build Status](https://travis-ci.org/aag/fillmysuitcase.svg?branch=master)](https://travis-ci.org/aag/fillmysuitcase) [![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

Fill My Suitcase is a web application for keeping a packing list for traveling.
The goal is to make it easy to bring exactly what you need when you pack luggage
for a trip.

The project is currently beta quality and is not recommended for production use.

### Installation

The application is built on Laravel 4 and AngularJS.  It requires Apache or
Nginx running PHP 5.4+ and the MCrypt PHP extension.  It also requires a
database server with a PDO driver.  The default configuration uses PostgreSQL.

Steps

1. Download the code from Github.
2. Navigate to the directory with the code in a command prompt and execute
   `./composer install`.
3. Set up your web server.
   * If you're using Apache, create a new virtual host and point the root of
   the vhost to the `/public` subdirectory of the Fill My Suitcase code. Make
   sure mod_rewrite is enabled and that `.htaccess` files are allowed to
   override settings in the vhost.
   * If you're using Nginx, create a new server configuration. You can use the
   `nginx-fillmysuitcase.conf` file in the root directory of the Fill My
   Suitcase code as a starting point. Update the `server_name` and `root`
   directives to fit your environment.
4. Set the file permissions on the code so the web server can read all files
   and write to the `/app/storage` directory. For example, if your web server
   runs under the `www-data` user, you can execute these commands from the
   top level directory of the Fill My Suitcase code:

   ```
   $ sudo chgrp -R www-data *
   $ chmod -R 775 app/storage/
   ```
5. Create a `fillmysuitcase` database on your database server and add a user
   with access to the database.
6. Create a `.env.php` file in the top-level directory of the Fill My Suitcase
   code and add your local configuration. It should look something like this:
   ```php
   <?php

    return array(
        'app' => array(
            'key' => '',
            'url' => 'http://localhost/',
        ),
        'database' => array(
            'connections' => array(
                'pgsql' => array(
                    'host' => 'localhost',
                    'port' => '5432',
                    'database' => 'fillmysuitcase',
                    'user' => 'fillmysuitcase',
                    'pass' => '',
                )
            )
        )
    );
    ```

7. On the console, run `php artisan key:generate` and enter the key it outputs
   as the `app => key` value in `.env.php` file.
8. Update all the other values in `.env.php` to match your environment. If you
   are not using PostgreSQL, update `app/config/database.php` to match your
   database configuration.
9. Run `php artisan migrate` from the top-level directory of the Fill My
   Suitcase code.
10. Visit your new vhost in a web browser and create a new user by clicking
   "Log In" and "Create Account".

At this point you should be logged in and you can use the site normally.

### License

Fill My Suitcase is licensed under the
[MIT License](http://opensource.org/licenses/MIT).  See the LICENSE file in
this directory for the full license text.

