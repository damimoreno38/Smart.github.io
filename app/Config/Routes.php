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

// Rutas de Recuperación de Contraseña
$routes->get('login/forgot-password', 'Login::forgotPassword');
$routes->post('login/send-reset-link', 'Login::sendResetLink');
$routes->get('login/reset-password/(:alphanumeric)', 'Login::resetPassword/$1');
$routes->post('login/update-password', 'Login::updatePassword');

// Dashboard
$routes->get('dashboard', function() {
    return '<h1>¡Bienvenido! Esta es la pantalla principal tras iniciar sesión.</h1><p><a href="'.base_url('usuarios').'">Gestión de Usuarios</a> | <a href="'.base_url('logout').'">Cerrar Sesión</a></p>';
});

// Rutas de Usuarios 
$routes->group('usuarios', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'Usuarios::index');
    $routes->get('crear', 'Usuarios::crear');
    $routes->post('guardar', 'Usuarios::guardar');
    $routes->get('eliminar/(:num)', 'Usuarios::eliminar/$1');
});