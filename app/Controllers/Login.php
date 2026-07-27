<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class Login extends Controller
{
    public function index()
    {
        helper(['form']);
        return view('login');
    }

    public function auth()
    {
        $session = session();
        $model = new UsuarioModel();
        
        $nombre   = $this->request->getVar('nombre');
        $email    = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        // Busca al usuario por su correo electrónico
        $data = $model->where('email', $email)->first();
        
        if ($data) {
            $pass = $data['password'];
            
            // Verifica la contraseña
            if (password_verify($password, $pass) || $password === $pass) {
                $ses_data = [
                    'id'        => $data['id'],
                    'nombre'    => $data['nombre'],
                    'email'     => $data['email'],
                    'logged_in' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('msg', 'Contraseña incorrecta.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'El correo no se encuentra registrado.');
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