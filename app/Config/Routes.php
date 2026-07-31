<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rutas de Login
$routes->get('/', 'Login::index');
$routes->get('login', 'Login::index');
$routes->post('login/auth', 'Login::auth');
$routes->get('logout', 'Login::logout');

// Dashboard
$routes->get('dashboard', function() {
    return '<h1>¡Bienvenido! Esta es la pantalla principal tras iniciar sesión.</h1><p><a href="'.base_url('usuarios').'">Gestión de Usuarios</a> | <a href="'.base_url('logout').'">Cerrar Sesión</a></p>';
});

// Rutas de Usuarios 
$routes->group('usuarios', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'Usuarios::index');                // URL: /usuarios
    $routes->get('crear', 'Usuarios::crear');             // URL: /usuarios/crear
    $routes->post('guardar', 'Usuarios::guardar');        // URL: /usuarios/guardar
    $routes->get('eliminar/(:num)', 'Usuarios::eliminar/$1'); // URL: /usuarios/eliminar/ID
});