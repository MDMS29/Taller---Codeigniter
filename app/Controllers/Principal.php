<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Principal extends BaseController
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = ['titulo' => 'Proyecto Taller', 'nombre' => 'Moises Mazo'];
        echo view('/principal/header', $data);
        echo view('/principal/principal');
    }
    public function error($dao)
    {
        switch ($dao) {
            case 'error_insert_code':
                $dao = '¡Error al insertar un codigo o nombre de un Pais ya registrado!';
                $urlBack = 'paises';
                break;
            case 'error_insert_name':
                $dao = '¡Error al insertar un Departamento con un nombre ya registrado!';
                $urlBack = 'departamentos';
                break;
            case 'error_insert_muni':
                $dao = '¡Error al insertar un Municipio con un nombre ya registrado!';
                $urlBack = 'municipios';
                break;
            case 'error_insert_emple':
                $dao = '¡Error al insertar un Empleado con un cargo ya registrado!';
                $urlBack = 'empleados';
                break;
            case 'error_name_cargo':
                $dao = '¡Error al insertar un Cargo con un nombre ya registrado!';
                $urlBack = 'cargos';
                break;
            case 'error_insert_salario':
                $dao = '¡Error al insertar un Salario ya registrado!';
                $urlBack = 'empleados';
                break;
        }

        $data = ['titulo' => '¡Error!', 'nombre' => 'Moises Mazo'];
        echo view('/principal/header', $data);

        $dataError = ['msgError' => $dao, 'url' => $urlBack];
        echo view('/errors/error', $dataError);
    }
}
