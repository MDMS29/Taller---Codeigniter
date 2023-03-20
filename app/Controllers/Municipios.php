<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MunicipiosModel;
use App\Models\DepartamentosModel;
use App\Models\PaisesModel;

class Municipios extends BaseController
{
    protected $paises;
    protected $departamentos;
    protected $municipios;
    public function __construct()
    {
        $this->paises = new PaisesModel();
        $this->departamentos = new DepartamentosModel();
        $this->municipios = new MunicipiosModel();
    }
    public function index()
    {
        $paises = $this->paises->obtenerPaises();
        $municipios = $this->municipios->obtenerMunicipios(0);

        $data = ['titulo' => 'Administrar Municipios', 'nombre' => 'Moises Mazo', 'datos' => $municipios, 'paises' => $paises,];
        echo view('/principal/header', $data);
        echo view('/municipios/municipios', $data);
    }
    function obtenerDepartamentosPais($id)
    {
        $dataArray = array();
        $departamentos = $this->departamentos->obtenerDepartamentosPais($id);
        if (!empty($departamentos)) {
            array_push($dataArray, $departamentos);
        }
        echo json_encode($departamentos);
    }

    function obtenerMunicipio($id)
    {
        $dataArray = array();
        $departamentos = $this->municipios->obtenerMunicipios($id);
        if (!empty($departamentos)) {
            array_push($dataArray, $departamentos);
        }
        echo json_encode($departamentos);
    }

    function insertar()
    {
        $tp = $this->request->getPost('tp');
        $id = $this->request->getPost('id');
        $departamento = $this->request->getPost('departamento');
        $nombre = $this->request->getPost('nombre');
        if ($tp == 1) {
            //Validacion del que el registro no este duplicado
            $res = $this->municipios->buscarMunicipio($nombre, $departamento);
            if ($res) {
                $data = 'error_insert_muni';
                return redirect()->to(base_url('principal/error' . '/' . $data));
            } else {
                //Registrar nuevo municipio
                $res = $this->municipios->insertarActuMunicipio(0, $departamento, $nombre);
                if ($res == 1) {
                    return redirect()->to(base_url('/municipios'));
                }
            }
        } else {
            //Actualizar el municipio
            $res = $this->municipios->insertarActuMunicipio($id, $departamento, $nombre);
            if ($res == 1) {
                return redirect()->to(base_url('/municipios'));
            }
        }
    }

    function eliminarResLogic($id, $estado, $tipe)
    {
    }
}
