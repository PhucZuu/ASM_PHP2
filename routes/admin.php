<?php

use Phucle\Assignment\Controllers\Admin\UserController;
use Phucle\Assignment\Controllers\Admin\DashboardController;
use Phucle\Assignment\Controllers\Admin\NewsController;

$router->mount('/admin', function () use ($router) {

    $router->get('/',   DashboardController::class . '@dashboard');

    // CRUD USER
    $router->mount('/users', function () use ($router) {
        $router->get('/',               UserController::class . '@index');
        $router->get('/create',         UserController::class . '@create');
        $router->post('/store',         UserController::class . '@store');
        $router->get('/{id}/show',      UserController::class . '@show');
        $router->get('/{id}/edit',      UserController::class . '@edit');
        $router->post('/{id}/update',   UserController::class . '@update');
        $router->get('/{id}/delete',    UserController::class . '@delete');
    }); 
    
    // CRUD NEWS
    $router->mount('/news', function () use ($router) {
        $router->get('/',               NewsController::class . '@index');
        $router->get('/create',         NewsController::class . '@create');
        $router->post('/store',         NewsController::class . '@store');
        $router->get('/{id}/show',      NewsController::class . '@show');
        $router->get('/{id}/edit',      NewsController::class . '@edit');
        $router->post('/{id}/update',   NewsController::class . '@update');
        $router->get('/{id}/delete',    NewsController::class . '@delete');
    });
});