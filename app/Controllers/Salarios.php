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

    public function index($idEmpleado, $idSalario)
    {
        $salarios = $this->salarios->obtenerSalarios($idEmpleado);
        $data = [
            'titulo' => 'Administrar Salarios - ' . $salarios[0]['nombreEmpleado'] . ' ' .  $salarios[0]['apellidoEmpleado'], 'nombre' => 'Moises Mazo', 'salarios' => $salarios
        ];
        echo view('/principal/header', $data);
        echo view('/salarios/salarios');
        
    }
    function buscarSalario($idEmpleado, $idSalario)
    {
        $returnData = array();
        $salario = $this->salarios->buscarSalario($idEmpleado, $idSalario);
        if (!empty($salario)) {
            array_push($returnData, $salario);
            echo json_encode($returnData);
        }
    }
    function insertar()
    {
    }
}
