<div class="container card my-4">
    <div class="my-3">
        <h1 class="text-center"><?php echo $titulo ?></h1>
    </div>
    <div>
        <a href="<?php echo base_url('/ver-salarios/') . $empleado[0]['idEmpleado'] ?>" class="btn btn-primary regresar_Btn"><i class="bi bi-arrow-counterclockwise"></i> Regresar</a>
    </div>

    <br>
    <div class="table-responsive " style="overflow:scroll-vertical;overflow-y: scroll !important; overflow:scroll-horizontal;overflow-x: scroll !important;height: 600px;">
        <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#008040;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>#</th>
                    <th>Periodo (Año)</th>
                    <th>Salario</th>
                    <?php if ($dataUser['rol'] == 'Super Administrador') { ?>

                        <th colspan="2">Acciones</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;">
                <?php $contador = 0; ?>
                <?php if (empty($salarios[0]['idEmpleado'])) { ?>
                    <tr>
                        <td colspan="7" class="text-center h4"><?php echo '¡No Hay Salarios Eliminados!' ?></td>
                    </tr>
                <?php } else { ?>
                    <?php foreach ($salarios as $valor) { ?>
                        <tr>
                            <td class="text-center"><?php echo $contador += 1; ?></td>
                            <td class="text-center"><?php echo $valor['periodoAno']; ?></td>
                            <td class="text-center">$ <?php echo $valor['sueldo']; ?></td>
                            <?php if ($dataUser['rol'] == 'Super Administrador') { ?>

                                <td colspan="2" class="text-center">
                                    <input href="#" data-href="<?php echo base_url('dltSala') . '/' . $valor['idEmpleado'] . '/' .  $valor['idSalario'] . '/' . 'A' . '/' . 2  ?>" data-bs-toggle="modal" data-bs-target="#eliminarSalario" type="image" src="<?php echo base_url(); ?>assets/img/restore.png" width="20" height="20" title="Eliminar Registro"></input>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="eliminarSalario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div style="text-align:center;" class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Restauracion de Registro</h5>
            </div>
            <div class="modal-body">
                <p>Seguro Desea Restaurar éste Registro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary close" data-bs-dismiss="modal">No</button>
                <a class="btn btn-danger btn-ok">Si</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#eliminarSalario').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))
    })
</script>