<div class="container card my-4">
    <div>
        <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
    </div>
    <div>
        <a href="<?php echo base_url('/empleados'); ?>" class="btn btn-secondary regresar_Btn"><i class="bi bi-arrow-counterclockwise"></i> Regresar</a>
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
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;">
                <?php $contador = 0; ?>
                <?php if (empty($datos)) { ?>
                    <tr>
                        <td colspan="10" class="text-center h4"><?php echo '¡No Hay Empleados Eliminados!' ?></td>
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
                                <?php echo $valor['estadoDpto'] == 'A' ? $valor['nombrePais'] : $valor['nombrePais'] . ' - <span class="text-danger fw-bold">Inactivo</span>'; ?>
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
                                <input href="#" data-href="<?php echo base_url('dltEpl') . '/' . $valor['id'] . '/' . 'A' . '/' . 1  ?>" data-bs-toggle="modal" data-bs-target="#eliminarEmple" type="image" src="<?php echo base_url(); ?>assets/img/restore.png" width="16" height="16" title="Restaurar Registro"></input>
                            </td>
    
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<!-- MODAL ELIMINAR EMPLEADO -->
<div class="modal fade" id="eliminarEmple" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    $('#eliminarEmple').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))
    })
</script>