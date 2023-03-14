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
        $municipios = $this->municipios->obtenerMunicipios();

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
    function insertar()
    {
        if ($this->request->getMethod() == 'post') {
            $departamento = $this->request->getPost('departamento');
            $nombre = $this->request->getPost('nombre');
            $res = $this->municipios->insertarMunicipio($departamento, $nombre);
            if ($res == 1) {
                return redirect()->to(base_url('/municipios'));
            }
        }
    }
}
