<div class="container card my-4">
    <div>
        <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
    </div>
    <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarEmpleado" onclick="seleccionarEmpleado(<?php echo 1  . ',' . 1 . ',' . 0 ?>)">Agregar</button>
        <a href="<?php echo base_url('/empleados/eliminados') ?>" class="btn btn-secondary">Eliminados</a>
        <a href="<?php echo base_url('/principal'); ?>" class="btn btn-primary regresar_Btn">Regresar</a>
    </div>

    <br>
    <div class="table-responsive " style="overflow:scroll-vertical;overflow-y: scroll !important; height: 600px;">
        <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#98040a;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>Id</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Municipio</th>
                    <th>Año Nacimiento</th>
                    <th>Cargo</th>
                    <th>Salario</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;">
                <?php $contador = 0; ?>
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
                            <?php echo $valor['nombreMuni']; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $valor['nacimientoAno']; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $valor['nombreCargo']; ?>
                        </td>
                        <td class="text-center">
                            $<?php echo $valor['salario']; ?>
                        </td>
                        <td style="height:0.2rem;width:1rem;">
                            <input onclick="seleccionarEmpleado(<?php echo $valor['id'] . ',' . 2 . ',' .  $valor['idSalario'] ?>)" href="#" data-toggle="modal" data-target="#modal-confirma" type="image" src="<?php echo base_url(); ?>assets/img/editar.png" width="20" height="20" title="Editar"></input>

                            <input href="#" data-href="<?php echo base_url('/empleados/eliminarResLogic') . '/' . $valor['id'] . '/' . 'I' . '/' . 1 . '/' .  $valor['idSalario'] ?>" data-bs-toggle="modal" data-bs-target="#eliminarEmple" type="image" src="<?php echo base_url(); ?>assets/img/delete.png" width="16" height="16" title="Eliminar Registro"></input>
                        </td>

                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<!-- MODAL AGREGAR EMPLEADO -->
<form method="POST" action="<?php echo base_url('empleados/insertar') ?>" id="formulario">
    <div class="modal fade" id="AgregarEmpleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <input name="id" id="id" hidden>
                <input name="tp" id="tp" hidden>
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
                                <option selected>-- Seleccionar Cargo --</option>
                                <?php foreach ($cargos as $x => $valor) { ?>
                                    <option value="<?php echo $valor['id']; ?>"><?php echo $valor['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nombres" class="col-form-label">Nombre:</label>
                            <input type="text" name="nombres" class="form-control" id="nombres">
                        </div>
                        <div class="mb-3">
                            <label for="apellidos" class="col-form-label">Apellidos:</label>
                            <input type="text" name="apellidos" class="form-control" id="apellidos">
                        </div>
                        <div class="mb-3">
                            <label for="municipio" class="col-form-label">Pais:</label>
                            <select class="form-select" name="pais" id="selectPais" aria-label="Departamentos">
                                <option selected value="">-- Seleccionar Pais --</option>
                                <?php foreach ($paises as $x => $valor) { ?>
                                    <option value="<?php echo $valor['id']; ?>"><?php echo $valor['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="municipio" class="col-form-label">Departamento:</label>
                            <div id="contenedor-dptos">
                                <!-- SELECTOR DINAMICO -->
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
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Salario:</label>
                            <div class="d-flex align-items-center">
                                <label for="salario" class="fw-semibold fs-5 me-2">$</label>
                                <input type="number" name="salario" class="form-control" id="salario">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="periodo" class="col-form-label">Periodo (Salario):</label>
                            <div class="flex ">
                                <select class="form-select" name="periodo" aria-label="periodo" id="periodo">
                                    <option selected>-- Seleccionar Año --</option>
                                    <?php $years = range(strftime("%Y", time()), 2000); ?>
                                    <?php foreach ($years as $year) : ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="btn-guardar">Guardar</button>
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
        if ([$('#selectPais').val()].includes('')) {
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

    function seleccionarEmpleado(id, tp, idSala) {
        if (tp == 2) {
            $('#tp').val(2)
            $('#id').val(id)

            $.ajax({
                url: "<?php echo base_url('empleados/buscarEmpleado') ?>" + '/' + id,
                type: 'POST',
                dataType: 'json',
                success: function(res) {
                    $('#tituloModal').text('Actualizar Empleado');
                    $('#btn-guardar').text('Actualizar');
                    $('#cargo').val(res[0]['idCargo']);
                    $('#nombres').val(res[0]['nombres']);
                    $('#apellidos').val(res[0]['apellidos']);
                    $('#anoNac').val(res[0]['nacimientoAno']);
                    $('#selectPais').val(res[0]['idPais']);
                    obtenerDepartamentos(res[0]['idPais'], res[0]['idDpto'], res[0]['idMuni'])
                    $('#salario').val(res[0]['salario']);
                    $('#idSalario').val(idSala);
                    $('#periodo').val(res[0]['periodoAno']);
                    $('#AgregarEmpleado').modal('show')
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

    function obtenerDepartamentos(pais, idDpto, muni) {
        if (pais == 0 && idDpto == 0) {
            //No mostrar nada si no se mandan los valores del pais y el departamento
            //Esto por si se inserta un nuevo registro.
            $('#contenedor-dptos').html('<p class="ms-3 text-danger">*Seleccione un País*</p>')
        } else {
            //Buscar los departamentos del país para mostrarlos en el Select.
            $.ajax({
                url: "<?php echo base_url('municipios/obtenerDepartamentosPais') ?>" + '/' + pais,
                type: 'POST',
                dataType: 'json',
                success: function(res) {
                    //Mostrar todos los departamentos en los items del select
                    var cadena
                    cadena = `<select class="form-select" name="departamento" id="departamento" aria-label="Departamentos"> 
                                    <option selected value="">-- Seleccionar Departamento --</option>`
                    for (let i = 0; i < res.length; i++) {
                        cadena += ` <option value='${res[i].id}'>${res[i].nombre}</option>`
                    }
                    cadena += `</select>`
                    $('#contenedor-dptos').html(cadena)

                    //Le damos el valor del departamento para que se muestre al editar el registro
                    $('#departamento').val(idDpto);
                    obtenerMunicipios(idDpto, muni)
                }
            })
        }
    }

    function obtenerMunicipios(idDpto, idMuni) {
        if (idMuni == '') {
            $('#contenedor-muni').html('<p class="ms-3 text-danger">*Seleccione un Departamento*</p>')
        } else {
            $('#departamento').on('change', () => {
                dpto = $('#departamento').val()
                obtenerMunicipios(dpto)
            })
            //Buscar los departamentos del país para mostrarlos en el Select.
            $.ajax({
                url: "<?php echo base_url('municipios/obtenerMunicipiosDpto') ?>" + '/' + idDpto,
                type: 'POST',
                dataType: 'json',
                success: function(res) {
                    var cadena
                    cadena = `<select class="form-select" name="municipio" id="municipio" aria-label="Departamentos"> 
                                    <option selected value="">-- Seleccionar Municipio --</option>`
                    for (let i = 0; i < res.length; i++) {
                        cadena += ` <option value='${res[i].id}'>${res[i].nombre}</option>`
                    }
                    cadena += `</select>`
                    $('#contenedor-muni').html(cadena)
                    $('#municipio').val(idMuni);
                }
            })
        }
    }
    $('#selectPais').on('change', () => {
        //Al cambio de un país se mostraran los departamentos del país seleccionado
        pais = $('#selectPais').val()
        obtenerDepartamentos(pais)
    })
    $('#eliminarEmple').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))
    })
</script>