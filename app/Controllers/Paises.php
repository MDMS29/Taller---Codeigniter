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
            $res = $this->pais->buscarPais(0, $codigo);
            if ($res) {
                $data = 'error_insert_code';
                return redirect()->to(base_url('principal/error' . '/' . $data));
            } else {
                $res = $this->pais->buscarPais(0, $codigo);
                if ($res) {
                    $data = 'error_insert_code';
                    return redirect()->to(base_url('principal/error' . '/' . $data));
                } else {
                    $res = $this->pais->insertarPais($codigo, $nombre, $tipe);
                    if ($res == 1) {
                        return redirect()->to(base_url('/paises'));
                    }
                }
            }
        } else {
            $res = $this->pais->buscarPais(0, $codigo);
            if ($res) {
                $data = 'error_insert_code';
                return redirect()->to(base_url('principal/error' . '/' . $data));
            } else {
                $res = $this->pais->actualizarPais($codigo, $nombre, $tipe);
                if ($res == 1) {
                    return redirect()->to(base_url('/paises'));
                }
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
    //ELIMINAR Y RESTAURAR EL PAIS
    function eliminarResLogic($id, $estado, $tipo)
    {
        //ELIMINAR
        if ($tipo == 1) {
            if ($id && $estado) {
                $res = $this->pais->eliminarResModelDpto($id, $estado);
                if ($res == 1) {
                    return redirect()->to(base_url('/paises'));
                }
            }
        }
        //RESTAURAR
        else {
            $res = $this->pais->eliminarResModelDpto($id, $estado);
            if ($res == 1) {
                return redirect()->to(base_url('/paises/eliminados'));
            }
        }
    }
    public function eliminados()
    {
        $pais = $this->pais->obtenerEliminados();
        $data = ['titulo' => 'Administrar Países Eliminados', 'nombre' => 'Moises Mazo', 'datos' => $pais];
        echo view('/principal/header', $data);
        echo view('/paises/paisesEliminados', $data);
    }
}
