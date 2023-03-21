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
        $municipios = $this->municipios->obtenerMunicipios('A');

        $data = [
            'titulo' => 'Administrar Empleados', 'nombre' => 'Moises Mazo', 'datos' => $empleados,
            'cargos' => $cargos, 'municipios' => $municipios
        ];
        echo view('/principal/header', $data);
        echo view('/empleados/empleados', $data);
    }
    function insertar()
    {
        $tp = $this->request->getPost('tp');
        $idEmple = $this->request->getPost('id');
        $cargo = $this->request->getPost('cargo');
        $nombres = $this->request->getPost('nombres');
        $apellidos = $this->request->getPost('apellidos');
        $anoNac = $this->request->getPost('anoNac');
        $municipio = $this->request->getPost('municipio');
        $salario = $this->request->getPost('salario');
        $periodo = $this->request->getPost('periodo');

        if ($tp == 1) {
            //Verificar si el empleado no esta duplicado, por sus nombres, apellidos y cargo
            $res = $this->empleados->buscarEmpleado($idEmple, $nombres, $apellidos, $cargo);
            if ($res) {
                $data = 'error_insert_emple';
                return redirect()->to(base_url('principal/error' . '/' . $data));
            } else {
                //Si no es duplicado gaurdara al empleado
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
        } else {
            $data = [
                'id' => $idEmple,
                'cargo' => $cargo,
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'anoNac' => $anoNac,
                'municipio' => $municipio
            ];
            //Actuliazar el empleado
            $respues = $this->empleados->actualizarEmpleado($data);
            if ($respues != 0) {
                //Informacion para actualizar el salario del empleado.
                $idSalario = $this->request->getPost('idSalario');
                $dataSalario = [
                    'id' => $idSalario,
                    'salario' => $salario,
                    'periodo' => $periodo
                ];
                //Luego de actualizar el empleado se actualiza su salario.
                $respu = $this->salarios->actualizarSalario($dataSalario);
                if ($respu == 1) {
                    return redirect()->to(base_url('/empleados'));
                }
            }
        }
    }
    function buscarEmpleado($id)
    {
        $dataArray = array();
        $empleados = $this->empleados->buscarEmpleado($id, '', '', 0);
        if (!empty($departamentos)) {
            array_push($dataArray, $departamentos);
        }
        echo json_encode($empleados);
    }
}
