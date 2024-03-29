<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpleadosModel;
use App\Models\CargosModel;
use App\Models\MunicipiosModel;
use App\Models\SalariosModel;
use App\Models\PaisesModel;

class Empleados extends BaseController
{
    protected $empleados;
    protected $cargos;
    protected $municipios;
    protected $salarios;
    protected $paises;
    public function __construct()
    {
        helper('sistema');
        $this->paises = new PaisesModel();
        $this->empleados = new EmpleadosModel();
        $this->cargos = new CargosModel();
        $this->municipios = new MunicipiosModel();
        $this->salarios = new SalariosModel();
    }
    public function index()
    {
        $datosLogin = datosLogin();
        $paises = $this->paises->obtenerPaises('');
        $empleados = $this->empleados->obtenerEmpleados('A');
        $cargos = $this->cargos->obtenerCargos('');
        $municipios = $this->municipios->obtenerMunicipios('A');
        $data = [
            'titulo' => 'Administrar Empleados', 'dataUser' => $datosLogin, 'datos' => $empleados,
            'cargos' => $cargos, 'municipios' => $municipios, 'paises' => $paises
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
        $idCrea = $this->request->getPost('idCrea');

        if ($tp == 1) {
            $data = [
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'id_municipio' => $municipio,
                'nacimientoAno' => $anoNac,
                'id_cargo' => $cargo,
                'usuarioCrea' => $idCrea
            ];
            $res = $this->empleados->save($data);
            if ($res == 1) {
                return redirect()->to(base_url('/empleados'));
            }
        } else {
            $data = [
                'id' => $idEmple,
                'cargo' => $cargo,
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'anoNac' => $anoNac,
                'municipio' => $municipio,
                'usuarioCrea' => $idCrea
            ];
            //Actuliazar el empleado
            $respues = $this->empleados->actualizarEmpleado($data);
            if ($respues == 1) {
                return redirect()->to(base_url('/empleados'));
            }
        }
    }
    function buscarEmpleado($id)
    {
        $empleados = $this->empleados->buscarEmpleado($id, '', '');
        if (!empty($empleados)) {
            echo json_encode($empleados);
        }
    }
    public function eliminados()
    {
        $datosLogin = datosLogin();

        $empleados = $this->empleados->obtenerEmpleados('I');
        $data = [
            'titulo' => 'Administrar Empleados Eliminados', 'dataUser' => $datosLogin, 'datos' => $empleados
        ];
        echo view('/principal/header', $data);
        echo view('/empleados/empleadosEliminados', $data);
    }
    function eliminarResLogic($id, $estado, $tipo)
    {
        //ELIMINAR
        if ($tipo == 1) {
            if ($id && $estado) {
                $res = $this->empleados->eliminarResModelEmple($id, $estado);
                if ($res == 1) {

                    return redirect()->to(base_url('/empleados'));
                }
            }
        }
        //RESTAURAR
        else {
            $res = $this->empleados->eliminarResModelEmple($id, $estado);
            if ($res == 1) {
                return redirect()->to(base_url('/empleados/eliminados'));
            }
        }
    }
}
