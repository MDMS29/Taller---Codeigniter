<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CargosModel;

class Cargos extends BaseController
{
    protected $cargos;
    public function __construct()
    {
        $this->cargos = new CargosModel();
    }
    public function index()
    {
        $cargos = $this->cargos->obtenerCargos('A');

        $data = ['titulo' => 'Administrar Cargos', 'nombre' => 'Moises Mazo', 'datos' => $cargos];
        echo view('/principal/header', $data);
        echo view('/cargos/cargos', $data);
    }
    function insertar()
    {

        $tp = $this->request->getPost('tp');
        $id = $this->request->getPost('id');
        $nombre = $this->request->getPost('nombre');

        if ($tp == 1) {
            $res = $this->cargos->buscarCargo(0, $nombre);
            if ($res) {
                $data = 'error_name_cargo';
                return redirect()->to(base_url('principal/error/' . $data));
            } else {
                $res = $this->cargos->insertarCargo($nombre);
                if ($res == 1) {
                    return redirect()->to(base_url('/cargos'));
                }
            }
        } else {
            $res = $this->cargos->actualizarCargo($id, $nombre);
            if ($res == 1) {
                return redirect()->to(base_url('/cargos'));
            }
        }
    }
    function buscarCargo($id)
    {
        $cargos = $this->cargos->buscarCargo($id, '');
        if (!empty($cargos)) {
            echo json_encode($cargos);
        }
    }
    public function eliminados()
    {
        $cargos = $this->cargos->obtenerCargos('I');

        $data = ['titulo' => 'Administrar Cargos Eliminados', 'nombre' => 'Moises Mazo', 'datos' => $cargos];
        echo view('/principal/header', $data);
        echo view('/cargos/cargosEliminados', $data);
    }
    function eliminarResLogic($id, $estado, $tipe)
    {
        if ($tipe == 1) {
            $res = $this->cargos->eliminarResModelLogic($id, $estado);
            if ($res) {
                return redirect()->to(base_url('/cargos'));
            }
        } else {
            $res = $this->cargos->eliminarResModelLogic($id, $estado);
            if ($res) {
                return redirect()->to(base_url('/cargos/eliminados'));
            }
        }
    }
}
