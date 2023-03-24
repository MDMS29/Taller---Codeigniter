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

    function buscarSalario($idSalario, $idEmpleado)
    {
        $salarios = $this->salarios->obtenerSalarios($idSalario, $idEmpleado);
        if (!empty($salarios)) {
            echo json_encode($salarios);
        }
    }
}
