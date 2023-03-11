<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpleadosModel;

class Empleados extends BaseController
{
    public function __construct()
    {
    }
    function verEmpleados()
    {
        $modelo = new EmpleadosModel();
        $empleados = $modelo->obtenerClientes();
        echo json_encode($empleados);
        
    }

    public function index()
    {
        $data = ['titulo' => 'Proyecto Taller', 'nombre' => 'Moises Mazo', 'tituloPrin' => 'Principal'];
        echo view('/principal/header', $data);
        echo view('/empleados/empleados');
    }
}