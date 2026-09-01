<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Login extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(base_url('/'));
        }

        return view('login');
    }

    public function auth()
    {
        $session = session();
        $model   = new UsuarioModel();

        $curp     = strtoupper(trim($this->request->getPost('curp') ?? ''));
        $password = (string) $this->request->getPost('password');

        $user = $model->where('curp', $curp)->first();

        if ($user) {
            // Verificación limpia usando la columna 'password'
            $hashGuardado = $user['password'] ?? '';

            if (!empty($hashGuardado) && password_verify($password, $hashGuardado)) {
                $sessionData = [
                    'id'         => $user['id'] ?? $user['ID_usuario'] ?? null,
                    'name'       => $user['curp'],
                    'role'       => $user['ROLES_ID_roles'] ?? 'usuario',
                    'isLoggedIn' => true,
                ];

                $session->set($sessionData);
                return redirect()->to(base_url('/'));
            }

            $session->setFlashdata('msg', 'Contraseña incorrecta.');
            return redirect()->to(base_url('/login'));
        }

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

    public function error()
    {
        return view('login', ['error' => 'Ocurrió un error en la autenticación.']);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/login'));
    }
}