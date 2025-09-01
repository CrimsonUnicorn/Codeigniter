<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('register', 'Auth::register');
$routes->post('login', 'Auth::login');
$routes->group('', ['filter' => 'auth'], function($routes){
    $routes->post('teacher', 'Teacher::create');
    $routes->get('teachers', 'Teacher::index');
    $routes->get('auth-users', 'Auth::index'); // optional: create index method in Auth controller
});
