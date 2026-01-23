<?php

/** @var \App\Router $router */

use App\Http\Controller\MainController;

$router->get('/', [MainController::class, 'index']);
$router->post('/test', [MainController::class, 'test']);

