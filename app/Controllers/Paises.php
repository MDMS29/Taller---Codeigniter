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
        $tipe = $this->request->getPost('tipe');
        $id = $this->request->getPost('id');
        $codigo = $this->request->getPost('codigo');
        $nombre = $this->request->getPost('nombre');
        if ($tipe == 1) {
            $res = $this->pais->insertarPais($codigo, $nombre);
            if ($res == 'y') {
                return redirect()->to(base_url('/paises'));
            }
        } else {
            $res = $this->pais->actualizarPais($codigo, $nombre, $id);
            if ($res == 'y') {
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
}
