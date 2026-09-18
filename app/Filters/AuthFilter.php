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

        // * VERIFICA SI EL USUARIO NO TIENE LA SESIÓN ACTIVA
        if (! $session->get('isLoggedIn')) {
            return redirect()->to('/')->with('show_auth_modal', true);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // * MÉTODO VACÍO QUE SE EJECUTA DESPUÉS DE LA PETICIÓN
    }
}