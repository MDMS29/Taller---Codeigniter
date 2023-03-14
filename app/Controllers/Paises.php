<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaisesModel;

class Paises extends BaseController
{
    protected $pais;
    public function __construct()
    {
        $this->pais = new PaisesModel();
    }

    public function index()
    {
        $pais = $this->pais->obtenerPaises();

        $data = ['titulo' => 'Administrar Países', 'nombre' => 'Moises Mazo', 'datos' => $pais];
        echo view('/principal/header', $data);
        echo view('/paises/paises', $data);
    }
    function insertar()
    {
        if ($this->request->getMethod() == 'post') {
            $codigo = $this->request->getPost('codigo');
            $nombre = $this->request->getPost('nombre');
            $res = $this->pais->insertarPais($codigo, $nombre);
            if ($res == 1) {
                return redirect()->to(base_url('/paises'));
            }
        }
    }
    function buscarPais($id)
    {
        $dataArray = array();
        $pais = $this->pais->buscarPais($id);
        if (!empty($pais)) {
            array_push($dataArray, $pais);
        }
        echo json_encode($pais);
    }
    function actualizarPais($data)
    {
        echo $data;
    }
}
