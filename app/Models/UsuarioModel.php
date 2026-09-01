<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id'; // Cambia a 'ID_usuario' si así se llama en tu base de datos
    protected $allowedFields    = ['curp', 'password', 'PUESTO_ID_puesto', 'ROLES_ID_roles'];

    // Método para obtener relaciones si lo usas en tu panel de administración
    public function obtenerUsuariosConRelaciones()
    {
        return $this->select('usuarios.*, puestos.nombre_puesto, roles.nombre_rol')
                    ->join('puestos', 'puestos.id_puesto = usuarios.PUESTO_ID_puesto', 'left')
                    ->join('roles', 'roles.id_roles = usuarios.ROLES_ID_roles', 'left')
                    ->findAll();
    }
}