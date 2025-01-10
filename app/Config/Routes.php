<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login'); 
$routes->post('login', 'Auth::login');
$routes->get('/register', 'RegisterController::index');
$routes->post('/register', 'RegisterController::register');

