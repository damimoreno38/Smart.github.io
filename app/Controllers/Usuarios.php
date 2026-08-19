<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Usuarios extends BaseController
{
    public function index()
    {
        $usuarioModel = new UsuarioModel();
        $data['usuarios'] = $usuarioModel->findAll();

        return view('usuarios/index', $data); 
    }

    public function nuevo()
    {
        return view('usuarios/nuevo');
    }

    public function crear()
    {
        return view('usuarios/nuevo');
    }

    public function guardar()
    {
        $usuarioModel = new UsuarioModel();

        $curp = strtoupper($this->request->getPost('curp'));
        $password = $this->request->getPost('password');
        $puestoId = $this->request->getPost('puesto_id');
        $rolesId = $this->request->getPost('roles_id');

        $existe = $usuarioModel->where('curp', $curp)->first();
        if ($existe) {
            return redirect()->back()->withInput()->with('msg', 'La CURP ya se encuentra registrada.');
        }

        $datos = [
            'curp' => $curp,
            'Contraseña' => $password, 
            'PUESTO_ID_puesto' => $puestoId,
            'ROLES_ID_roles' => $rolesId
        ];

        if ($usuarioModel->insert($datos)) {
            return redirect()->to(base_url('/'))->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
        } else {
            return redirect()->back()->withInput()->with('msg', 'Error al registrar el usuario. Inténtalo de nuevo.');
        }
    }

    public function eliminar($id = null)
    {
        $usuarioModel = new UsuarioModel();
        if ($id && $usuarioModel->delete($id)) {
            return redirect()->to(base_url('usuarios'))->with('msg', 'Usuario eliminado correctamente.');
        }
        return redirect()->to(base_url('usuarios'))->with('msg', 'No se pudo eliminar el usuario.');
    }
}