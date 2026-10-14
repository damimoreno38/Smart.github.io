<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // * OBTIENE LA SESIÓN ACTUAL DEL USUARIO
        $session = session();

        // * REDIRIGE AL LOGIN SI EL USUARIO NO HA INICIADO SESIÓN
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        // * OBTIENE EL ROL NUMÉRICO DEL USUARIO DESDE LA SESIÓN
        $userRole = (int) $session->get('role');

        // * VERIFICA SI SE ESPECIFICARON ROLES PERMITIDOS PARA ESTA RUTA
        if (!empty($arguments)) {
            // * CONVIERTE LOS ARGUMENTOS DE LOS ROLES A NÚMEROS ENTEROS
            $allowedRoles = array_map('intval', $arguments);

            // * COMPRUEBA SI EL ROL DEL USUARIO ESTÁ DENTRO DE LOS PERMITIDOS
            if (!in_array($userRole, $allowedRoles, true)) {
                // * REDIRIGE AL INICIO CON UN MENSAJE DE ERROR SI NO TIENE PERMISO
                return redirect()->to(base_url('/'))->with('msg', 'No tienes permisos suficientes para acceder a este módulo.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // * MÉTODO VACÍO QUE SE EJECUTA DESPUÉS DE LA PETICIÓN
    }
}