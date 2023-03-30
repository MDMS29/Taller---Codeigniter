<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class Usuarios extends BaseController
{
    protected $usuarios;
    public function __construct()
    {
        $this->usuarios = new UsuariosModel();
    }
    public function index()
    {
        $usuarios = $this->usuarios->obtenerUsuarios('A');

        $data = ['titulo' => 'Administrar Usuarios', 'nombre' => 'Moises Mazo', 'datos' => $usuarios];
        echo view('/principal/header', $data);
        echo view('/usuarios/usuarios');
    }
    function insertar()
    {
        $tp = $this->request->getPost('tp');
        $id = $this->request->getPost('id');
        $nombres = $this->request->getPost('nombres');
        $apellidos = $this->request->getPost('apellidos');
        $n_iden = $this->request->getPost('n_iden');
        $email = $this->request->getPost('email');
        $contra = $this->request->getPost('contra');

        if ($tp == 1) {
            $data = [
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'n_iden' => $n_iden,
                'email' => $email,
                'contra' => $contra,
            ];
            $res = $this->usuarios->insertar($data);
            if($res == 1){
                return redirect()->to(base_url('/usuarios'));
            }
        }
    }
}
