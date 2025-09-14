<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->get('/login/gmailCallback', 'Login::gmailCallback');
$routes->get('/login/logout', 'Login::logout');
$routes->get(from: '/admin/news_category',to:'NewsCategory::index');

$routes->get('/admin', 'Admin::index', ['filter' => 'auth:admin']); // Apply auth filter for admin
