## Fill My Suitcase [![Build Status](https://travis-ci.org/aag/fillmysuitcase.svg?branch=master)](https://travis-ci.org/aag/fillmysuitcase) [![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

Fill My Suitcase is a web application for keeping a packing list for traveling.
The goal is to make it easy to bring exactly what you need when you pack luggage
for a trip.

The project is currently beta quality and is not recommended for production use.

### Installation

The application is built on Laravel 5.2 and AngularJS.  It requires Apache or
Nginx running PHP 5.5.9+ and the MCrypt PHP extension.  It also requires a
database server with a PDO driver.  The default configuration uses PostgreSQL.

Development and deploying require [npm](https://www.npmjs.com/) and gulp.
Once you have installed npm, you can install gulp globally with this command:

```
$ sudo npm install --global gulp
```

**Installation Steps**

1. Download the code from Github.
2. Navigate to the directory with the code in a command prompt and execute
   `./composer install`.
3. Run `gulp` in a command prompt to compile the static assets.
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
   and write to the `/app/storage` directory. For example, if your web server
   runs under the `www-data` user, you can execute these commands from the
   top level directory of the Fill My Suitcase code:

   ```
   $ sudo chgrp -R www-data *
   $ chmod -R 775 app/storage/
   ```
6. Create a `fillmysuitcase` database on your database server and add a user
   with access to the database.
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

### Tests

The functional and integration tests run against an in-memory SQLite database,
so you will need to have the PHP SQLite extension installed. On Debian-derived
Linux systems, you can install it with this command:

```
$ sudo apt-get install php5-sqlite
```

You can then run all the tests with phpunit:

```
$ ./vendor/bin/phpunit
```

### Deploying

A deploy script is already set up to use [Deployer](http://deployer.org/), but
you will need to customize it for your server. First, edit `deployer.php` and
change the `server()` details. Once you have it configured, run this command
to deploy:

```
$ ./deployer.phar deploy production
```

### License

Fill My Suitcase is licensed under the
[MIT License](http://opensource.org/licenses/MIT).  See the LICENSE file in
this directory for the full license text.

