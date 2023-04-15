<div class="container card my-4 ">
    <div>
        <h1 class="titulo_Vista text-center">
            <?php echo $titulo ?>
        </h1>
    </div>
    <div class="d-flex justify-content-between">
        <div>
            <a href="<?php echo base_url('/home'); ?>" class="btn btn-primary regresar_Btn"><i class="bi bi-arrow-counterclockwise"></i> Regresar</a>
        </div>
        <!--<div>
            <input class="form-control me-2" type="search" placeholder="Buscar por Fecha" aria-label="Search" id="srchNombre">
        </div> -->
    </div>

    <br>
    <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; overflow:scroll-horizontal;overflow-x: scroll !important;height: 600px;">
        <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#008040;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>#</th>
                    <th>Tipo</th>
                    <th>Sección</th>
                    <th>Descripcion</th>
                    <th>Fecha</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;" id="tbodyT">
                <?php $contador = 0 ?>
                <?php if (empty($datos)) { ?>
                    <tr>
                        <td colspan="6" class="text-center h4"><?php echo '¡No Hay Acciones Realizadas!' ?></td>
                    </tr>
                <?php } else { ?>
                    <?php foreach ($datos as $valor) { ?>
                        <tr>
                            <td class="text-center">
                                <?php echo $contador += 1; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $valor['tipo']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $valor['tabla']; ?>
                            </td>
                            <td class="text-center descripcion">
                                <?php echo $valor['accion']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $valor['fechaCrea']; ?>
                            </td>
                            <td class="text-center" colspan="2">
                                <button href="#" class="btn btn-primary" onclick="seleccionaItem(<?php echo $valor['id'] ?>);" data-bs-toggle="modal" data-bs-target="#verDetalles" type="image" width="20" height="20" title="Ver Detalles"><i class="bi bi-eye"></i> Ver Detalles</button>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL ELIMINAR PAISES -->
<div class="modal fade" id="verDetalles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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


<script type="text/javascript">
    function seleccionaItem() {

    }
</script>