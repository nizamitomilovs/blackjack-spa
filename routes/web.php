<?php

declare(strict_types=1);

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/', 'GameController@index');
$router->get('/deal[/{deck_id}]', 'GameController@deal');
$router->post('/stand', 'GameController@stand');
