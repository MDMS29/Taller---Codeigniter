<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class Usuarios extends BaseController
{
    protected $usuarios;
    public function __construct()
    {
        helper(array('date', 'sistema', 'url'));
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
        $rol = $this->request->getPost('rol');
        $email = $this->request->getPost('email');
        $contra = $this->request->getVar('contra');
        if ($tp == 1) {
            $res = $this->usuarios->buscarUsuario(0, $n_iden);
            if ($res) {
                $data = 'error_insert_user';
                return redirect()->to(base_url('principal/error' . '/' . $data));
            } else {
                $codigo = generarCodigo(70);

                $data = [
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'n_iden' => $n_iden,
                    'contrasena' => password_hash($contra, PASSWORD_DEFAULT),
                    'id_rol' => $rol,
                    'email' => $email,
                    'codeCrea' => $codigo
                ];
                $res = $this->usuarios->insertar(0, $data);

                if ($res == 1) {
                    //     $estadoCorreo = enviarCodeActi($email, $codigo);
                    //     if ($estadoCorreo['respuesta'] == 'si') {
                    return redirect()->to(base_url('/usuarios'));
                    //     }
                }
            }
        } else {
            $res = $this->usuarios->buscarUsuario($id, 0);
            if ($res['contrasena'] != $contra) {
                $contra = password_hash($contra, PASSWORD_DEFAULT);
            }
            $data = [
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'n_iden' => $n_iden,
                'contrasena' => $contra,
                'email' => $email,
                'id_rol' => $rol,
            ];
            $res = $this->usuarios->insertar($id, $data);
            if ($res == 1) {
                return redirect()->to(base_url('/usuarios'));
            }
        }
    }
    function buscarUsuario($id)
    {
        $returnData = array();
        $data = $this->usuarios->buscarUsuario($id, 0);
        if (!empty($data)) {
            array_push($returnData, $data);
            echo json_encode($returnData);
        }
    }
    function eliminarResLogic($id, $estado, $tipo)
    {
        if ($tipo == 1) {
            $res = $this->usuarios->eliminarResLogicModel($id, $estado);
            if ($res == 1) {
                return redirect()->to(base_url('/usuarios'));
            }
        } else {
            $this->usuarios->eliminarResLogicModel($id, $estado);
            return redirect()->to(base_url('/usuarios/eliminados'));
        }
    }

    public function eliminados()
    {
        $usuarios = $this->usuarios->obtenerUsuarios('I');

        $data = ['titulo' => 'Administrar Usuarios Eliminados', 'nombre' => 'Moises Mazo', 'datos' => $usuarios];
        echo view('/principal/header', $data);
        echo view('/usuarios/usuariosEliminados');
    }

    function login()
    {
        $usuario = $this->request->getPost('user');
        $contrasena = $contrasena = trim($this->request->getVar('pass', FILTER_SANITIZE_STRING));
        $res = $this->usuarios->buscarUsuario(0, 0, $usuario);

        if (count($res) > 0 && password_verify($contrasena, $res['contrasena'])) {

            $dataUser = [
                "nombres" => $res['nombres'],
                "apellidos" => $res['apellidos'],
                "rol" => $res['nombreRol'],
            ];

            $sesion = session();
            $sesion->set($dataUser);

            return redirect()->to(base_url('principal/home'));
        } else {
            return redirect()->to(base_url('principal'));
        }
    }

    function cerrarSesion()
    {
        $sesion = session();
        $sesion->destroy();
        return redirect()->to(base_url('principal'));
    }
}
