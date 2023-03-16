<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpleadosModel;
use App\Models\CargosModel;
use App\Models\MunicipiosModel;
use App\Models\SalariosModel;

class Empleados extends BaseController
{
    protected $empleados;
    protected $cargos;
    protected $municipios;
    protected $salarios;

    public function __construct()
    {
        $this->empleados = new EmpleadosModel();
        $this->cargos = new CargosModel();
        $this->municipios = new MunicipiosModel();
        $this->salarios = new SalariosModel();

    }
    public function index()
    {
        $empleados = $this->empleados->obtenerEmpleados();
        $cargos = $this->cargos->obtenerCargos();
        $municipios = $this->municipios->obtenerMunicipios();

        $data = [
            'titulo' => 'Administrar Empleados', 'nombre' => 'Moises Mazo', 'datos' => $empleados,
            'cargos' => $cargos, 'municipios' => $municipios
        ];
        echo view('/principal/header', $data);
        echo view('/empleados/empleados', $data);
    }
    function insertar()
    {
        if ($this->request->getMethod() == "post") {
            $cargo = $this->request->getPost('cargo');
            $nombres = $this->request->getPost('nombres');
            $apellidos = $this->request->getPost('apellidos');
            $anoNac = $this->request->getPost('anoNac');
            $municipio = $this->request->getPost('municipio');
            $salario = $this->request->getPost('salario');
            $periodo = $this->request->getPost('periodo');

            $data = [
                'cargo' => $cargo,
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'anoNac' => $anoNac,
                'municipio' => $municipio
            ];

            $idEmple = $this->empleados->insertarEmpleado($data);
            //INSERTAR SALARIO DENTRO DEL EMPLEADO REGISTRADO
            $dataSalario = [
                'id' => $idEmple,
                'salario' => $salario,
                'periodo' => $periodo
            ];
            $res = $this->salarios->insertarSalario($dataSalario);

            if ($res == 1) {
                return redirect()->to(base_url('/empleados'));
            }
        }
    }
}
