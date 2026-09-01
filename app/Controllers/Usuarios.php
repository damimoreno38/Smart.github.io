<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Models\PuestoModel;
use App\Models\RolModel;

class Usuarios extends BaseController
{
    public function index()
    {
        $usuarioModel = new UsuarioModel();
        $data['usuarios'] = $usuarioModel->obtenerUsuariosConRelaciones();

        return view('Usuarios/index', $data);
    }

    public function nuevo()
    {
        helper(['form', 'url']);

        $puestoModel = new PuestoModel();
        $rolModel    = new RolModel();

        $data['puestos'] = $puestoModel->findAll();
        $data['roles']   = $rolModel->findAll();

        return view('Usuarios/nuevo', $data);
    }

    public function crear()
    {
        return $this->nuevo();
    }

    public function guardar()
    {
        helper(['form', 'url']);
        $session = session();
        $model   = new UsuarioModel();

        $curpInput = strtoupper(trim($this->request->getPost('curp') ?? ''));
        $password  = (string) $this->request->getPost('password');

        if (empty($curpInput) || empty($password)) {
            $session->setFlashdata('msg', 'Todos los campos son obligatorios.');
            return redirect()->back()->withInput();
        }

        // Hasheo seguro usando la columna 'password'
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'curp'             => $curpInput,
            'password'         => $passwordHash,
            'PUESTO_ID_puesto' => $this->request->getPost('puesto_id'),
            'ROLES_ID_roles'   => $this->request->getPost('roles_id'),
        ];

        try {
            if ($model->insert($data)) {
                $session->setFlashdata('success', '¡Registro exitoso! Ya puedes iniciar sesión.');
                return redirect()->to(base_url('/login'));
            }
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            if (str_contains($e->getMessage(), '1062') || str_contains($e->getMessage(), 'curp')) {
                $session->setFlashdata('msg', 'La CURP ingresada ya se encuentra registrada en el sistema.');
            } else {
                $session->setFlashdata('msg', 'Error en la base de datos: ' . $e->getMessage());
            }
            return redirect()->back()->withInput();
        }

        $session->setFlashdata('msg', 'Ocurrió un error al registrar el usuario.');
        return redirect()->back()->withInput();
    }

    public function eliminar($id = null)
    {
        $model = new UsuarioModel();

        if ($id !== null) {
            $model->delete($id);
            session()->setFlashdata('success', 'Usuario eliminado correctamente.');
        }

        return redirect()->to(base_url('/usuarios'));
    }
}