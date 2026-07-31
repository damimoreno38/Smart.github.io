<?php

namespace App\Controllers;

class Mapa extends BaseController
{
    public function index()
    {
        return view('mapa');
    }
    
    public function errorMapa()
   {
    
    return view('errors/error_mapa');
   }

    public function ubicacion()
    {
        return $this->response->setJSON([
            'latitud'  => 19.4326,
            'longitud' => -99.1332,
            'nombre'   => 'Ciudad de México'
        ]);
    }
}