<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaisesModel;

class Paises extends BaseController
{
    protected $pais;
    public function __construct()
    {
        $this->pais = new PaisesModel();
    }

    public function index()
    {
        $pais = $this->pais->obtenerPaises();

        $data = ['titulo' => 'Administrar Países', 'nombre' => 'Moises Mazo', 'datos' => $pais];
        echo view('/principal/header', $data);
        echo view('/paises/paises', $data);
    }
}