<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    // * DEFINE LA TABLA DE USUARIOS EN LA BASE DE DATOS
    protected $table            = 'usuarios';
    
    // * ESTABLECE LA LLAVE PRIMARIA DE LA TABLA USUARIOS
    protected $primaryKey       = 'ID_usuario';
    
    // * CAMPOS PERMITIDOS PARA INSERTAR O ACTUALIZAR DATOS
    protected $allowedFields    = ['curp', 'password', 'ROLES_ID_roles'];

    // * MÉTODO PARA OBTENER TODOS LOS USUARIOS JUNTO CON EL NOMBRE DE SU ROL
    public function obtenerUsuariosConRelaciones()
    {
        // * HACE UN JOIN CON LA TABLA ROLES PARA TRAER EL TIPO DE ROL Y DEVUELVE TODOS LOS REGISTROS
        return $this->select('usuarios.*, roles.Tipo_rol')
                    ->join('roles', 'roles.ID_roles = usuarios.ROLES_ID_roles', 'left')
                    ->findAll();
    }
}