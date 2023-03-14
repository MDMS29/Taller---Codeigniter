<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class EmpleadosModel extends Model
{
    protected $table = 'empleados'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['nombres', 'apellidos', 'id_municipio', 'nacimientoAno', 'id_cargo', 'estado', 'fechaCrea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fechaCrea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerEmpleados()
    {
        $this->select('empleados.*,municipios.nombre as nombreMuni, cargos.nombre as nombreCargo, salarios.sueldo as salario');
        $this->join('municipios', 'municipios.id = empleados.id_municipio');
        $this->join('cargos', 'cargos.id = empleados.id_cargo');
        $this->join('salarios', 'salarios.id_empleado = empleados.id', 'left');
        $this->where('empleados.estado', 'A');
        $this->orderBy('id');
        $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }

    public function insertarEmpleado($data)
    {
        $nombres = $data['nombres'];
        $apellidos = $data['apellidos'];
        $id_municipio = $data['municipio'];
        $nacimientoAno = $data['anoNac'];
        $id_cargo = $data['cargo'];

        $this->save([   
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'id_municipio' => $id_municipio,
            'nacimientoAno' => $nacimientoAno,
            'id_cargo' => $id_cargo
        ]);
        return 1;
    }
}
