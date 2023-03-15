<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartamentosModel;
use App\Models\PaisesModel;

class Departamentos extends BaseController
{
    protected $departamentos;
    protected $paises;
    public function __construct()
    {
        $this->departamentos = new DepartamentosModel();
        $this->paises = new PaisesModel();
    }
    public function index()
    {
        $departamentos = $this->departamentos->obtenerDepartamentos();
        $paises = $this->paises->obtenerPaises();

        $data = ['titulo' => 'Administrar Departamentos', 'nombre' => 'Moises Mazo', 'datos' => $departamentos, 'paises' => $paises];
        echo view('/principal/header', $data);
        echo view('/departamentos/departamentos', $data);
    }
    function insertar()
    {
        $tipe = $this->request->getPost('tipe');
        $id = $this->request->getPost('id');
        $pais = $this->request->getPost('pais');
        $nombre = $this->request->getPost('nombre');
        if ($tipe == 1) {
            $res = $this->departamentos->insertarDepartamento($pais, $nombre);
            if ($res == 1) {
                return redirect()->to(base_url('/departamentos'));
            }
        } else {
            $res = $this->departamentos->actualizarDepartamento($id, $pais, $nombre);
            if ($res == 1) {
                return redirect()->to(base_url('/departamentos'));
            }
        }
    }
    function buscarDepartamento($id)
    {
        $dataArray = array();
        $departamentos = $this->departamentos->buscarDepartamento($id);
        if (!empty($departamentos)) {
            array_push($dataArray, $departamentos);
        }
        echo json_encode($departamentos);
    }
}
