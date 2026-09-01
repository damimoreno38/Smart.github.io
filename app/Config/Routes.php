<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 1. RUTA PRINCIPAL Y DASHBOARD
$routes->get('/', 'PanelInicial::index');
$routes->get('dashboard', 'PanelInicial::index');
$routes->get('panelinicial', 'PanelInicial::index');

// 2. AUTENTICACIÓN Y LOGIN (PÚBLICO)
$routes->get('login', 'Login::index');
$routes->post('login/auth', 'Login::auth');
$routes->get('logout', 'Login::logout');

// 3. RECUPERACIÓN DE CONTRASEÑA
$routes->get('login/forgot-password', 'Login::forgotPassword');
$routes->post('login/send-reset-link', 'Login::sendResetLink');
$routes->get('login/reset-password/(:alphanumeric)', 'Login::resetPassword/$1');
$routes->post('login/update-password', 'Login::updatePassword');

// 4. REGISTRO PÚBLICO
$routes->get('registro', 'Usuarios::nuevo');
$routes->post('registro/guardar', 'Usuarios::guardar');
$routes->get('usuarios/nuevo', 'Usuarios::nuevo');
$routes->post('usuarios/guardar', 'Usuarios::guardar');

// 5. MÓDULOS PROTEGIDOS POR AUTENTICACIÓN
$routes->group('', ['filter' => \App\Filters\AuthFilter::class], static function ($routes) {
    $routes->get('mapa', 'Mapa::index');
});

// 6. GESTIÓN DE USUARIOS (PANEL ADMINISTRATIVO)
$routes->group('usuarios', ['namespace' => 'App\Controllers', 'filter' => \App\Filters\AuthFilter::class], static function ($routes) {
    $routes->get('/', 'Usuarios::index');
    $routes->get('crear', 'Usuarios::crear');
    $routes->get('eliminar/(:num)', 'Usuarios::eliminar/$1');
});