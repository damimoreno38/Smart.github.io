<?php

namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
    protected $table            = 'roles';
    protected $primaryKey       = 'ID_roles';
    protected $allowedFields    = ['Tipo_rol'];
    protected $returnType       = 'array';
}