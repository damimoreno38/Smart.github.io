<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class Login extends BaseController
{
    public function index()
    {
        helper(['form']);
        return view('login');
    }

    public function auth()
    {
        $session = session();
        $model   = new UsuarioModel();
        
        $nombre   = $this->request->getVar('nombre');
        $correo   = $this->request->getVar('correo');
        $password = $this->request->getVar('password');
        
        $data = $model->where('Correo', $correo)
                      ->where('Nombre_usuario', $nombre)
                      ->first();
        
        if ($data) {
            $pass = $data['Contraseña'];
            
            // Verifica la contraseña
            if (password_verify($password, $pass) || $password === $pass) {
                $ses_data = [
                    'id'        => $data['ID_usuario'],
                    'nombre'    => $data['Nombre_usuario'],
                    'correo'    => $data['Correo'],
                    'logged_in' => true
                ];
                $session->set($ses_data);
                
                // REDIRECCIÓN CORREGIDA: nos manda al módulo de usuarios
                return redirect()->to('/usuarios');
            } else {
                $session->setFlashdata('msg', 'Contraseña incorrecta.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Los datos ingresados no se encuentran registrados.');
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