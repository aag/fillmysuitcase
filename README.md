## Fill My Suitcase [![Build Status](https://travis-ci.org/aag/fillmysuitcase.svg?branch=master)](https://travis-ci.org/aag/fillmysuitcase) [![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

Fill My Suitcase is a web application for keeping a packing list for traveling.
The goal is to make it easy to bring exactly what you need when you pack luggage
for a trip.

This software runs the site [https://fillmysuitca.se](https://fillmysuitca.se)

### Installation

The application is built on Laravel 8 and AngularJS 1.7.  It requires Apache
or Nginx running PHP 8.0+ and the MCrypt PHP extension.  It also requires a
database server with a PDO driver.  The default configuration uses PostgreSQL.

Development and deploying require [Node.js](https://nodejs.org/) and
[NPM](https://www.npmjs.com/). [NVM](https://github.com/creationix/nvm) is
recommended for managing Node and NPM versions. Once you have installed NVM,
you can install the correct Node version with these commands, run from the
root of the repository:

```
$ nvm install
$ nvm use
```

**Installation Steps**

1. Download the code from Github.
2. Navigate to the directory with the code in a command prompt and execute
   `./composer.phar install`.
3. Run these commands in a command prompt to compile the static assets:

   ```
   $ npm install
   $ npm run prod
   ```
4. Set up your web server.
   * If you're using Apache, create a new virtual host and point the root of
   the vhost to the `/public` subdirectory of the Fill My Suitcase code. Make
   sure mod_rewrite is enabled and that `.htaccess` files are allowed to
   override settings in the vhost.
   * If you're using Nginx, create a new server configuration. You can use the
   `nginx-fillmysuitcase.conf` file in the root directory of the Fill My
   Suitcase code as a starting point. Update the `server_name` and `root`
   directives to fit your environment.
5. Set the file permissions on the code so the web server can read all files
   and write to the storage and cache files. For example, if your web server
   runs under the `www-data` user, you can execute these commands from the
   top level directory of the Fill My Suitcase code:

   ```
   $ sudo chgrp -R www-data *
   $ chmod -R 775 storage/
   $ chmod -R 775 bootstrap/cache/
   ```
6. Create a `fillmysuitcase` database on your database server and add a user
   with access to the database. If you're using PostgreSQL, you can use these
   commands:
   ```
   $ sudo su - postgres
   $ psql
   postgres-# CREATE USER fillmysuitcase WITH PASSWORD '{RANDOM_PASSWORD}';
   postgres-# CREATE DATABASE fillmysuitcase OWNER fillmysuitcase;
   postgres-# \q
   ```
7. Copy the `.env.example` file in the top-level directory of the Fill My
   Suitcase code to a file named `.env`.
8. On the console, run `php artisan key:generate`. This will generate a
   random encryption key and store it as the `APP_KEY` in the `.env` file.
9. Update all the other values in `.env` to match your environment. If you
   are not using PostgreSQL, add the `DB_CONNECTION` variable and set it to the
   correct value (e.g. `mysql`).
10. Run `php artisan migrate` from the top-level directory of the Fill My
   Suitcase code.
11. Visit your new vhost in a web browser and create a new user by clicking
   "Log In" and "Create Account".

At this point you should be logged in and you can use the site normally.

### Development

During local development, it's faster to load the JS libs from local files
instead of from a CDN. You can enable this behavior by adding this line to your
`.env` file:
```
VIEW_CDN_JS_LIBS=false
```

If you have [NVM](https://github.com/creationix/nvm) installed, run `nvm use`
to use the same version of Node as on the Travis CI server.

### Tests

The functional and integration tests run against an SQLite database,
so you will need to have the PHP SQLite extension installed. On newer
Debian-derived Linux systems (e.g. Ubuntu 16.04+), you can install it with
this command:

```
$ sudo apt-get install php-sqlite3
```

The [Dusk](https://laravel.com/docs/7.x/dusk) tests use Selenium controlling
Chrome with ChromeDriver, so you'll need to install Chrome, then run these
commands:

```
$ touch database/database.sqlite
$ chmod a+w database/database.sqlite
$ php artisan migrate
$ php artisan dusk:chrome-driver
```

Before running the Dusk tests, you need to start the PHP server in a separate
window with this command:

```
$ php artisan serve --env=testing
```

You may need to run the serve command as a different user if you also have a
web server serving the application from the same directory, e.g.
```
$ sudo -u www-data php artisan serve --env=testing
```

Then you can run all the tests with artisan:

```
$ php artisan test
```

If you want to watch the browser tests as they run, you can edit the file
`tests/DuskTestCase.php` and comment out this line:

```
            '--headless',
```

### Deploying

A deploy script is already set up to use [Deployer](http://deployer.org/), but
you will need to customize it for your server. First, edit `deploy.php` and
change the `server()` details. Once you have it configured, run this command
to deploy:

```
$ ./deployer.phar deploy production
```

### License

Fill My Suitcase is licensed under the
[MIT License](http://opensource.org/licenses/MIT).  See the LICENSE file in
this directory for the full license text.

