<?php

use GamerFind\Controllers\AuthController;

// Register Controllers and their dependencies
$app['auth.controller'] = $app->share(function() use ($app) {
    return new AuthController($app['twig']);
});

// Register routes
$app->get('/', function() use($app)  {
       $controller = new AuthController($app['twig']);
       return $controller->signup();
});

//$app->get('/login', 'auth.controller:login');
//$app->get('/signup', 'auth.controller:signup');