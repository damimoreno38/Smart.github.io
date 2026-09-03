<?php

namespace App\Controllers;

class PanelInicial extends BaseController
{
    public function index()
    {
        return view('panelinicial'); // * CARGA Y MUESTRA LA VISTA DEL PANEL INICIAL
    }
}