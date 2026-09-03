<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Models\RolModel;

class Usuarios extends BaseController
{
    public function index()
    {
        $usuarioModel = new UsuarioModel();
        $data['usuarios'] = $usuarioModel->obtenerUsuariosConRelaciones(); // * OBTIENE LA LISTA DE USUARIOS CON SUS RELACIONES

        return view('Usuarios/index', $data); // * MUESTRA LA VISTA CON EL LISTADO DE USUARIOS
    }

    public function nuevo()
    {
        helper(['form', 'url']);

        $rolModel = new RolModel();

        $data['roles'] = $rolModel->findAll(); // * OBTIENE TODOS LOS ROLES DISPONIBLES PARA EL FORMULARIO

        return view('Usuarios/nuevo', $data); // * MUESTRA LA VISTA DEL FORMULARIO DE NUEVO USUARIO
    }

    public function crear()
    {
        return $this->nuevo(); // * REDIRIGE AL MÉTODO NUEVO PARA LA CREACIÓN
    }

    public function guardar()
    {
        helper(['form', 'url']);
        $session = session();
        $model   = new UsuarioModel();

        // * OBTIENE Y LIMPIA LA CURP Y CONTRASEÑA ENVIADAS
        $curpInput = strtoupper(trim($this->request->getPost('curp') ?? ''));
        $password  = (string) $this->request->getPost('password');

        // * VALIDA QUE NINGÚN CAMPO ESTÉ VACÍO
        if (empty($curpInput) || empty($password)) {
            $session->setFlashdata('msg', 'Todos los campos son obligatorios.');
            return redirect()->back()->withInput();
        }

        // * CIFRA LA CONTRASEÑA DE FORMA SEGURA CON BCRYPT
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // * ARREGLO CON LOS DATOS PARA GUARDAR EN LA BASE DE DATOS
        $data = [
            'curp'           => $curpInput,
            'password'       => $passwordHash,
            'ROLES_ID_roles' => $this->request->getPost('roles_id'),
        ];

        try {
            // * INTENTA REGISTRAR AL USUARIO Y REDIRIGE AL LOGIN SI ES EXITOSO
            if ($model->insert($data)) {
                $session->setFlashdata('success', '¡Registro exitoso! Ya puedes iniciar sesión.');
                return redirect()->to(base_url('/login'));
            }
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            // * CAPTURA ERRORES DE BD, COMO CURP DUPLICADA (CÓDIGO 1062)
            if (str_contains($e->getMessage(), '1062') || str_contains($e->getMessage(), 'curp')) {
                $session->setFlashdata('msg', 'La CURP ingresada ya se encuentra registrada en el sistema.');
            } else {
                $session->setFlashdata('msg', 'Error en la base de datos: ' . $e->getMessage());
            }
            return redirect()->back()->withInput();
        }

        // * ERROR GENERAL SI EL REGISTRO FALLA
        $session->setFlashdata('msg', 'Ocurrió un error al registrar el usuario.');
        return redirect()->back()->withInput();
    }

    public function eliminar($id = null)
    {
        $model = new UsuarioModel();

        // * ELIMINA EL USUARIO POR SU ID Y REDIRIGE A LA LISTA
        if ($id !== null) {
            $model->delete($id);
            session()->setFlashdata('success', 'Usuario eliminado correctamente.');
        }

        return redirect()->to(base_url('/usuarios'));
    }
}