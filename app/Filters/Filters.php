<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\AuthFilter;
use App\Filters\RoleFilter;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, class-string|list<class-string>> [filter_name => classname]
     */
    public array $aliases = [
        'csrf'          => CSRF::class, // * ALIAS PARA PROTECCIÓN CONTRA ATAQUES CSRF
        'toolbar'       => DebugToolbar::class, // * ALIAS PARA LA BARRA DE DEPURACIÓN DE CODEIGNITER
        'honeypot'      => Honeypot::class, // * ALIAS PARA TÉCNICA ANTISPAM EN FORMULARIOS
        'invalidchars'  => InvalidChars::class, // * ALIAS PARA BLOQUEAR CARACTERES INVÁLIDOS EN LA ENTRADA
        'secureheaders' => SecureHeaders::class, // * ALIAS PARA AÑADIR CABECERAS HTTP SEGURAS
        'auth'          => AuthFilter::class, // * ALIAS PARA EL FILTRO DE AUTENTICACIÓN DE USUARIOS
        'ros'           => RoleFilter::class, // * ALIAS PARA EL FILTRO DE VALIDACIÓN DE ROLES
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string, list<string>>>
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
        ],
        'after' => [
            'toolbar', // * EJECUTA LA BARRA DE DEPURACIÓN GLOBALMENTE DESPUÉS DE CADA RESPUESTA
        ],
    ];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * @var array<string, array<string, list<string>>>
     */
    public array $filters = [
        'auth' => [
            'before' => [
                'perfil', // * APLICA FILTRO AUTH ANTES DE ENTRAR A PERFIL
                'perfil/*', // * APLICA FILTRO AUTH A TODAS LAS SUBRUTAS DE PERFIL
                'admin/usuarios', // * APLICA FILTRO AUTH ANTES DE VER USUARIOS ADMIN
                'admin/usuarios/*', // * APLICA FILTRO AUTH A LAS SUBRUTAS DE ADMIN DE USUARIOS
                'mapa', // * APLICA FILTRO AUTH ANTES DE ACCEDER AL MAPA
                'mapa/*', // * APLICA FILTRO AUTH A LAS SUBRUTAS DEL MAPA
                'reportes', // * APLICA FILTRO AUTH ANTES DE ENTRAR A REPORTES
                'reportes/*', // * APLICA FILTRO AUTH A LAS SUBRUTAS DE REPORTES
            ]
        ]
    ];
}