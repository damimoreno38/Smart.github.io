<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Ruta de Error
$routes->get('login/error', 'Login::error');

//ruta del apartado del mapa
$routes->get('mapa', 'Mapa::index');

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

// Dashboard / Panel Inicial
$routes->get('dashboard', 'PanelInicial::index');
$routes->get('panelinicial', 'PanelInicial::index');

// Rutas de Usuarios 
$routes->group('usuarios', ['namespace' => 'App\Controllers'], static function ($routes) {
    $routes->get('/', 'Usuarios::index');
    $routes->get('crear', 'Usuarios::crear');
    $routes->post('guardar', 'Usuarios::guardar');
    $routes->get('eliminar/(:num)', 'Usuarios::eliminar/$1');
});