<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class PaisesModel extends Model
{
    protected $table = 'paises'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['nombre', 'estado', 'codigo', 'fechaCrea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fechaCrea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerPaises()
    {
        $this->select('paises.*');
        $this->where('estado', 'A');
        $datos = $this->findAll();
        return $datos;
    }
    public function insertarPais($codigo, $nombre)
    {
        $this->save([
            'codigo' => $codigo,
            'nombre' => $nombre
        ]);
        return 'y';
    }
    public function buscarPais($id)
    {
        $this->select('paises.*');
        $this->where('id', $id);
        $this->where('estado', 'A');
        $datos = $this->findAll();
        return $datos;
    }
    public function actualizarPais($codigo, $nombre, $id)
    {
        $this->update($id, [
            'codigo' => $codigo,
            'nombre' => $nombre
        ]);
        return 'y';
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
        $this->select('paises.*');
        $this->where('estado', 'I');
        $datos = $this->findAll();
        return $datos;
    }
}
