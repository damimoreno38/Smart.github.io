<?php

namespace App\Controllers;

class Mapa extends BaseController
{
    public function index()
    {
        return view('mapa'); // * MUESTRA LA VISTA PRINCIPAL DEL MAPA
    }
    
    public function errorMapa()
   {
    // * MUESTRA LA VISTA DE ERROR DEL MAPA
    return view('errors/error_mapa');
   }

    public function ubicacion()
    {
        // * DEVUELVE DATOS DE UBICACIÓN EN FORMATO JSON
        return $this->response->setJSON([
            'latitud'  => 19.4326,
            'longitud' => -99.1332,
            'nombre'   => 'Ciudad de México'
        ]);
    }
}