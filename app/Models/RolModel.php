<?php

namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
    // * DEFINE LA TABLA DE ROLES EN LA BASE DE DATOS
    protected $table            = 'roles';
    
    // * ESTABLECE LA LLAVE PRIMARIA DE LA TABLA DE ROLES
    protected $primaryKey       = 'ID_roles';
    
    // * CAMPOS PERMITIDOS PARA MODIFICAR EL TIPO DE ROL
    protected $allowedFields    = ['Tipo_rol'];
    
    // * CONFIGURA EL TIPO DE RETORNO DE LOS DATOS COMO ARREGLO
    protected $returnType       = 'array';
}