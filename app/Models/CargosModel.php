<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class CargosModel extends Model
{
    protected $table = 'cargos'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['nombre', 'estado', 'fechaCrea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fechaCrea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerCargos($estado)
    {
        if ($estado == 'I') {
            $this->select('cargos.*');
            $this->where('estado', 'I');
            $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
            return $datos;
        } elseif($estado == ''){
            $this->select('cargos.*, estado');
            $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
            return $datos;
        }else if($estado == 'A') {
            $this->select('cargos.*');
            $this->where('estado', 'A');
            $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
            return $datos;
        }
    }
    public function insertarCargo($nombre)
    {
        $this->save([
            'nombre' => $nombre
        ]);
        return 1;
    }
    public function buscarCargo($id, $nombre)
    {
        if ($nombre != '') {
            $this->select('cargos.*');
            $this->where('nombre', $nombre);
            $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
            return $datos;
        }else{
            $this->select('cargos.*');
            $this->where('id', $id);
            $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
            return $datos;
        }
    }
    public function actualizarCargo($id, $nombre)
    {
        $this->update($id, [
            'nombre' => $nombre
        ]);
        return 1;
    }
    function eliminarResModelLogic($id, $estado)
    {
        $this->update($id, [
            'estado' => $estado
        ]);
        return 1;
    }
}
