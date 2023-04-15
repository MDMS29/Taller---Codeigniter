<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuarios'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['nombres', 'apellidos', 'n_iden', 'contrasena', 'email', 'id_rol', 'estado', 'fechaCrea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fechaCrea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerUsuarios($estado)
    {
        if ($estado == 'A') {
            $this->select('usuarios.*');
            $this->where('estado', $estado);
            $datos = $this->findAll();
            return $datos;
        } else {
            $this->select('usuarios.*');
            $this->where('estado', $estado);
            $datos = $this->findAll();
            return $datos;
        }
    }
    public function insertar($id, $data)
    {
        if ($id == 0) {
            $this->save($data);
            return 1;
        } else {
            $this->update($id, $data);
            return 1;
        }
    }
    public function buscarUsuario($id, $n_iden, $email = '')
    {
        if ($id != 0) {
            $this->select('usuarios.*');
            $this->where('id', $id);
        } else if ($n_iden != 0) {
            $this->select('usuarios.*');
            $this->where('n_iden', $n_iden);
        } else if ($email != '') {
            $this->select('usuarios.*, roles.nombre as nombreRol');
            $this->join('roles', 'roles.id = usuarios.id_rol');
            $this->where('email', $email);
        }
        $data = $this->first();
        return $data;
    }
    public function eliminarResLogicModel($id, $estado)
    {
        $this->update($id, ['estado' => $estado]);
        return 1;
    }
}
