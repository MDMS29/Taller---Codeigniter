<div class="container card my-4">
    <div class="my-3">
        <h1 class="text-center"><?php echo $titulo ?></h1>
    </div>
    <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarSalario" onclick="seleccionarSalario(<?php echo 0  . ',' . $salarios[0]['idEmpleado'] . ',' . 1 ?>)">Agregar</button>
        <a href="<?php echo base_url('/salarios-eliminados/') . $salarios[0]['idEmpleado'] ?>" class="btn btn-secondary">Eliminados</a>
        <a href="<?php echo base_url('/empleados'); ?>" class="btn btn-primary regresar_Btn">Regresar</a>
    </div>

    <br>
    <div class="table-responsive " style="overflow:scroll-vertical;overflow-y: scroll !important; overflow:scroll-horizontal;overflow-x: scroll !important;height: 600px;">
        <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#008040;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>#</th>
                    <th>Periodo (Año)</th>
                    <th>Salario</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;">
                <?php $contador = 0; ?>
                <?php foreach ($salarios as $valor) { ?>
                    <tr>
                        <td class="text-center"><?php echo $contador += 1; ?></td>
                        <td class="text-center"><?php echo $valor['periodoAno']; ?></td>
                        <td class="text-center"><?php echo $valor['sueldo']; ?></td>
                        <td colspan="2" class="text-center">
                            <input onclick="seleccionarSalario(<?php echo $valor['idSalario'] . ',' . $valor['idEmpleado'] . ',' .  2 ?>)" href="#" data-bs-toggle="modal" data-bs-target="#agregarSalario" type="image" src="<?php echo base_url(); ?>assets/img/editar.png" width="20" height="20" title="Editar"></input>
                            <input href="#" data-href="<?php echo base_url('/salarios/eliminarResLogic') . '/' . $valor['idEmpleado'] . '/' .  $valor['idSalario'] . '/' . 'I' . '/' . 1  ?>" data-bs-toggle="modal" data-bs-target="#eliminarSalario" type="image" src="<?php echo base_url(); ?>assets/img/delete.png" width="20" height="20" title="Eliminar Registro"></input>
                        </td>
                    <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL AGREGAR SALARIO - EMPLEADO -->
<form method="POST" action="<?php echo base_url('salarios/insertar') ?>" id="formularioSalarios">
    <div class="modal fade" id="agregarSalario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <input type="hidden" name="idSalario" id="idSalario">
                <input type="hidden" name="idEmpleado" id="idEmpleado">
                <input type="hidden" name="tipo" id="tipo">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tituloModalAgregar">Agregar Nuevo Empleado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3" style="width: 100%">
                            <label for="periodo" class="col-form-label">Periodo (Salario):</label>
                            <div class="flex ">
                                <select class="form-select" name="periodo" aria-label="periodo" id="periodo">
                                    <option selected value="">-- Seleccionar Año --</option>
                                    <?php $years = range(strftime("%Y", time()), 2000); ?>
                                    <?php foreach ($years as $year) : ?>
                                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3" style="width: 100%">
                            <label for="message-text" class="col-form-label">Salario:</label>
                            <div class="d-flex align-items-center">
                                <label for="salario" class="fw-semibold fs-5 me-2">$</label>
                                <input type="number" name="salario" class="form-control" id="salario">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btnGuardar">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="eliminarSalario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    $('#formularioSalarios').on('submit', function(e) {
        periodo = $('#periodo').val()
        salario = $('#salario').val()

        if ([periodo, salario].includes('')) {
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

    function seleccionarSalario(idSalario, idEmpleado, tipo) {
        if (tipo == 2) {
            $('#tipo').val(2)
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('salarios/buscarSalario') ?>" + '/' + idEmpleado + '/' + idSalario,
                dataType: "json",
                success: function(res) {
                    $('#idEmpleado').val(res[0]['idEmpleado'])
                    $('#idSalario').val(res[0]['idSalario'])
                    $('#salario').val(res[0]['sueldo']);
                    $('#periodo').val(res[0]['periodoAno']);
                    $('#btnGuardar').text('Actualizar')
                    $('#tituloModalAgregar').text("<?php echo 'Editar Salario - ' . $salarios[0]['nombreEmpleado'] . ' ' . $salarios[0]['apellidoEmpleado'] ?>")
                    $('#agregarSalario').modal('show')
                }
            })
        } else {
            $('#tipo').val(1)
            $('#salario').val('');
            $('#periodo').val('');
            $('#tipoModal').val(tipo)
            $('#idEmpleado').val(idEmpleado)
            $('#idSalario').val(idSalario)
            $('#tituloModalAgregar').text("<?php echo 'Agregar Salario - ' . $salarios[0]['nombreEmpleado'] . ' ' . $salarios[0]['apellidoEmpleado'] ?>")
            $('#btnGuardar').text('Guardar')
        }
    }
    $('#eliminarSalario').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))
    })
</script>