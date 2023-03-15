<div class="container card my-4">
    <div>
        <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
    </div>
    <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarDepartamento" onclick="seleccionaDepartamento(<?php echo 1 . ',' . 1 ?>);">Agregar</button>
        <button type="button" class="btn btn-secondary">Eliminados</button>
        <a href="<?php echo base_url('/principal'); ?>" class="btn btn-primary regresar_Btn">Regresar</a>
    </div>

    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#98040a;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>Id</th>
                    <th>Departamento</th>
                    <th>Pais</th>
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
                            <?php echo $valor['nombre']; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $valor['nombrePais']; ?>
                        </td>

                        <td style="height:0.2rem;width:1rem;">
                            <input href="#" onclick="seleccionaDepartamento(<?php echo $valor['id'] . ',' . 2 ?>);" data-toggle="modal" data-target="#modal-confirma" type="image" src="<?php echo base_url(); ?>assets/img/editar.png" width="16" height="16" title="Editar Registro"></input>
                            <input href="#" data-toggle="modal" data-target="#modal-confirma" type="image" src="<?php echo base_url(); ?>assets/img/delete.png" width="16" height="16" title="Eliminar Registro"></input>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>



<!-- MODAL AGREGAR DEPARTAMENTO -->
<form method="POST" action="<?php echo base_url('departamentos/insertar'); ?>" autocomplete="off">
    <div class="modal fade" id="AgregarDepartamento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <input type="text" name="id" id="i+dDpto">
        <input type="text" name="tipe" id="tipeFunct">
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
                                <option selected>-- Seleccionar País --</option>
                                <?php foreach ($paises as $x => $valor) { ?>
                                    <option value="<?php echo $valor['id']; ?>"><?php echo $valor['nombre']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" id="nombreDpto">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Confirma Eliminar -->
<div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div style="text-align:center;" class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminación de Registro</h5>

            </div>
            <div class="modal-body">
                <p>Seguro Desea Eliminar éste Registro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary close" data-dismiss="modal">No</button>
                <a class="btn btn-danger btn-ok">Si</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal Elimina -->

<script type="text/javascript">
    function seleccionaDepartamento(id, tp) {
        if (tp == 2) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('departamentos/buscarDepartamento'); ?>" + "/" + id,
                dataType: "json",
                success: function(rs) {
                    $("#tipeFunct").val(tp);
                    $("#idDpto").val(rs[0]['id']);
                    $("#tituloModal").text('Editar Departamento ' + rs[0]['nombre'])
                    $("#btnGuardar").text('Actualizar');
                    $("#pais").val(rs[0]['id_pais']);
                    $("#nombreDpto").val(rs[0]['nombre']);
                    $("#AgregarDepartamento").modal("show");
                }
            })
        } else {
            $("#idDpto").val('');
            $("#tituloModal").text('Agregar Departamento')
            $("#tipeFunct").val(tp);
        }
    }
</script>