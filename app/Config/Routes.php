<?php

use CodeIgniter\Router\RouteCollection;
use App\Filters\AuthFilter;
use App\Filters\RoleFilter;

/**
 * @var RouteCollection $routes
 */

// 1. PÁGINA PRINCIPAL LIBRE
$routes->get('/', 'PanelInicial::index'); // * RUTA RAIZ QUE CARGA EL PANEL PRINCIPAL
$routes->get('dashboard', 'PanelInicial::index'); // * ALTERNATIVA PARA EL DASHBOARD
$routes->get('panelinicial', 'PanelInicial::index'); // * ENLACE DIRECTO AL PANEL INICIAL

// 2. AUTENTICACIÓN Y LOGIN (PÚBLICO)
$routes->get('login', 'Login::index'); // * MUESTRA LA VISTA DE ACCESO
$routes->post('login/auth', 'Login::auth'); // * PROCESA LAS CREDENCIALES DE INICIO DE SESIÓN
$routes->get('logout', 'Login::logout'); // * CIERRA LA SESIÓN ACTIVA

$routes->get('login/forgot-password', 'Login::forgotPassword'); // * VISTA PARA RECUPERAR CONTRASEÑA
$routes->post('login/send-reset-link', 'Login::sendResetLink'); // * ENVÍA ENLACE DE RECUPERACIÓN
$routes->get('login/reset-password/(:alphanumeric)', 'Login::resetPassword/$1'); // * VALIDA TOKEN PARA CAMBIAR CONTRASEÑA
$routes->post('login/update-password', 'Login::updatePassword'); // * GUARDA LA NUEVA CONTRASEÑA

// 3. REGISTRO PÚBLICO
$routes->get('registro', 'Usuarios::nuevo'); // * MUESTRA EL FORMULARIO DE REGISTRO
$routes->post('registro/guardar', 'Usuarios::guardar'); // * ALMACENA EL NUEVO USUARIO
$routes->get('usuarios/nuevo', 'Usuarios::nuevo'); // * RUTA ALTERNATIVA DE CREACIÓN
$routes->post('usuarios/guardar', 'Usuarios::guardar'); // * RUTA ALTERNATIVA PARA GUARDAR

// 4. MÓDULOS GENERALES PROTEGIDOS (Exigen estar logueado)
$routes->group('', ['filter' => AuthFilter::class], static function ($routes) {
    $routes->get('mapa', 'Mapa::index'); // * MUESTRA EL MAPA SOLO PARA USUARIOS AUTENTICADOS
    $routes->get('perfil', 'Perfil::index'); // * PERFIL PROTEGIDO
    $routes->get('reportes', 'Reportes::index'); // * REPORTES PROTEGIDO
});

// 5. MÓDULOS PERMITIDOS PARA USUARIO (2) Y ADMINISTRADOR (1)
$routes->group('', ['filter' => RoleFilter::class . ':2,1'], static function ($routes) {
    $routes->get('modulo1', 'ModuloUno::index'); // * MÓDULO 1 PARA ROLES 2 Y 1
    $routes->get('modulo2', 'ModuloDos::index'); // * MÓDULO 2 PARA ROLES 2 Y 1
    $routes->get('modulo3', 'ModuloTres::index'); // * MÓDULO 3 PARA ROLES 2 Y 1
});

// 6. MÓDULOS EXCLUSIVOS DE ADMINISTRADOR (1)
$routes->group('admin', ['filter' => RoleFilter::class . ':1'], static function ($routes) {
    $routes->get('usuarios', 'Usuarios::index'); // * GESTIÓN DE USUARIOS SOLO ADMIN
    $routes->get('usuarios/crear', 'Usuarios::crear'); // * CREAR USUARIOS SOLO ADMIN
    $routes->get('usuarios/eliminar/(:num)', 'Usuarios::eliminar/$1'); // * ELIMINAR USUARIO POR ID SOLO ADMIN
});