<?php

// set the environment before everything else. Values are: development,production
define('ENVIRONMENT', 'development');

date_default_timezone_set ('America/Chicago');

$app = require __DIR__.'/../app/app.php';

switch (ENVIRONMENT) {
    case 'production':
        ini_set('display_errors', 0);
        require __DIR__ . '/../app/config/production.php';
        break;
    
    case 'development':
        Symfony\Component\Debug\Debug::enable();
        require __DIR__ . '/../app/config/development.php';
        break;
}

$app->run();
