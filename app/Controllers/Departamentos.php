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
        helper('sistema');
        $this->departamentos = new DepartamentosModel();
        $this->paises = new PaisesModel();
    }
    public function index()
    {
        $dataLogin = datosLogin();
        $departamentos = $this->departamentos->obtenerDepartamentos('A');
        $paises = $this->paises->obtenerPaises('');

        $data = ['titulo' => 'Administrar Departamentos', 'dataUser' => $dataLogin, 'datos' => $departamentos, 'paises' => $paises];
        echo view('/principal/header', $data);
        echo view('/departamentos/departamentos', $data);
    }
    function insertar()
    {
        $tipe = $this->request->getPost('tipe');
        $id = $this->request->getPost('id');
        $pais = $this->request->getPost('pais');
        $nombre = $this->request->getPost('nombre');
        $idCrea = $this->request->getPost('idCrea');

        if ($tipe == 1) {
            $res = $this->departamentos->buscarDepartamento($id = 0, $nombre, $pais);
            if ($res) {
                $data = 'error_insert_name';
                return redirect()->to(base_url('principal/error' . '/' . $data));
            } else {
                $res = $this->departamentos->insertarDepartamento($pais, $nombre, $idCrea);
                if ($res == 1) {
                    return redirect()->to(base_url('/departamentos'));
                }
            }
        } else {
            $res = $this->departamentos->buscarDepartamento($id = 0, $nombre, $pais);
            if ($res) {
                $data = 'error_insert_name';
                return redirect()->to(base_url('principal/error' . '/' . $data));
            } else {
                $res = $this->departamentos->actualizarDepartamento($id, $pais, $nombre);
                if ($res == 1) {
                    return redirect()->to(base_url('/departamentos'));
                }
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
        echo json_encode($dataArray);
    }
    //ELIMINAR Y RESTAURAR EL PAIS
    function eliminarResLogic($id, $estado, $tipo)
    {
        //ELIMINAR
        if ($tipo == 1) {
            if ($id && $estado) {
                $res = $this->departamentos->eliminarResModelDpto($id, $estado);
                echo "Hi";
                if ($res == 1) {
                    return redirect()->to(base_url('/departamentos'));
                }
            }
        }
        //RESTAURAR
        else {
            $res = $this->departamentos->eliminarResModelDpto($id, $estado);
            if ($res == 1) {
                return redirect()->to(base_url('/departamentos/eliminados'));
            }
        }
    }

    public function eliminados()
    {
        $dataLogin = datosLogin();
        $departamentos = $this->departamentos->obtenerDepartamentos('I');
        $data = ['titulo' => 'Administrar Departamentos Eliminados', 'dataUser' => $dataLogin, 'datos' => $departamentos];
        echo view('/principal/header', $data);
        echo view('/departamentos/departamentosEliminados', $data);
    }
}
