<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Principal extends BaseController
{
    public function __construct()
    {
        helper('sistema');
    }
    public function index()
    {
        $data = ['titulo' => 'Login', 'nombre' => 'Moises Mazo'];
        echo view('login', $data);
    }
    public function home()
    {
        $dataLogin = datosLogin();//FUNCION LLAMADA DESDE LOS HELPERS
        $data = ['titulo' => 'Proyecto Taller', 'dataUser' => $dataLogin];
        echo view('/principal/header', $data);
        echo view('/principal/principal');
    }
    public function error($dao)
    {
        switch ($dao) {
            case 'error_insert_code':
                $dao = '¡Error al insertar un codigo o nombre de un País ya registrado!';
                break;
            case 'error_insert_name':
                $dao = '¡Error al insertar un Departamento con un nombre ya registrado!';
                break;
            case 'error_insert_muni':
                $dao = '¡Error al insertar un Municipio con un nombre ya registrado!';
                break;
            case 'error_insert_emple':
                $dao = '¡Error al insertar un Empleado con un cargo ya registrado!';
                break;
            case 'error_name_cargo':
                $dao = '¡Error al insertar un Cargo con un nombre ya registrado!';
                break;
            case 'error_insert_salario':
                $dao = '¡Error al insertar un Salario ya registrado!';
                break;
            case 'error_insert_user':
                $dao = '¡Error al insertar un Usuario con el # Identificación ya registrado!';
                break;
        }

        $dataLogin = datosLogin();//FUNCION LLAMADA DESDE LOS HELPERS
        $data = ['titulo' => '¡Error!', 'dataUser' => $dataLogin];
        echo view('/principal/header', $data);

        $dataError = ['msgError' => $dao];
        echo view('/errors/error', $dataError);
    }
}
