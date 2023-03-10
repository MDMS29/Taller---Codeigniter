<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientesModel;

class Principal extends BaseController
{
    public $nombres;
    public function __construct()
    {
    }
    function verEmpleados()
    {
        $modelo = new ClientesModel();
        $empleados = $modelo->obtenerClientes();
        echo json_encode($empleados);
        exit();
    }

    public function index()
    {
        $data = ['titulo' => 'Proyecto Taller', 'nombre' => 'Moises Mazo', 'tituloPrin' => 'Principal'];
        echo view('/principal/header', $data);
        echo view('/principal/principal');
    }
}