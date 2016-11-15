<?php
date_default_timezone_set('Europe/Berlin');

/**
 * StudyOrganizer (Application Root)
 */
chdir(dirname(__DIR__));

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// Setup autoloading
require 'init_autoloader.php';

// Config (Apigility)
$appConfig = include 'config/application.config.php';

if (file_exists('config/development.config.php')) {
    $appConfig = Zend\Stdlib\ArrayUtils::merge($appConfig, include 'config/development.config.php');
}

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();