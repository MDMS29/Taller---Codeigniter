<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class SalariosModel extends Model
{
    protected $table = 'salarios'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['sueldo', 'periodoAno', 'id_empleado', 'estado', 'fechaCrea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fechaCrea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    public function obtenerSalarios($idEmpleado, $estado)
    {
        $this->select('salarios.sueldo, salarios.periodoAno, empleados.nombres as nombreEmpleado, empleados.apellidos as apellidoEmpleado, empleados.id as idEmpleado, salarios.id as idSalario');
        $this->join('empleados', 'empleados.id = salarios.id_empleado');
        $this->where('empleados.id', $idEmpleado);
        if ($estado != 'A') {
            $this->where('salarios.estado', 'I');
        } else {
            $this->where('salarios.estado', 'A');
        }
        $this->orderBy('salarios.periodoAno', 'asc');
        $data = $this->findAll();
        return $data;
    }
    public function insertarSalario($tipo, $dataSalario)
    {
        if ($tipo == 1) {
            $this->save([
                'id_empleado' => $dataSalario['id'],
                'sueldo' => $dataSalario['salario'],
                'periodoAno' => $dataSalario['periodo']
            ]);
            return 1;
        } else {
            $this->update($dataSalario['idSalario'], [
                'id_empleado' => $dataSalario['idEmpleado'],
                'sueldo' => $dataSalario['salario'],
                'periodoAno' => $dataSalario['periodo']
            ]);
            return 1;
        }
    }
    public function actualizarSalario($dataSalario)
    {
        $this->where('id_empleado', $dataSalario['idEmpleado']);
        $this->update($dataSalario['idSalario'], [
            'estado' => $dataSalario['estado']
        ]);
        return 1;
    }
    public function buscarSalario($idEmpleado, $idSalario, $periodoAno, $sueldo)
    {
        $this->select('salarios.sueldo, salarios.periodoAno, empleados.nombres as nombreEmpleado, empleados.id as idEmpleado, salarios.id as idSalario');
        $this->join('empleados', 'empleados.id = salarios.id_empleado');
        $this->where('salarios.id_empleado', $idEmpleado);
        if ($idEmpleado != 0 && $periodoAno != '' && $sueldo != '') {
            $this->where('salarios.periodoAno', $periodoAno);
            $this->where('salarios.sueldo', $sueldo);
        } else if ($idSalario != 0) {
            $this->where('salarios.id', $idSalario);
        }
        $this->where('salarios.estado', 'A');
        $data = $this->first();
        return $data;
    }
}