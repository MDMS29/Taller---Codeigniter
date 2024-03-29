<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SalariosModel;
use App\Models\EmpleadosModel;

class Salarios extends BaseController
{
    protected $salarios;
    protected $empleados;
    public function __construct()
    {
        helper('sistema');
        $this->salarios = new SalariosModel();
        $this->empleados = new EmpleadosModel();
    }
    public function index($idEmpleado)
    {
        $datosLogin = datosLogin();

        $empleados = $this->empleados->buscarEmpleado($idEmpleado);
        $salarios = $this->salarios->obtenerSalarios($idEmpleado, 'A');
        if (!empty($salarios)) {
            $salario = $salarios;
        } else {
            $salario = [['periodoAno' => '', 'sueldo' => '', 'idSalario' => '', 'idEmpleado' => '', 'nombreEmpleado' => '', 'apellidoEmpleado' => '']];
        }
        $data = [
            'titulo' => 'Administrar Salarios - ' . $empleados[0]['nombresEmple'] . ' ' .  $empleados[0]['apellidosEmple'],
            'dataUser' => $datosLogin, 'salarios' => $salario, 'empleado' => $empleados
        ];
        echo view('/principal/header', $data);
        echo view('/salarios/salarios');
    }
    function buscarSalario($idEmpleado, $idSalario)
    {
        $returnData = array();
        $salario = $this->salarios->buscarSalario($idEmpleado, $idSalario, '', '');
        if (!empty($salario)) {
            array_push($returnData, $salario);
            echo json_encode($returnData);
        }
    }
    function insertar()
    {
        $tipo = $this->request->getPost('tipo');
        $idEmpleado = $this->request->getPost('idEmpleado');
        $idSalario = $this->request->getPost('idSalario');
        $periodo = $this->request->getPost('periodo');
        $salario = $this->request->getPost('salario');
        $idCrea = $this->request->getPost('idCrea');

        if ($tipo == 1) {
            $res = $this->salarios->buscarSalario($idEmpleado, $idSalario, $periodo, $salario);
            if ($res) {
                $data = 'error_insert_salario';
                return redirect()->to(base_url('principal/error' . '/' . $data));
            } else {
                $data = [
                    'id' => $idEmpleado,
                    'salario' => $salario,
                    'periodo' => $periodo,
                    'idCrea' => $idCrea,
                ];
                $res = $this->salarios->insertarSalario($tipo, $data);
                if ($res == 1) {
                    return redirect()->to(base_url('/ver-salarios/' . $idEmpleado));
                }
            }
        } else {
            $data = [
                'idEmpleado' => $idEmpleado,
                'idSalario' => $idSalario,
                'salario' => $salario,
                'periodo' => $periodo,
                'idCrea' => $idCrea
            ];
            $res = $this->salarios->buscarSalario($idEmpleado, $idSalario, $periodo, $salario);
            if ($res) {
                $data = 'error_insert_salario';
                return redirect()->to(base_url('principal/error' . '/' . $data));
            } else {
                $res = $this->salarios->insertarSalario($tipo, $data);
                if ($res == 1) {
                    return redirect()->to(base_url('/ver-salarios/' . $idEmpleado));
                }
            }
        }
    }
    function eliminarResLogic($idEmpleado, $idSalario, $estado, $tipo)
    {
        $data = [
            'idSalario' => $idSalario,
            'idEmpleado' => $idEmpleado,
            'estado' => $estado,
        ];
        $res = $this->salarios->actualizarSalario($data);
        if ($res == 1) {
            if ($tipo == 1) {
                return redirect()->to(base_url('/ver-salarios/' . $idEmpleado));
            } else {
                return redirect()->to(base_url('/salarios-eliminados/' . $idEmpleado));
            }
        }
    }
    public function eliminados($idEmpleado)
    {
        $datosLogin = datosLogin();
        $empleados = $this->empleados->buscarEmpleado($idEmpleado);
        $salarios = $this->salarios->obtenerSalarios($idEmpleado, 'I');
        if (!empty($salarios)) {
            $salario = $salarios;
        } else {
            $salario = [['periodoAno' => '', 'sueldo' => '', 'idSalario' => '', 'idEmpleado' => '', 'nombreEmpleado' => '', 'apellidoEmpleado' => '']];
        }
        $data = [
            'titulo' => 'Administrar Salarios - '  . $empleados[0]['nombresEmple'] . ' ' .  $empleados[0]['apellidosEmple'], 'dataUser' => $datosLogin, 'salarios' => $salario, 'empleado' => $empleados
        ];
        echo view('/principal/header', $data);
        echo view('/salarios/salariosEliminados');
    }
}
