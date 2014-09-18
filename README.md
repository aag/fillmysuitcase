## Fill My Suitcase

Fill My Suitcase is a web application for keeping a packing list for traveling.
The goal is to make it easy to bring exactly what you need when you pack luggage
for a trip.

The project is in an early alpha stage and is not ready for production use.

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
4. Create a `fillmysuitcase` database on your database server and add a user
   with access to the database.
5. Create a `.env.php` file in the top-level directory of the Fill My Suitcase
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

6. On the console, run `php artisan key:generate` and enter the key it outputs
   as the `app => key` value in `.env.php` file.
7. Update all the other values in `.env.php` to match your environment. If you
   are not using PostgreSQL, update `app/config/database.php` to match your
   database configuration.
8. Run `php artisan migrate` from the top-level directory of the Fill My
   Suitcase code.
9. Visit your new vhost in a web browser and create a new user by clicking
   "Log In" and "Create Account".

At this point you should be logged in and you can use the site normally.

### License

Fill My Suitcase is licensed under the
[MIT License](http://opensource.org/licenses/MIT).  See the LICENSE file in
this directory for the full license text.

