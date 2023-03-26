<div class="container card my-4">
    <div class="my-3">
        <h1 class="text-center"><?php echo $titulo ?></h1>
    </div>
    <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarSalario" onclick="seleccionarSalario(<?php echo 0  . ',' . 0 . ',' . 1 ?>)">Agregar</button>
        <a href="<?php echo base_url('/salarios/eliminados') ?>" class="btn btn-secondary">Eliminados</a>
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
                        </td>
                    <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="agregarSalario" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <input type="" name="idSalarioM" id="idSalarioM">
            <input type="" name="idEmpleadoM" id="idEmpleadoM">
            <input type="" name="tipoModal" id="tipoModal">

            <div class="modal-header">
                <h5 class="modal-title" id="tituloModalAgregar"> <!-- TITULO MODAL DINAMICO --> </h5>
                <button class="btn btn-close" data-bs-target="#modalSalarios" data-bs-toggle="modal" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
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
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" id="btnGuardar"> </button>
                <button class="btn btn-primary" data-bs-target="#modalSalarios" data-bs-toggle="modal" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function seleccionarSalario(idSalario, idEmpleado, tipo) {
        if (tipo == 2) {
            $('#tipoModal').val(tipo)
            $('#idEmpleadoM').val(idEmpleado)
            $('#idSalarioM').val(idSalario)

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('salarios/buscarSalario') ?>" + '/' + idEmpleado + '/' + idSalario,
                dataType: "json",
                success: function(res) {
                    $('#salario').val(res[0]['sueldo']);
                    $('#periodo').val(res[0]['periodoAno']);
                    $('#btnGuardar').text('Actualizar')
                    $('#tituloModalAgregar').text('Editar Salario - ' + res[0]['nombreEmpleado'])
                    $('#agregarSalario').modal('show')
                }
            })
        } else {
            $('#salario').val('');
            $('#periodo').val('');
            $('#tipoModal').val(tipo)
            $('#idEmpleadoM').val(idEmpleado)
            $('#idSalarioM').val(idSalario)
            $('#tituloModalAgregar').text('Agregar Salario - ' + nombreEmple)
            $('#btnGuardar').text('Guardar')
        }
    }
</script>