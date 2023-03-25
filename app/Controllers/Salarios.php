<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SalariosModel;

class Salarios extends BaseController
{
    protected $salarios;

    public function __construct()
    {
        $this->salarios = new SalariosModel();
    }

    public function index()
    {
        
        $data = [
            'titulo' => 'Administrar Empleados', 'nombre' => 'Moises Mazo'
        ];
        echo view('/principal/header', $data);
        echo view('/salarios/salarios', $data);

    }
    function buscarSalario($idSalario, $idEmpleado)
    {
        $returnData = array();
        $salario = $this->salarios->buscarSalario($idSalario, $idEmpleado);
        if (!empty($salario)) {
            array_push($returnData, $salario);
            echo json_encode($returnData);
        }
    }
    function insertar()
    {
    }
}
