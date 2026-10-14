<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Perfil extends BaseController
{
    // * MÉTODO PARA MOSTRAR LA VISTA DEL PERFIL DE USUARIO
    public function index()
    {
        $session = session();

        // * VERIFICA QUE EL USUARIO ESTÉ AUTENTICADO
        if (!$session->get('isLoggedIn') && !$session->get('logged_in')) {
            return redirect()->to(base_url('/login'));
        }

        // * OBTIENE EL ID DEL USUARIO DESDE LA SESIÓN
        $userId = $session->get('id') ?? $session->get('id_usuario') ?? $session->get('user_id');

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($userId);

        // * SI EL USUARIO NO EXISTE EN LA BASE DE DATOS, REDIRIGE AL LOGIN
        if (!$usuario) {
            return redirect()->to(base_url('/login'));
        }

        $data = [
            'titulo'  => 'Mi Perfil',
            'usuario' => $usuario
        ];

        return view('perfil', $data);
    }

    // * MÉTODO PARA GUARDAR Y ACTUALIZAR LA INFORMACIÓN DEL PERFIL
    public function guardar()
    {
        $session = session();

        // * VERIFICA LA SESIÓN ACTIVA DEL USUARIO
        if (!$session->get('isLoggedIn') && !$session->get('logged_in')) {
            return redirect()->to(base_url('/login'));
        }

        $userId = $session->get('id') ?? $session->get('id_usuario') ?? $session->get('user_id');

        // * ARREGLO PARA ALMACENAR ÚNICAMENTE LOS CAMPOS RECIBIDOS
        $dataUpdate = [];

        if ($this->request->getPost('nombre')) {
            $dataUpdate['Nombre'] = $this->request->getPost('nombre');
        }

        if ($this->request->getPost('area')) {
            $dataUpdate['Area'] = $this->request->getPost('area');
        }

        if ($this->request->getPost('correo')) {
            $dataUpdate['Correo'] = $this->request->getPost('correo');
        }

        // * PROCESA EL ARCHIVO DE LA FOTO DE PERFIL SI FUE ENVIADO
        $file = $this->request->getFile('foto');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // * GENERA UN NOMBRE ÚNICO Y MUEVE EL ARCHIVO A LA CARPETA PUBLIC
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/perfiles', $newName);
            $dataUpdate['foto'] = $newName;
        }

        // * VALIDA QUE EXISTAN DATOS PARA ACTUALIZAR
        if (empty($dataUpdate)) {
            return redirect()->to(base_url('/perfil'))->with('error', 'No ingresaste ningún dato para actualizar.');
        }

        $usuarioModel = new UsuarioModel();

        // * ACTUALIZA EL REGISTRO EN LA BASE DE DATOS
        if ($userId && $usuarioModel->update($userId, $dataUpdate)) {
            // * ACTUALIZA EL NOMBRE EN LA SESIÓN SI FUE MODIFICADO
            if (isset($dataUpdate['Nombre'])) {
                $session->set('name', $dataUpdate['Nombre']);
            }

            return redirect()->to(base_url('/perfil'))->with('mensaje', 'Información actualizada correctamente.');
        } else {
            return redirect()->to(base_url('/perfil'))->with('error', 'No se pudo actualizar la información.');
        }
    }
}