<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientesModel;

class Principal extends BaseController
{
    public function __construct()
    {
    }
    public function index()
    {
        // $modelo = new ClientesModel();
        // 'empleado'  => $modelo->obtenerClientes()
        $data = ['titulo' => 'Proyecto Taller', 'nombre' => 'Moises Mazo'];
        echo view('/principal/header', $data);
        // echo view('/principal/principal');
    }
}
