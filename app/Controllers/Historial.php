<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HistorialModel;

class Historial extends BaseController
{
    protected $historial;
    public function __construct()
    {
        helper('sistema');
        $this->historial = new HistorialModel();
    }

    public function index()
    {
        $dataLogin = datosLogin();
        $historial = $this->historial->obtenerHistorial();

        $data = ['titulo' => 'Historial de Acciones', 'dataUser' => $dataLogin, 'datos' => $historial];
        echo view('/principal/header', $data);
        echo view('/historial/acciones', $data);
    }

    function detalleHistorial($id)
    {
        $data = $this->historial->detalleHistorial($id);
        if(!empty($data)){
            return json_encode($data);
        }
    }
}
