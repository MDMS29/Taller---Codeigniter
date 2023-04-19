<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class HistorialModel extends Model
{
    protected $table = 'historial'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['tipo', 'tabla', 'accion', 'fechaCrea', 'usuarioCrea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fechaCrea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerHistorial()
    {
        $this->select('historial.*');
        $this->orderBy('id', 'desc');
        $datos = $this->findAll();
        return $datos;
    }
    public function detalleHistorial($id)
    {
        $this->select('historial.*');
        $this->where('id', $id);
        $datos = $this->first();
        return $datos;
    }
}
