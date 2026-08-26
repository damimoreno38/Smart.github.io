<?php

namespace App\Models;

use CodeIgniter\Model;

class PuestoModel extends Model
{
    protected $table            = 'puesto';
    protected $primaryKey       = 'ID_puesto';
    protected $allowedFields    = ['Nombre_puesto'];
    protected $returnType       = 'array';
}