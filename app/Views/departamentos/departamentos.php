<div class="container card my-4">
    <div>
        <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
    </div>
    <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarDepartamento" onclick="seleccionaDepartamento(<?php echo 1 . ',' . 1 ?>);"><i class="bi bi-clipboard-plus"></i> Agregar</button>
        <a href="<?php echo base_url('/departamentos/eliminados'); ?>" class="btn btn-secondary"><i class="bi bi-folder-x"></i> Eliminados</a>
        <a href="<?php echo base_url('/home'); ?>" class="btn btn-primary regresar_Btn"><i class="bi bi-arrow-counterclockwise"></i> Regresar</a>
    </div>

    <br>
    <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; overflow:scroll-horizontal;overflow-x: scroll !important;height: 600px;">
        <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#008040;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>#</th>
                    <th>Departamento</th>
                    <th>Pais</th>
                    <?php if ($dataUser['rol'] == 'Super Administrador') { ?>

                        <th colspan="2">Acciones</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;">
                <?php $contador = 0;   ?>
                <?php if (empty($datos)) { ?>
                    <tr>
                        <td colspan="5" class="text-center h4"><?php echo '¡No Hay Departamentos!' ?></td>
                    </tr>
                <?php } else { ?>
                    <?php foreach ($datos as $valor) { ?>
                        <tr>
                            <td class="text-center">
                                <?php echo $contador += 1;   ?>
                            </td>
                            <td class="text-center">
                                <?php echo $valor['nombre']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $valor['estadoPais'] == 'A' ? $valor['nombrePais'] : $valor['nombrePais'] . ' - <span class="text-danger fw-bold">Inactivo</span>'; ?>
                            </td>
                            <?php if ($dataUser['rol'] == 'Super Administrador') { ?>

                                <td class="text-center" colspan="2">
                                    <input href="#" onclick="seleccionaDepartamento(<?php echo $valor['id'] . ',' . 2 ?>);" data-toggle="modal" data-target="#AgregarDepartamento" type="image" src="<?php echo base_url(); ?>assets/img/editar.png" width="20" height="20" title="Editar Registro"></input>
                                    <input href="#" data-href="<?php echo base_url('dltDpt') . '/' . $valor['id'] . '/' . 'I' . '/' . 1; ?>" data-bs-toggle="modal" data-bs-target="#eliminarDpto" type="image" src="<?php echo base_url(); ?>assets/img/delete.png" width="20" height="20" title="Eliminar Registro"></input>
                                </td>
                            <?php } ?>

                        </tr>
                    <?php } ?>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>



<!-- MODAL AGREGAR DEPARTAMENTO -->
<form method="POST" action="<?php echo base_url('instrDpt'); ?>" autocomplete="off" id="formularioDptos">
    <div class="modal fade" id="AgregarDepartamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        
        <input hidden name="id" id="idDpto">
        <input hidden name="tipe" id="tipeFunct">
        <input type="text" name="idCrea" id="idCrea" value="<?php echo $dataUser['id'] ?>" hidden >

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tituloModal"><!-- TITULO DINAMICO --></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">País:</label>
                            <select name="pais" class="form-select" aria-label="Departamentos" id="pais">
                                <option selected value="">-- Seleccionar País --</option>
                                <?php foreach ($paises as $x => $valor) { ?>
                                    <option value="<?php echo $valor['id']; ?>" <?php echo $valor['estado'] != 'A' ? 'disabled' : '' ?>><?php echo $valor['estado'] == 'A' ? $valor['nombre'] : $valor['nombre'] . ' - <span class="text-danger fw-bold">Inactivo</span>'; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nombre:</label>
                            <input type="text" name="nombre" class="form-control text-capitalize" id="nombreDpto">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" id="btnGuardar">Guardar</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- MODAL ELIMINAR DEPARTAMENTO -->
<div class="modal fade" id="eliminarDpto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    $('#formularioDptos').on('submit', function(e) {
        pais = $('#pais').val()
        nombre = $('#nombreDpto').val()
        if ([pais, nombre].includes('')) {
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

    function seleccionaDepartamento(id, tp) {
        if (tp == 2) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('srchDpt'); ?>" + "/" + id,
                dataType: "json",
                success: function(rs) {
                    $("#tipeFunct").val(tp);
                    $("#idDpto").val(rs[0]['id']);
                    $("#tituloModal").text('Editar Departamento ' + rs[0]['nombre'])
                    $("#btnGuardar").text('Actualizar');
                    rs[0]['estadoPais'] == 'I' ? $("#pais").val('') : $("#pais").val(rs[0]['id_pais']);
                    $("#nombreDpto").val(rs[0]['nombre']);
                    $("#AgregarDepartamento").modal("show");
                }
            })
        } else {
            $("#pais").val('');
            $("#nombreDpto").val('');
            $("#tituloModal").text('Agregar Departamento')
            $("#tipeFunct").val(tp);
        }
    }
    $('#eliminarDpto').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))
    })
</script>