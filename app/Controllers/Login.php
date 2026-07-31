<?php

namespace App\Controllers;
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
        
        $data = $model->where('Curp', $curp)->first();
        
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

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}