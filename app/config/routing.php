<?php

use GamerFind\Controllers\AuthController;
use GamerFind\Controllers\GameListController;

// Register Controllers and their dependencies
$app['auth.controller'] = $app->share(function() use ($app) {
    return new AuthController($app['twig']);
});

// Register routes
$app->get('/', function() use($app)  {
       $controller = new AuthController($app['twig']);
       return $controller->signup();
});

$app->get('/games', function() use($app)  {
        $controller = new GameListController($app['twig']);
        return $controller->getGames();
    });


//$app->get('/login', 'auth.controller:login');
//$app->get('/signup', 'auth.controller:signup');