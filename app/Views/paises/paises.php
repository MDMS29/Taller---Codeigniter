<div class="container card my-4">
    <div>
        <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
    </div>
    <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarPais" onclick="seleccionaPais(<?php echo 1 . ',' . 1 ?>);">Agregar</button>
        <button type="button" class="btn btn-secondary">Eliminados</button>
        <a href="<?php echo base_url('/principal'); ?>" class="btn btn-primary regresar_Btn">Regresar</a>
    </div>

    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#98040a;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>Id</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;">
                <?php foreach ($datos as $x => $valor) { ?>
                    <tr>
                        <td class="text-center"><?php echo $valor['id']; ?></td>
                        <td class="text-center"><?php echo $valor['codigo']; ?></td>
                        <td class="text-center"><?php echo $valor['nombre']; ?></td>
                        <td class="text-center"><?php echo $valor['estado']; ?></td>
                        <td class="text-center" colspan="2">
                            <input href="#" onclick="seleccionaPais(<?php echo $valor['id'] . ',' . 2 ?>);" data-bs-toggle="modal" data-bs-target="#AgregarPais" type="image" src="<?php echo base_url(); ?>assets/img/editar.png" width="20" height="20" title="Editar Registro"></input>
                            <input id="eliminarPais" href="#" data-toggle="modal" data-target="#modal-confirma" type="image" src="<?php echo base_url(); ?>assets/img/delete.png" width="20" height="20" title="Eliminar Registro" value="<?php echo $valor['id']; ?>"></input>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>



<!-- MODAL AGREGAR - EDITAR PAIS -->
<form method="POST" action="<?php echo base_url('paises/insertar'); ?>" autocomplete="off">
    <div class="modal fade" id="AgregarPais" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tituloModal">Agregar Pais</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Codigo de Pa??s:</label>
                            <input type="number" name="codigo" class="form-control" id="codigoPais">
                            <input type="hidden" name="tipe" id="tipe">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" id="nombrePais">
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

<script type="text/javascript">
    function seleccionaPais(id, tp) {
        if (tp == 2) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('paises/buscarPais'); ?>" + "/" + id,
                dataType: "json",
                success: function(rs) {
                    $("#tipe").val(2);
                    $("#tituloModal").text('Editar Pais ' + rs[0]['nombre'])
                    $("#codigoPais").val(rs[0]['codigo']);
                    $("#nombrePais").val(rs[0]['nombre']);
                    $("#btnGuardar").text('Actualizar');
                    $("#AgregarPais").modal("show");
                }
            })
        } else {
            $("#tituloModal").text('Agregar Pais')
            $("#tipe").val(1);
            $("#codigoPais").val('');
            $("#nombrePais").val('')
        }
    }
    $('#btnGuardar').on('click', function(e) {
        e.preventDefault()
        codigo = $("#codigoPais").val();
        nombre = $("#nombrePais").val();
        data = [codigo, nombre]
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('paises/actualizarPais'); ?>" + "/" + data,
            dataType: "json",
            success: function(rs) {

            }
        })
    })
</script>