<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaisesModel;

class Paises extends BaseController
{
    protected $pais;
    public function __construct()
    {
        helper('sistema');
        $this->pais = new PaisesModel();
    }

    public function index()
    {
        $dataLogin = datosLogin();
        $pais = $this->pais->obtenerPaises('A');

        $data = ['titulo' => 'Administrar Países', 'dataUser' => $dataLogin, 'datos' => $pais];
        echo view('/principal/header', $data);
        echo view('/paises/paises', $data);
    }
    function insertar()
    {
        $tipe = $this->request->getPost('tipe');
        $id = $this->request->getPost('id');
        $codigo = $this->request->getPost('codigo');
        $nombre = $this->request->getPost('nombre');
        $idCrea = $this->request->getPost('idCrea');
        
        if ($tipe == 1) {
            $res = $this->pais->buscarPais(0, $codigo, $nombre);
            if ($res) {
                $data = 'error_insert_code';
                return redirect()->to(base_url('principal/error' . '/' . $data));
            } else {
                $res = $this->pais->insertarPais($codigo, $nombre, $idCrea);
                if ($res == 1) {
                    return redirect()->to(base_url('/paises'));
                }
            }
        } else {
            $res = $this->pais->buscarPais(0, $codigo, $nombre);
            if ($res) {
                $data = 'error_insert_code';
                return redirect()->to(base_url('principal/error' . '/' . $data));
            } else {
                $res = $this->pais->actualizarPais($codigo, $nombre, $id);
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
        echo json_encode($dataArray);
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
        $dataLogin = datosLogin();
        $pais = $this->pais->obtenerEliminados();
        $data = ['titulo' => 'Administrar Países Eliminados', 'dataUser' => $dataLogin, 'datos' => $pais];
        echo view('/principal/header', $data);
        echo view('/paises/paisesEliminados', $data);
    }

    public function filtroNombre($nombre, $tipo)
    {
        if ($nombre == 'seeAll') {
            if($tipo == 'I'){
                $data = $this->pais->obtenerPaises('I');
                echo json_encode($data);
            }else if($tipo == 'A'){
                $data = $this->pais->obtenerPaises('A');
                echo json_encode($data);
            }
        } else if($nombre != 'seeAll') {
            if($tipo == 'I'){
                $data = $this->pais->select('paises.*')->like('nombre', $nombre, 'after')->where('estado', 'I')->findAll();
                echo json_encode($data);
            }else if($tipo == 'A'){
                // Produces: WHERE `title` LIKE 'match%' ESCAPE '!'
                $data = $this->pais->select('paises.*')->like('nombre', $nombre, 'after')->where('estado', 'A')->findAll();
                echo json_encode($data);
            }
        }
    }
}
