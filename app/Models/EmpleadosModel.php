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
    public function obtenerEmpleados($estado)
    {
        if ($estado != 'A') {
            $this->select('empleados.*,municipios.nombre as nombreMuni, cargos.nombre as nombreCargo, cargos.estado as estadoCargo, paises.nombre as nombrePais,paises.estado as estadoPais, departamentos.nombre as nombreDpto, departamentos.estado as estadoDpto, municipios.estado as estadoMuni');
            $this->join('municipios', 'municipios.id = empleados.id_municipio');
            $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
            $this->join('paises', 'paises.id = departamentos.id_pais');
            $this->join('cargos', 'cargos.id = empleados.id_cargo');
            // $this->join('salarios', 'salarios.id_empleado = empleados.id', 'left');
            $this->where('empleados.estado', 'I');
            $this->orderBy('id');
            $datos = $this->findAll();
            return $datos;
        } else {
            $this->select('empleados.*,municipios.nombre as nombreMuni, cargos.nombre as nombreCargo, cargos.estado as estadoCargo, paises.nombre as nombrePais, paises.estado as estadoPais, departamentos.nombre as nombreDpto, departamentos.estado as estadoDpto, municipios.estado as estadoMuni');
            $this->join('municipios', 'municipios.id = empleados.id_municipio');
            $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
            $this->join('paises', 'paises.id = departamentos.id_pais');
            $this->join('cargos', 'cargos.id = empleados.id_cargo');
            // $this->join('salarios', 'salarios.id_empleado = empleados.id', 'left');
            $this->where('empleados.estado', 'A');
            $this->orderBy('id');
            $datos = $this->findAll();
            return $datos;
        }
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
    public function buscarEmpleado($id, $nombres = '', $apellidos = '')
    {
        if ($nombres != '') {
            $this->select('empleados.*,empleados.nombres as nombresEmple,municipios.id as idMuni');
            $this->join('municipios', 'municipios.id = empleados.id_municipio');
            $this->join('cargos', 'cargos.id = empleados.id_cargo');
            $this->where('empleados.nombres', $nombres);
            $this->where('empleados.apellidos', $apellidos);
            $datos = $this->first();
            return $datos;
        } else {
            $this->select('empleados.*,empleados.id as idEmpleado ,empleados.nombres as nombresEmple, empleados.apellidos as apellidosEmple,municipios.id as idMuni, paises.id as idPais, departamentos.id as idDpto,cargos.id as idCargo, salarios.sueldo as salario, salarios.periodoAno as periodoAno');
            $this->join('municipios', 'municipios.id = empleados.id_municipio');
            $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
            $this->join('paises', 'paises.id = departamentos.id_pais');
            $this->join('cargos', 'cargos.id = empleados.id_cargo');
            $this->join('salarios', 'salarios.id_empleado = empleados.id', 'left');
            $this->where('empleados.id', $id);
            $datos = $this->findAll();
            return $datos;
        }
    }
    public function actualizarEmpleado($data)
    {
        $id = $data['id'];
        $nombres = $data['nombres'];
        $apellidos = $data['apellidos'];
        $id_municipio = $data['municipio'];
        $nacimientoAno = $data['anoNac'];
        $id_cargo = $data['cargo'];

        $this->update($id, [
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'id_municipio' => $id_municipio,
            'nacimientoAno' => $nacimientoAno,
            'id_cargo' => $id_cargo
        ]);
        return $id;
    }
    public function eliminarResModelEmple($id, $estado)
    {
        $this->update($id, [
            'estado' => $estado
        ]);
        return 1;
    }
}
