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

// ruta del panel inicila 
$routes->get('/panelinicial', 'PanelInicial::index');