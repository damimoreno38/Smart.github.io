<?php

namespace App\Models;

use CodeIgniter\Model;

class PuestoModel extends Model
{
    // * DEFINE LA TABLA ASOCIADA A ESTE MODELO EN LA BASE DE DATOS
    protected $table            = 'puesto';
    
    // * ESTABLECE LA LLAVE PRIMARIA DE LA TABLA
    protected $primaryKey       = 'ID_puesto';
    
    // * CAMPOS PERMITIDOS PARA LAS OPERACIONES DE INSERCIÓN Y ACTUALIZACIÓN
    protected $allowedFields    = ['Nombre_puesto'];
    
    // * DEFINE EL FORMATO DE LOS DATOS DEVUELTOS COMO UN ARREGLO
    protected $returnType       = 'array';
}