<div class="container card my-4">
    <div>
        <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
    </div>
    <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarEmpleado" onclick="seleccionarEmpleado(<?php echo 1  . ',' . 1 . ',' . 0 ?>)"><i class="bi bi-clipboard-plus"></i> Agregar</button>
        <a href="<?php echo base_url('/empleados/eliminados') ?>" class="btn btn-secondary"><i class="bi bi-folder-x"></i> Eliminados</a>
        <a href="<?php echo base_url('/home'); ?>" class="btn btn-primary regresar_Btn"><i class="bi bi-arrow-counterclockwise"></i> Regresar</a>
    </div>

    <br>
    <div class="table-responsive " style="overflow:scroll-vertical;overflow-y: scroll !important; overflow:scroll-horizontal;overflow-x: scroll !important;height: 600px;">
        <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#008040;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>#</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Pais</th>
                    <th>Departamento</th>
                    <th>Municipio</th>
                    <th>Año Nacimiento</th>
                    <th>Cargo</th>
                    <th>Salario</th>
                    <?php if ($dataUser['rol'] == 'Super Administrador') { ?>

                        <th colspan="2">Acciones</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;">
                <?php $contador = 0; ?>
                <?php if (empty($datos)) { ?>
                    <tr>
                        <td colspan="11" class="text-center h4"><?php echo '¡No Hay Empleados!' ?></td>
                    </tr>
                <?php } else { ?>
                    <?php foreach ($datos as $x => $valor) { ?>
                        <tr>
                            <td class="text-center">
                                <?php echo $contador += 1; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $valor['nombres']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $valor['apellidos']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $valor['estadoPais'] == 'A' ? $valor['nombrePais'] : $valor['nombrePais'] . ' - <span class="text-danger fw-bold">Inactivo</span>'; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $valor['estadoDpto'] == 'A' ? $valor['nombreDpto'] : $valor['nombreDpto'] . ' - <span class="text-danger fw-bold">Inactivo</span>'; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $valor['estadoMuni'] == 'A' ? $valor['nombreMuni'] : $valor['nombreMuni'] . ' - <span class="text-danger fw-bold">Inactivo</span>'; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $valor['nacimientoAno']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $valor['estadoCargo'] == 'A' ? $valor['nombreCargo'] : $valor['nombreCargo'] . ' - <span class="text-danger fw-bold">Inactivo</span>'; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?php echo base_url('/ver-salarios/' . $valor['id']) ?>" class="btn btn-primary"><i class="bi bi-cash-coin"></i> Salarios</a>
                            </td>
                            <?php if ($dataUser['rol'] == 'Super Administrador') { ?>

                                <td class="text-center">
                                    <input onclick="seleccionarEmpleado(<?php echo $valor['id'] . ',' . 2  ?>)" href="#" data-bs-toggle="modal" data-bs-target="#AgregarEmpleado" type="image" src="<?php echo base_url(); ?>assets/img/editar.png" width="20" height="20" title="Editar"></input>

                                    <input href="#" data-href="<?php echo base_url('dltEpl') . '/' . $valor['id'] . '/' . 'I' . '/' . 1  ?>" data-bs-toggle="modal" data-bs-target="#eliminarEmple" type="image" src="<?php echo base_url(); ?>assets/img/delete.png" width="20" height="20" title="Eliminar Registro"></input>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- MODAL AGREGAR EMPLEADO -->
<form method="POST" action="<?php echo base_url('instrEpl') ?>" id="formulario">
    <div class="modal fade" id="AgregarEmpleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <input name="id" id="id" hidden>
                <input name="tp" id="tp" hidden>
                <input type="text" name="idCrea" id="idCrea" value="<?php echo $dataUser['id'] ?>" hidden>

                <input id="idSalario" name="idSalario" hidden>
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tituloModal">Agregar Nuevo Empleado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="cargo" class="col-form-label">Cargo:</label>
                            <select class="form-select" name="cargo" aria-label="cargo" id="cargo">
                                <option selected value="">-- Seleccionar Cargo --</option>
                                <?php foreach ($cargos as $x => $valor) { ?>
                                    <option value="<?php echo $valor['id']; ?>" <?php echo $valor['estado'] != 'A' ? 'disabled' : '' ?>> <?php echo $valor['estado'] == 'A' ? $valor['nombre'] : $valor['nombre'] . ' - <span class="text-danger fw-bold">Inactivo</span>'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="d-flex column-gap-3" style="width: 100%">
                            <div class="mb-3" style="width: 100%">
                                <label for="nombres" class="col-form-label">Nombres:</label>
                                <input type="text" name="nombres" class="form-control" id="nombres">
                            </div>
                            <div class="mb-3" style="width: 100%">
                                <label for="apellidos" class="col-form-label">Apellidos:</label>
                                <input type="text" name="apellidos" class="form-control" id="apellidos">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="municipio" class="col-form-label">Pais:</label>
                            <select class="form-select" name="pais" id="selectPais" aria-label="Paises">
                                <option selected value="">-- Seleccionar País --</option>
                                <?php foreach ($paises as $x => $valor) { ?>
                                    <option value="<?php echo $valor['id']; ?>" <?php echo $valor['estado'] != 'A' ? 'disabled' : '' ?>><?php echo $valor['estado'] == 'A' ? $valor['nombre'] : $valor['nombre'] . ' - <span class="text-danger fw-bold">Inactivo</span>'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="municipio" class="col-form-label">Departamento:</label>
                            <div id="contenedor-dptos">
                                <select class="form-select" name="departamento" id="departamento" aria-label="Departamentos">
                                    <option value="">-- Seleccionar Departamento --</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="municipio" class="col-form-label">Municipio:</label>
                            <div id="contenedor-muni">
                                <!-- SELECTOR DINAMICO -->
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="anoNac" class="col-form-label">Año Nacimiento:</label>
                            <select class="form-select" name="anoNac" id="anoNac" aria-label="anoNac">
                                <option selected value="">-- Seleccionar Año --</option>
                                <?php $years = range(strftime("%Y", time()), 1940); ?>
                                <?php foreach ($years as $year) : ?>
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btn-guardar">Guardar</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- MODAL ELIMINAR EMPLEADO -->
<div class="modal fade" id="eliminarEmple" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div style="text-align:center;" class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminación de Registro</h5>
            </div>
            <div class="modal-body">
                <p>Seguro Desea Eliminar éste Registro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary close" data-bs-dismiss="modal">No</button>
                <a class="btn btn-danger btn-ok">Si</a>
            </div>
        </div>
    </div>
</div>


<script>
    $('#formulario').on('submit', function(e) {
        //Verificacion de campos vacios en el formulario
        cargo = $('#cargo').val()
        nombre = $('#nombres').val()
        apellidos = $('#apellidos').val()
        selectPais = $('#selectPais').val()
        departamento = $('#departamento').val()
        municipio = $('#municipio').val()
        anoNac = $('#anoNac').val()
        salario = $('#salario').val()
        periodo = $('#periodo').val()
        if ([cargo, nombre, apellidos, selectPais, departamento, municipio, anoNac, salario, periodo].includes('')) {
            e.preventDefault()
            return Swal.fire({
                position: 'center',
                icon: 'error',
                title: '¡Debe llenar todos los campos!',
                showConfirmButton: false,
                timer: 1500
            })
        }
    })

    function seleccionarEmpleado(id, tp) {
        if (tp == 2) {
            $('#tp').val(2)
            $('#id').val(id)
            $.ajax({
                url: "<?php echo base_url('srchEpl') ?>" + '/' + id,
                type: 'POST',
                dataType: 'json',
                success: function(res) {
                    $('#tituloModal').text('Actualizar Empleado');
                    $('#btn-guardar').text('Actualizar');
                    res[0]['estadoCargo'] == 'I' ? $('#cargo').val('') : $('#cargo').val(res[0]['idCargo']);
                    $('#nombres').val(res[0]['nombres']);
                    $('#apellidos').val(res[0]['apellidos']);
                    $('#anoNac').val(res[0]['nacimientoAno']);
                    res[0]['estadoPais'] == 'I' ? $('#selectPais').val('') : $('#selectPais').val(res[0]['idPais']);
                    obtenerDepartamentos(res[0]['idPais'], res[0]['idDpto'], res[0]['estadoDpto'], res[0]['idMuni'], res[0]['estadoMuni'])
                }
            })
        } else {
            $('#tituloModal').text('Agregar Nuevo Empleado');
            $('#btn-guardar').text('Guardar');
            $('#cargo').val('');
            $('#nombres').val('');
            $('#apellidos').val('');
            $('#anoNac').val('');
            obtenerDepartamentos(0, 0)
            obtenerMunicipios(0, 0)
            $('#selectPais').val('');
            $('#departamento').val('');
            $('#municipio').val('');
            $('#salario').val('');
            $('#periodo').val('');
            $('#tp').val(1)
        }
    }

    $('#selectPais').on('change', () => {
        //Al cambio de un país se mostraran los departamentos del país seleccionado
        pais = $('#selectPais').val()
        obtenerDepartamentos(pais)
    })

    function obtenerDepartamentos(pais, idDpto, estadoDpto, muni, estadoMuni) {
        //Buscar los departamentos del país para mostrarlos en el Select.
        $.ajax({
            url: "<?php echo base_url('srchDptMncp') ?>" + '/' + pais,
            type: 'POST',
            dataType: 'json',
            success: function(res) {
                //Mostrar todos los departamentos en los items del select
                cadena = `<option value="">-- Seleccionar Departamento --</option>`
                for (let i = 0; i < res.length; i++) {
                    cadena += ` <option value='${res[i].id}' ${res[i].estadoDpto == 'I' ? 'disabled' : ''}>${res[i].estadoDpto == 'I' ? `${res[i].nombre} - Inactivo` : `${res[i].nombre}`}</option>`
                }
                cadena += `</select>`
                $('#departamento').html(cadena)
                estadoDpto == 'I' ? $('#departamento').val('') : $('#departamento').val(idDpto);
                //Le damos el valor del departamento para que se muestre al editar el registro

                obtenerMunicipios(idDpto, muni, estadoMuni)
            }
        })


    }

    function obtenerMunicipios(idDpto, idMuni, estadoMuni) {
        $('#departamento').on('change', () => {
            dpto = $('#departamento').val()
            obtenerMunicipios(dpto)
        })
        //Buscar los municipios del país para mostrarlos en el Select.
        $.ajax({
            url: "<?php echo base_url('srchMncpDpto') ?>" + '/' + idDpto,
            type: 'POST',
            dataType: 'json',
            success: function(res) {
                var cadena
                cadena = `<select class="form-select" name="municipio" id="municipio" aria-label="Municipios"> 
                                <option selected value="">-- Seleccionar Municipio --</option>`
                for (let i = 0; i < res.length; i++) {
                    cadena += ` <option value='${res[i].id}' ${res[i].estado == 'I' ? 'disabled' : ''}>${res[i].estado == 'I' ? `${res[i].nombre} - Inactivo` : `${res[i].nombre}`}</option>`
                }
                cadena += `</select>`
                $('#contenedor-muni').html(cadena)
                estadoMuni == 'I' ? $('#municipio').val('') : $('#municipio').val(idMuni)
                //Le damos el valor del municipio para que se muestre al editar el registro

            }
        })
    }
    $('#eliminarEmple').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))
    })
</script>