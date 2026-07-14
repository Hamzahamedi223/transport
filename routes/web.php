<?php

/** @var \App\Core\Router $router */

$router->get('/',            'HomeController@index');
$router->get('/lang',        'HomeController@switchLang');

$router->post('/demande',    'OrderController@store');

$router->get('/admin/login',        'AdminController@loginForm');
$router->post('/admin/login',       'AdminController@login');
$router->get('/admin/logout',       'AdminController@logout');
$router->get('/admin',              'AdminController@dashboard');
$router->post('/admin/status',      'AdminController@updateStatus');

$router->get('/404',         'ErrorController@notFound');
