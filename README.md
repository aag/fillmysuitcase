## Fill My Suitcase

Fill My Suitcase is a web application for keeping a packing list for traveling.
The goal is to make it easy to never forget anything when you pack luggage for
a trip.

The project is in an early alpha stage and is not ready for production use.

### Installation

The application is built on Laravel 4 and AngularJS.  It requires Apache 
running PHP >= 5.3.7 and the MCrypt PHP extension.  It also requires a database
server with a PDO driver.  The default configuration uses MySQL.

Steps

1. Download the code from Github.
2. Navigate to the directory with the code in a command prompt and execute
   `./composer.phar install`.
3. Create a new Apache virtual host and point the root of the vhost to the
   `/public` subdirectory of the directory where you downloaded the code.
4. Create a `fillmysuitcase` database in your database server and add a
   fillmysuitecase user.
5. Edit `/app/config/database.php` and customize it for your database
   configuration.
6. Visit your new vhost and create a new user by clicking "Log In" and 
   "Create Account".

At this point you should be able to log in and use the site normally.

