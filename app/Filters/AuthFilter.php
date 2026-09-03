<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // * VERIFICA SI EL USUARIO NO HA INICIADO SESIÓN PARA REDIRIGIRLO AL INICIO
        if (!$session->get('isLoggedIn') && !$session->get('logged_in')) {
            return redirect()->to('/')->with('show_auth_modal', true);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // * MÉTODO VACÍO QUE SE EJECUTA DESPUÉS DE LA PETICIÓN
    }
}