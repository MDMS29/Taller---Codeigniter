<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;


class DepartamentosModel extends Model
{
    protected $table = 'departamentos'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['id_pais', 'nombre', 'estado', 'fechaCrea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fechaCrea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    //TOMAR TODOS LOS DEPARTAMENTOS
    public function obtenerDepartamentos()
    {
        $this->select('departamentos.*,paises.nombre as nombrePais');
        $this->join('paises', 'paises.id = departamentos.id_pais');
        $this->where('departamentos.estado', 'A');
        $this->orderBy('id');
        $datos = $this->findAll();
        return $datos;
    }
    //GUARDAR EL DEPARTAMENTO
    public function insertarDepartamento($pais, $nombre)
    {
        $this->save([
            'id_pais' => $pais,
            'nombre' => $nombre,
        ]);
        return 1;
    }
    //OBTENER LOS DEPARTAMENTOS DE UN PAIS SEGUN EL ID DEL PAIS
    public function obtenerDepartamentosPais($id)
    {
        $this->select('departamentos.*');
        $this->where('id_pais', $id);
        $datos = $this->findAll();
        return $datos;
    }

    //OBTENER EL DEPARTAMENTO SEGUN SU ID
    public function buscarDepartamento($id)
    {
        $this->select('departamentos.*');
        $this->where('id', $id);
        $this->where('estado', 'A');
        $datos = $this->findAll();
        return $datos;
    }
    //ACTUALIZAR EL DEPARTAMENTO SEGUN SU ID
    public function actualizarDepartamento($id, $pais, $nombre)
    {
        $this->update($id,[
            'id_pais' => $pais,
            'nombre' => $nombre
        ]);
        return 1;
    }
    public function eliminarResModelDpto($id, $estado)
    {
        $this->update($id, [
            'estado' => $estado
        ]);
        return 1;
    }
    public function obtenerEliminados()
    {
        $this->select('departamentos.*,paises.nombre as nombrePais');
        $this->join('paises', 'paises.id = departamentos.id_pais');
        $this->where('departamentos.estado', 'I');
        $this->orderBy('id');
        $datos = $this->findAll();
        return $datos;
    }
}
