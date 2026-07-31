<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Login extends BaseController
{
    public function index()
    {
        helper(['form', 'url']);
        return view('login');
    }

    public function auth()
    {
        $session  = session();
        $model    = new UsuarioModel();
        
        $curp     = strtoupper(trim($this->request->getPost('curp')));
        $password = $this->request->getPost('password');
        
        $data = $model->where('curp', $curp)->first();
        
        if ($data) {
            $passBD = $data['Contraseña'];
            
            if (password_verify($password, $passBD)) {
                $ses_data = [
                    'id'        => $data['ID_usuario'],
                    'curp'      => $data['curp'],
                    'logged_in' => true
                ];
                $session->set($ses_data);
                
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('msg', 'Contraseña incorrecta.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'La CURP ingresada no se encuentra registrada.');
            return redirect()->to('/login');
        }
    }

    
    public function forgotPassword()
    {
        helper(['form', 'url']);
        return view('forgot_password');
    }

    public function sendResetLink()
    {
        $session = session();
        $model   = new UsuarioModel();

        $curp  = strtoupper(trim($this->request->getPost('curp')));
        $email = trim($this->request->getPost('email'));

        $user = $model->where('curp', $curp)->where('email', $email)->first();

        if ($user) {
            $token = bin2hex(random_bytes(32));
            $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));

            $model->update($user['ID_usuario'], [
                'reset_token' => $token,
                'reset_expires_at' => $expiresAt
            ]);

            $resetUrl = base_url("login/reset-password/$token");

            $emailService = \Config\Services::email();
            $emailService->setTo($email);
            $emailService->setSubject('Restablece tu contraseña - Proyecto SMART');
            $emailService->setMessage("Hola,<br><br>Has solicitado restablecer tu contraseña. Haz clic en el siguiente enlace para continuar (válido por 1 hora):<br><br><a href='$resetUrl'>$resetUrl</a><br><br>Si no realizaste esta solicitud, ignora este mensaje.");

            if ($emailService->send()) {
                $session->setFlashdata('success', 'Te hemos enviado las instrucciones a tu correo electrónico.');
                return redirect()->to('/login');
            } else {
                $session->setFlashdata('msg', 'No se pudo enviar el correo. Revisa la configuración del servidor SMTP.');
                return redirect()->to('login/forgot-password');
            }
        } else {
            $session->setFlashdata('msg', 'No coinciden la CURP y el correo ingresados.');
            return redirect()->to('login/forgot-password');
        }
    }

   
    public function resetPassword($token = null)
    {
        if (!$token) {
            return redirect()->to('/login');
        }

        $model = new UsuarioModel();
        $user  = $model->where('reset_token', $token)
                       ->where('reset_expires_at >=', date('Y-m-d H:i:s'))
                       ->first();

        if (!$user) {
            session()->setFlashdata('msg', 'El enlace es inválido o ha expirado.');
            return redirect()->to('/login');
        }

        return view('login/reset_password', ['token' => $token]);
    }

    
    public function updatePassword()
    {
        $session  = session();
        $model    = new UsuarioModel();
        $token    = $this->request->getPost('token');
        $password = $this->request->getPost('password');

        $user = $model->where('reset_token', $token)
                      ->where('reset_expires_at >=', date('Y-m-d H:i:s'))
                      ->first();

        if ($user) {
           
            $model->update($user['ID_usuario'], [
                'Contraseña'       => $password,
                'reset_token'      => null,
                'reset_expires_at' => null
            ]);

            $session->setFlashdata('success', 'Tu contraseña ha sido actualizada con éxito.');
            return redirect()->to('/login');
        } else {
            $session->setFlashdata('msg', 'Token inválido o expirado.');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}