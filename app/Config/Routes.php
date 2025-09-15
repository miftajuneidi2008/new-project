<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->get('/login/gmailCallback', 'Login::gmailCallback');
$routes->get('/login/logout', 'Login::logout');

$routes->get('/admin', 'Admin::index', ['filter' => 'auth:admin']); // Apply auth filter for admin

$routes->group('admin', ['filter' => 'auth:admin'], static function ($routes) {
    $routes->resource('news_category', ['controller' => 'NewsCategory']);
});