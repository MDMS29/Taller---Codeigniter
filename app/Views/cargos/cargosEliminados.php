<div class="container card my-4">
    <div>
        <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
    </div>
    <div>
        <a href="<?php echo base_url('/cargos'); ?>" class="btn btn-secondary regresar_Btn">Regresar</a>
    </div>

    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#98040a;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>Id</th>
                    <th>Nombre</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;">
                <?php foreach ($datos as $x => $valor) { ?>
                    <tr>
                        <td class="text-center"><?php echo $valor['id']; ?></td>
                        <td class="text-center"><?php echo $valor['nombre']; ?></td>
                        <td class="text-center">
                            <input href="#" data-href="<?php echo base_url('/cargos/eliminarResLogic') . '/' . $valor['id'] . '/' . 'A' . '/' . 2 ?>" data-bs-toggle="modal" data-bs-target="#restaurarCargo" type="image" src="<?php echo base_url(); ?>assets/img/restore.png" width="16" height="16" title="Restaurar Registro"></input>

                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>


<!-- MODAL RESTAURAR DEPARTAMENTO -->
<div class="modal fade" id="restaurarCargo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    $('#restaurarCargo').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))
    })
</script>