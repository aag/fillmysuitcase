<?php
namespace Deployer;

// All Deployer recipes are based on `recipe/common.php`.
require 'recipe/common.php';

// Speed up the native ssh client
set('ssh_multiplexing', true);

// Define a server for deployment.
host('fillmysuitca.se')
    ->user('deployer')
    ->forwardAgent(true)
    ->stage('production')
    ->set('deploy_path', '/var/www/fillmysuitca.se'); 

// Specify the repository from which to download your project's code.
// The server needs to have git installed for this to work.
// If you're not using a forward agent, then the server has to be able to clone
// your project from this repository.
set('repository', 'https://github.com/aag/fillmysuitcase.git');

// Laravel shared dirs
set('shared_dirs', [
    'storage/app',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
    'node_modules',
]);

set('shared_files', ['.env']);

set('http_user', 'www-data');
set('writable_use_sudo', true);
set('writable_dirs', [
    'bootstrap/cache',
    'storage',
    'storage/app',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);

/**
 * Helper tasks
 */
task('deploy:migrate', function() {
    cd('{{release_path}}');
    $output = run('php artisan -n --force migrate');
    writeln('<info>'.$output.'</info>');
})->desc('Migrate the database to the newest version');

task('deploy:optimize', function() {
    cd('{{release_path}}');
    run('php artisan config:cache');
    run('php artisan route:cache');
})->desc('Generate the route cache');

task('deploy:npm_install', function() {
    cd('{{release_path}}');
    $output = run('npm ci');
    //writeln('<info>'.$output.'</info>');
})->desc('Install npm modules');

task('deploy:mix', function() {
    cd('{{release_path}}');
    $output = run('npm run prod');
    //writeln('<info>'.$output.'</info>');
})->desc('Execute Laravel Mix');

task('deploy:fpm_restart', function() {
    $fpmServiceName = trim(run("ls -1 /var/run/php | grep 'fpm\.sock' | sed 's/\.sock//'"));
    $output = run("sudo service {$fpmServiceName} restart");
    //writeln('<info>'.$output.'</info>');
})->desc('Restart PHP-FPM');

task('deploy:up', function () {
    $output = run('php {{deploy_path}}/current/artisan up');
    writeln('<info>'.$output.'</info>');
})->desc('Disable maintenance mode');

task('deploy:down', function () {
    $output = run('php {{deploy_path}}/current/artisan down');
    writeln('<error>'.$output.'</error>');
})->desc('Enable maintenance mode');


/**
 * Main task
 */
task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:optimize',
    'deploy:migrate',
    'deploy:npm_install',
    'deploy:mix',
    'deploy:symlink',
    'deploy:fpm_restart',
    'cleanup',
])->desc('Deploy your project');

after('deploy', 'success');
