<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::index');
$routes->get('/login', 'Login::index');
$routes->get('/login/gmailCallback', 'Login::gmailCallback');
$routes->get('/logout', 'Login::logout');
$routes->get('images/(:segment)', 'ImageController::show/$1');
$routes->get('/live', 'User::live');
$routes->get('/admin', 'Admin::index', ['filter' => 'auth:admin']); // Apply auth filter for admin
$routes->get('/news', 'NewsData::index');
$routes->get('/news/(:num)', 'NewsData::show/$1');
$routes->get('/programs/(:num)', 'ProgramData::show/$1');
$routes->post('/news/(:num)', 'NewsData::create/$1');
$routes->delete('/comments/delete/(:num)', 'Comment::delete/$1');
$routes->post('/comments/update/(:num)', 'Comment::update/$1');

$routes->delete('/post-comments/delete/(:num)', 'Comment::delete_post/$1');
$routes->post('/post-comments/update/(:num)', 'Comment::update_post/$1');
$routes->get('/sport', 'NewsData::sport');
$routes->get('/business', 'NewsData::business');
$routes->get('/program', 'ProgramData::index');
$routes->get('/post/(:num)', 'ProgramData::program_details/$1');
$routes->post('/post/(:num)', 'ProgramData::create/$1');
$routes->get('admin/links', 'Admin::links', ['filter' => 'auth:admin']);
$routes->post('admin/links', 'Admin::create', ['filter' => 'auth:admin']);
$routes->get('admin/logo', 'Admin::show_logo', ['filter' => 'auth:admin']);
$routes->post('admin/logo', 'Admin::add_logo', ['filter' => 'auth:admin']);
$routes->get('admin/site-link', 'Admin::siteLink', ['filter' => 'auth:admin']);

$routes->delete('admin/links/delete/(:num)', 'Admin::delete_link/$1', ['filter' => 'auth:admin']);
$routes->post('admin/links/update/(:num)', 'Admin::update_link/$1', ['filter' => 'auth:admin']);
$routes->post('admin/logo/update/(:num)', 'Admin::update_logo/$1', ['filter' => 'auth:admin']);


$routes->group('admin', ['filter' => 'auth:admin'], static function ($routes) {
    $routes->resource('news_category', ['controller' => 'NewsCategory']);
});

$routes->group('admin', ['filter' => 'auth:admin'], static function ($routes) {
    $routes->resource('program_category', ['controller' => 'ProgramCategory']);
});

$routes->group('admin', ['filter' => 'auth:admin'], static function ($routes) {
    $routes->resource('news', ['controller' => 'News']);
});
$routes->group('admin', ['filter' => 'auth:admin'], static function ($routes) {
    $routes->resource('program', ['controller' => 'Program']);
});



