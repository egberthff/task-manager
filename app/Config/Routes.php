<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Task::index');
$routes->get('/task/create', 'Task::create');
$routes->post('/task/store', 'Task::store');
$routes->get('/task/complete/(:num)', 'Task::complete/$1');
$routes->get('/task/delete/(:num)', 'Task::delete/$1');
$routes->get('/task/edit/(:num)', 'Task::edit/$1');
$routes->post('/task/update/(:num)', 'Task::update/$1');


