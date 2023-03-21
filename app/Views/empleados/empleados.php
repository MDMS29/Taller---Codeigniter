<div class="container card my-4">
    <div>
        <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
    </div>
    <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarEmpleado" onclick="seleccionarEmpleado(<?php echo 1  . ',' . 1 . ',' . 0 ?>)">Agregar</button>
        <button type="button" class="btn btn-secondary">Eliminados</button>
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
                <?php foreach ($datos as $x => $valor) { ?>
                    <tr>
                        <td class="text-center">
                            <?php echo $valor['id']; ?>
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
                            <input onclick="seleccionarEmpleado(<?php echo $valor['id'] . ',' . 2 . ',' .  $valor['idSalario'] ?>)" href="#" data-toggle="modal" data-target="#modal-confirma" type="image" src="<?php echo base_url(); ?>assets/img/editar.png" width="20" height="20" title="Editar Registro"></input>
                            <input href="#" data-toggle="modal" data-target="#modal-confirma" type="image" src="<?php echo base_url(); ?>assets/img/delete.png" width="20" height=20" title="Eliminar Registro"></input>
                        </td>

                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>
<!-- MODAL AGREGAR EMPLEADO -->
<form method="POST" action="<?php echo base_url('empleados/insertar') ?>">
    <div class="modal fade" id="AgregarEmpleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <input name="id" id="id" hidden>
                <input name="tp" id="tp" hidden>
                <input id="idSalario" name="idSalario">
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
                            <label for="anoNac" class="col-form-label">Año Nacimiento:</label>
                            <select class="form-select" name="anoNac" id="anoNac" aria-label="anoNac">
                                <option selected>-- Seleccionar Año --</option>
                                <?php $years = range(strftime("%Y", time()), 1940); ?>
                                <?php foreach ($years as $year) : ?>
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="municipio" class="col-form-label">Municipio:</label>
                            <select class="form-select" name="municipio" id="municipio" aria-label="Departamentos">
                                <option selected>-- Seleccionar Municipio --</option>
                                <?php foreach ($municipios as $x => $valor) { ?>
                                    <option value="<?php echo $valor['id']; ?>"><?php echo $valor['nombre']; ?></option>
                                <?php } ?>
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

<script>
    function seleccionarEmpleado(id, tp, idSala) {
        if (tp == 2) {
            $('#tp').val(2)
            $('#id').val(id)
            // alert(idSala)

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
                    $('#municipio').val(res[0]['idMuni']);
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
            $('#municipio').val('');
            $('#salario').val('');
            $('#periodo').val('');
            $('#tp').val(1)
        }
    }
</script>