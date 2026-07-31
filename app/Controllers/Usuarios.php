<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuarios extends BaseController
{
    public function index()
    {
        $model = new UsuarioModel();
        $data['usuarios'] = $model->findAll();

        return view('usuarios/index', $data);
    }

    public function crear()
    {
        return view('usuarios/crear');
    }

    public function guardar()
    {
        $model = new UsuarioModel();

        $data = [
            'curp'             => strtoupper(trim($this->request->getPost('curp'))),
            'Contraseña'       => $this->request->getPost('password'),
            'PUESTO_ID_puesto' => $this->request->getPost('puesto_id'),
            'ROLES_ID_roles'   => $this->request->getPost('roles_id'),
        ];

        $model->save($data);
        session()->setFlashdata('msg', 'Usuario registrado correctamente.');

        return redirect()->to('usuarios');
    }

    public function eliminar($id = null)
    {
        $model = new UsuarioModel();
        $model->delete($id);
        session()->setFlashdata('msg', 'Usuario eliminado.');

        return redirect()->to('usuarios');
    }
}