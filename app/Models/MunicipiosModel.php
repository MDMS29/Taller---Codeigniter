<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class MunicipiosModel extends Model
{
    protected $table = 'municipios'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['nombre', 'id_dpto', 'estado', 'fechaCrea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = ''; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerMunicipios($id = 0)
    {
        if ($id != 0) {
            $this->select('municipios.id, municipios.nombre as nombreMuni, d.id as idDpto, p.id as idPais');
            $this->join('departamentos as d', 'd.id=municipios.id_dpto');
            $this->join('paises as p', 'p.id=d.id_pais');
            $this->where('municipios.id', $id);
            $datos = $this->findAll();
            return $datos;
        } else {
            $this->select('municipios.*,departamentos.nombre as nombreDeparta, paises.nombre as nombrePais');
            $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
            $this->join('paises', 'paises.id = departamentos.id_pais');
            $this->where('paises.estado', 'A');
            $this->where('departamentos.estado', 'A');
            $this->where('municipios.estado', 'A');
            $datos = $this->findAll();
            return $datos;
        }
    }
    public function insertarActuMunicipio($id = 0, $departamento, $nombre)
    {
        if ($id != 0) {
            $this->update($id, [
                'id_dpto' => $departamento,
                'nombre' => $nombre
            ]);
            return 1;
        } else {
            $this->save([
                'id_dpto' => $departamento,
                'nombre' => $nombre
            ]);
            return 1;
        }
    }

    public function buscarMunicipio($nombre, $idDpto)
    {
        $this->select('municipios.*');
        $this->join('departamentos as d', 'd.id=municipios.id_dpto');
        $this->where('municipios.nombre', $nombre);
        $this->where('d.id', $idDpto);
        $datos = $this->findAll();
        return $datos;
    }
}
