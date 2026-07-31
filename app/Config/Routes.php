<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
$routes->get('/logout', 'Login::logout');

// Rutas de Usuarios
$routes->get('/usuarios', 'Usuarios::index');
$routes->get('/usuarios/crear', 'Usuarios::crear');
$routes->post('/usuarios/guardar', 'Usuarios::guardar');
$routes->get('/usuarios/eliminar/(:num)', 'Usuarios::eliminar/$1');

//ruta del apartado del mapa
$routes->get('mapa', 'Mapa::index');
//ruta de error de mapa 
$routes->get('error-mapa', 'Mapa::errorMapa');