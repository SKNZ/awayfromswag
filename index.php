<?php

define(DS, DIRECTORY_SEPARATOR);
define(ROOT, __DIR__ . DS);
define(WEBROOT, '/');

define(DEBUG, true);

if (DEBUG) {
    ini_set('display_errors', true);
    ini_set('html_errors', true);
    error_reporting(E_ALL);
}

require 'vendor/autoload.php';

try {
    $router = new \SwagFramework\Routing\Router();

    $router->add('/', new \app\controllers\TestsController(), 'index');

    $router->matchCurrentRequest();
} catch (\SwagFramework\Exceptions\SwagException $e) {
    echo '<h1>SwagException !</h1>';
    echo '<p>' . $e->getMessage() . '</p>';
} catch (Exception $e) {
    echo '<h1>Exception !</h1>';
    echo $e;
}
