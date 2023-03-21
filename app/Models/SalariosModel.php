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

    public function insertarSalario($dataSalario)
    {
        $this->save([
            'id_empleado' => $dataSalario['id'],
            'sueldo' => $dataSalario['salario'],
            'periodoAno' => $dataSalario['periodo']
        ]);
        return 1;
    }
    public function actualizarSalario($dataSalario)
    {
        $this->update($dataSalario['id'], [
            'sueldo' => $dataSalario['salario'],
            'periodo' => $dataSalario['periodo']
        ]);
        return 1;
    }
    public function eliminarResModelSala($dataSalario)
    {
        $this->update($dataSalario['id'], [
            'estado' => $dataSalario['estado']
        ]);
        return 1;
    }
}
