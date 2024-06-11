<?php

use Packages\Router\Router;

$router = new Router;

$router->setNamespace("\\App\\Controllers\\");

$router->get('/', 'EnvironmentController@index');

$router->get('/products/', 'ProductsController@index');
$router->post('/products/', 'ProductsController@store');
$router->get('/products/{id}', 'ProductsController@show');
$router->put('/products/{id}', 'ProductsController@update');
$router->delete('/products/{id}', 'ProductsController@delete');

$router->get('/categories/', 'CategoriesController@index');
$router->get('/categories/{id}', 'CategoriesController@show');
$router->post('/categories/', 'CategoriesController@store');
$router->put('/categories/{id}', 'CategoriesController@update');
$router->delete('/categories/{id}', 'CategoriesController@delete');

$router->get('/order/{id}', 'OrdersController@getOrder');
$router->post('/order/', 'OrdersController@makeOrder');
$router->post('/order/add/', 'OrdersController@addProduct');

$router->notFound(fn() => [ 'error' => 'Route not found' ]);
