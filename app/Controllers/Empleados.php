<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpleadosModel;
use App\Models\CargosModel;
use App\Models\MunicipiosModel;

class Empleados extends BaseController
{
    protected $empleados;
    protected $cargos;
    protected $municipios;

    public function __construct()
    {
        $this->empleados = new EmpleadosModel();
        $this->cargos = new CargosModel();
        $this->municipios = new MunicipiosModel();
    }
    public function index()
    {
        $empleados = $this->empleados->obtenerEmpleados();
        $cargos = $this->cargos->obtenerCargos();
        $municipios = $this->municipios->obtenerMunicipios();

        $data = [
            'titulo' => 'Administrar Empleados', 'nombre' => 'Moises Mazo', 'datos' => $empleados,
            'cargos' => $cargos, 'municipios' => $municipios
        ];
        echo view('/principal/header', $data);
        echo view('/empleados/empleados', $data);
    }
    function insertar()
    {
        if ($this->request->getMethod() == "post") {
            $cargo = $this->request->getPost('cargo');
            $nombres = $this->request->getPost('nombres');
            $apellidos = $this->request->getPost('apellidos');
            $anoNac = $this->request->getPost('anoNac');
            $municipio = $this->request->getPost('municipio');
            $data = [
                'cargo' => $cargo,
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'anoNac' => $anoNac,
                'municipio' => $municipio
            ];
            $res = $this->empleados->insertarEmpleado($data);
            if ($res == 1) {
                return redirect()->to(base_url('/empleados'));
            }
        }
    }
}
