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
        $cargos = $this->cargos->obtenerCargos();

        $data = ['titulo' => 'Administrar Cargos', 'nombre' => 'Moises Mazo', 'datos' => $cargos];
        echo view('/principal/header', $data);
        echo view('/cargos/cargos', $data);
    }
    function insertar()
    {
        if($this->request->getMethod() == 'post'){
            $nombre = $this->request->getPost('nombre');
            $res = $this->cargos->insertarCargo($nombre);
            if($res == 1){
                return redirect()->to(base_url('/cargos'));
            }
        }
    }
}
