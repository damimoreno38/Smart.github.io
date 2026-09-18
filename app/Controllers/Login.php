<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Login extends BaseController
{
    public function index()
    {
        // * REDIRIGE AL INICIO SI YA HAY SESIÓN ACTIVA
        if (session()->get('isLoggedIn') || session()->get('logged_in')) {
            return redirect()->to(base_url('/'));
        }

        return view('login'); // * MUESTRA LA VISTA DE LOGIN
    }

    public function auth()
    {
        $session = session();
        $model   = new UsuarioModel();

        // * OBTIENE Y LIMPIA CURP Y CONTRASEÑA
        $curp     = strtoupper(trim($this->request->getPost('curp') ?? ''));
        $password = (string) $this->request->getPost('password');

        // * VALIDA CAMPOS LLENOS
        if (empty($curp) || empty($password)) {
            $session->setFlashdata('msg', 'Por favor, completa todos los campos.');
            return redirect()->to(base_url('/login'));
        }

        // * BUSCA AL USUARIO POR CURP
        $user = $model->where('curp', $curp)->first();

        if ($user) {
            // * OBTIENE EL HASH DE LA CONTRASEÑA
            $hashGuardado = $user['password'] ?? $user['Contraseña'] ?? '';

            // * VERIFICA QUE LA CONTRASEÑA SEA CORRECTA
            if (!empty($hashGuardado) && password_verify($password, $hashGuardado)) {
                
                // * DEFINE EL ROL DEL USUARIO
                $rolUsuario = $user['ROLES_ID_roles'] ?? $user['roles_id'] ?? $user['ROLES_ID_ROLES'] ?? 2;
                $userId     = $user['ID_usuario'] ?? $user['id'] ?? null;

                // * CREA LOS DATOS PARA LA SESIÓN
                $sessionData = [
                    'id'          => $userId,
                    'id_usuario'  => $userId,
                    'name'        => $user['curp'],
                    'curp'        => $user['curp'],
                    'role'        => (int) $rolUsuario,
                    'isLoggedIn'  => true,
                    'logged_in'   => true,
                ];

                // * INICIA SESIÓN Y REDIRIGE
                $session->set($sessionData);
                return redirect()->to(base_url('/'));
            }

            // * ERROR POR CONTRASEÑA INCORRECTA
            $session->setFlashdata('msg', 'Contraseña incorrecta.');
            return redirect()->to(base_url('/login'));
        }

        // * ERROR POR CURP NO REGISTRADA
        $session->setFlashdata('msg', 'La CURP ingresada no se encuentra registrada.');
        return redirect()->to(base_url('/login'));
    }

    public function forgotPassword()
    {
        return view('forgot_password');
    }

    public function sendResetLink()
    {
        $curp  = strtoupper(trim($this->request->getPost('curp') ?? ''));
        $model = new UsuarioModel();

        $user = $model->where('curp', $curp)->first();

        if ($user) {
            session()->setFlashdata('success', 'Instrucciones enviadas correctamente.');
        } else {
            session()->setFlashdata('msg', 'No se encontró ningún usuario con esa CURP.');
        }

        return redirect()->to(base_url('login/forgot-password'));
    }

    public function resetPassword($token = null)
    {
        if (!$token) {
            return redirect()->to(base_url('/login'));
        }

        $data['token'] = $token;
        return view('reset_password', $data);
    }

    public function updatePassword()
    {
        $password        = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if ($password !== $confirmPassword) {
            session()->setFlashdata('msg', 'Las contraseñas no coinciden.');
            return redirect()->back();
        }

        session()->setFlashdata('success', 'Contraseña actualizada correctamente. Inicia sesión.');
        return redirect()->to(base_url('/login'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}