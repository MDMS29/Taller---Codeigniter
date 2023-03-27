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
    public function index($idEmpleado)
    {
        $salarios = $this->salarios->obtenerSalarios($idEmpleado, 'A');
        $data = [
            'titulo' => 'Administrar Salarios - ' . $salarios[0]['nombreEmpleado'] . ' ' .  $salarios[0]['apellidoEmpleado'], 'nombre' => 'Moises Mazo', 'salarios' => $salarios
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

        if ($tipo == 1) {
            $res = $this->salarios->buscarSalario($idEmpleado, $idSalario, $periodo, $salario);
            if ($res) {
                $data = 'error_insert_salario';
                return redirect()->to(base_url('principal/error' . '/' . $data));
            } else {
                $data = [
                    'id' => $idEmpleado,
                    'salario' => $salario,
                    'periodo' => $periodo
                ];
                $res = $this->salarios->insertarSalario($tipo, $data);
                if ($res == 1) {
                    return redirect()->to(base_url('/verSalarios/' . $idEmpleado));
                }
            }
        } else {
            $data = [
                'idEmpleado' => $idEmpleado,
                'idSalario' => $idSalario,
                'salario' => $salario,
                'periodo' => $periodo
            ];
            $res = $this->salarios->insertarSalario($tipo, $data);
            if ($res == 1) {
                return redirect()->to(base_url('/verSalarios/' . $idEmpleado));
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
            return redirect()->to(base_url('/ver-salarios/' . $idEmpleado));
        }
    }
    public function eliminados($idEmpleado)
    {
        // $salarios = $this->salarios->obtenerSalarios($idEmpleado, 'I');
        $data = [
            'titulo' => 'Administrar Salarios - ', 'nombre' => 'Moises Mazo'
        ];
        echo view('/principal/header', $data);
        echo view('/salarios/salariosEliminados');
    }
}
