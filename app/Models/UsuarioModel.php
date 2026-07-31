<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'USUARIOS';
    protected $primaryKey       = 'ID_usuario';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';

    protected $allowedFields    = [
        'curp', 
        'email',
        'Contraseña', 
        'PUESTO_ID_puesto', 
        'ROLES_ID_roles',
        'reset_token',          
        'reset_expires_at',
    ];

    protected $useTimestamps    = false;

    protected $beforeInsert     = ['hashPassword'];
    protected $beforeUpdate     = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['Contraseña']) && !empty($data['data']['Contraseña'])) {
            $data['data']['Contraseña'] = password_hash($data['data']['Contraseña'], PASSWORD_DEFAULT);
        }

        return $data;
    }
}