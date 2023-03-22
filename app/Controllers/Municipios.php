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
        $municipios = $this->municipios->obtenerMunicipios('A');

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
    function obtenerMunicipiosDpto($id)
    {
        $dataArray = array();
        $municipios = $this->municipios->getMunicipiosDpto($id);
        if (!empty($municipios)) {
            array_push($dataArray, $municipios);
        }
        echo json_encode($municipios);
    }

    function obtenerMunicipio($id)
    {
        $departamentos = $this->municipios->buscarMunicipio($id, '', '');
        if (!empty($departamentos)) {
            echo json_encode($departamentos);
        }
    }

    function insertar()
    {
        $tp = $this->request->getPost('tp');
        $id = $this->request->getPost('id');
        $departamento = $this->request->getPost('departamento');
        $nombre = $this->request->getPost('nombre');

        if ($tp == 1) {
            //Validacion del que el registro no este duplicado
            $res = $this->municipios->buscarMunicipio(0, $nombre, $departamento);
            if ($res) {
                $data = 'error_insert_muni';
                return redirect()->to(base_url('principal/error' . '/' . $data));
            } else {
                //Registrar nuevo municipio
                $res = $this->municipios->insertarActuMunicipio(0, $departamento, $nombre);
                if ($res == 1) {
                    return redirect()->to(base_url('/municipios'));
                }
            }
        } else {
            $res = $this->municipios->buscarMunicipio(0, $nombre, $departamento);
            if ($res) {
                $data = 'error_insert_muni';
                return redirect()->to(base_url('principal/error' . '/' . $data));
            } else {
                //Actualizar el municipio
                $res = $this->municipios->insertarActuMunicipio($id, $departamento, $nombre);
                if ($res == 1) {
                    return redirect()->to(base_url('/municipios'));
                }
            }
        }
    }

    function eliminarResLogic($id, $estado, $tipe)
    {
        //Eliminar logicamente el registro cambiando su estado a 'I'
        if ($tipe == 1) {
            if ($id && $estado) {
                $res = $this->municipios->eliminarResLogic($id, $estado);
                echo "Hi";
                if ($res == 1) {
                    return redirect()->to(base_url('/municipios'));
                }
            }
        }
        //Restaurar logicamente el registro cambiando su estado a 'A'
        else {
            $res = $this->municipios->eliminarResLogic($id, $estado);
            if ($res == 1) {
                return redirect()->to(base_url('/municipios/eliminados'));
            }
        }
    }

    public function eliminados()
    {
        $municipios = $this->municipios->obtenerMunicipios('I');

        $data = ['titulo' => 'Administrar Municipios', 'nombre' => 'Moises Mazo', 'datos' => $municipios];
        echo view('/principal/header', $data);
        echo view('/municipios/municipiosEliminados', $data);
    }
}
