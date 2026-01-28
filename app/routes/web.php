<?php

/** @var \App\Router $router */

use App\Http\Controller\FileDownloadController;
use App\Http\Controller\FileUploadController;
use App\Http\Controller\MainController;

$router->get('/', [MainController::class, 'index']);
$router->post('/upload', [FileUploadController::class, 'upload']);
$router->get('/files/{filename}', [FileDownloadController::class, 'download']);

