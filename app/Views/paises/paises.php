<div class="container card my-4 ">
    <div>
        <h1 class="titulo_Vista text-center">
            <?php echo $titulo ?>
        </h1>
    </div>
    <div class="d-flex justify-content-between">
        <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarPais" onclick="seleccionaPais(<?php echo 1 . ',' . 1 ?>);"><i class="bi bi-clipboard-plus"></i> Agregar</button>
            <a href="<?php echo base_url('/paises/eliminados'); ?>" type="button" class="btn btn-secondary"><i class="bi bi-folder-x"></i> Eliminados</a>
            <a href="<?php echo base_url('/home'); ?>" class="btn btn-primary regresar_Btn"><i class="bi bi-arrow-counterclockwise"></i> Regresar</a>

        </div>
        <div>
            <input class="form-control me-2" type="search" placeholder="Buscar por Nombre" aria-label="Search" id="srchNombre">
        </div>
    </div>

    <br>
    <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; overflow:scroll-horizontal;overflow-x: scroll !important;height: 600px;">
        <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#008040;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>#</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <?php if ($dataUser['rol'] == 'Super Administrador') { ?>
                        <th colspan="2">Acciones</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;" id="tbodyT">
                <?php $contador = 0 ?>
                <?php if (empty($datos)) { ?>
                    <tr>
                        <td colspan="5" class="text-center h4"><?php echo '¡No Hay Países!' ?></td>
                    </tr>
                <?php } else { ?>
                    <?php foreach ($datos as $valor) { ?>
                        <tr>
                            <td class="text-center">
                                <?php echo $contador += 1; ?>
                            </td>
                            <td class="text-center">
                                + <?php echo $valor['codigo']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $valor['nombre']; ?>
                            </td>
                            <?php if ($dataUser['rol'] == 'Super Administrador') { ?>
                                <td class="text-center" colspan="2">
                                    <input href="#" onclick="seleccionaPais(<?php echo $valor['id'] . ',' . 2 ?>);" data-bs-toggle="modal" data-bs-target="#AgregarPais" type="image" src="<?php echo base_url(); ?>assets/img/editar.png" width="20" height="20" title="Editar Registro"></input>

                                    <input href="#" data-href="<?php echo base_url('dltPs') . '/' . $valor['id'] . '/' . 'I' . '/' . 1; ?>" data-bs-toggle="modal" data-bs-target="#eliminarPais" type="image" src="<?php echo base_url(); ?>assets/img/delete.png" width="20" height="20" title="Eliminar Registro" value="<?php echo $valor['id']; ?>"></input>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL AGREGAR - EDITAR PAIS -->
<form method="POST" action="<?php echo base_url('instrPs'); ?>" autocomplete="off" id="formularioPaises">
    <div class="modal fade" id="AgregarPais" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <input type="text" name="id" id="idPais" value="0" hidden>
        <input type="text" name="idCrea" id="idCrea" value="<?php echo $dataUser['id'] ?>" hidden>
        <input type="text" name="tipe" id="tipeFunct" hidden>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tituloModal">Agregar Pais</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Codigo de País:</label>
                            <input type="number" name="codigo" class="form-control" id="codigoPais" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" id="nombrePais">
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

<!-- MODAL ELIMINAR PAISES -->
<div class="modal fade" id="eliminarPais" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    /* -- BUSCADOR DE PAISES -- */
    $('#srchNombre').on('input', function() {
        nombre = $('#srchNombre').val()
        if (nombre.length > 0) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('paises/filtroNombre/') ?>" + nombre + '/' + 'A',
                dataType: "json",
                success: function(res) {
                    var cadena
                    for (let i = 0; i < res.length; i++) {
                        cadena += `
                        <tr>
                        <td class="text-center">
                        ${i + 1}
                        </td>
                        <td class="text-center">
                        ${res[i]['codigo']}
                        </td>
                        <td class="text-center">
                        ${res[i]['nombre']}
                        </td>
                        <td class="text-center" colspan="2">
                            <input href="#" onclick="seleccionaPais(${res[i]['id']}, 2);" data-bs-toggle="modal" data-bs-target="#AgregarPais" type="image" src="<?php echo base_url(); ?>assets/img/editar.png" width="20" height="20" title="Editar Registro"></input>
                            <input href="#" data-href="http://localhost/taller/public/dltPs/${res[i]['id']}/I/1" data-bs-toggle="modal" data-bs-target="#eliminarPais" type="image" src="<?php echo base_url(); ?>assets/img/delete.png" width="20" height="20" title="Eliminar Registro"></input>
                        </td>`
                    }
                    $('#tbodyT').html(cadena)
                }
            })
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('paises/filtroNombre/') ?>" + 'seeAll' + '/' + 'A',
                dataType: "json",
                success: function(res) {
                    var cadena
                    for (let i = 0; i < res.length; i++) {
                        cadena += `
                        <tr>
                            <td class="text-center">
                                ${i + 1}
                            </td>
                            <td class="text-center">
                                ${res[i]['codigo']}
                            </td>
                            <td class="text-center">
                                ${res[i]['nombre']}
                            </td>
                            <td class="text-center" colspan="2">
                                <input href="#" onclick="seleccionaPais(${res[i]['id']} , 2);" data-bs-toggle="modal" data-bs-target="#AgregarPais" type="image" src="<?php echo base_url(); ?>assets/img/editar.png" width="20" height="20" title="Editar Registro"></input>
                                <input href="#" data-href="<?php echo base_url('dltPs') . '/' . $valor['id'] . '/' . 'I' . '/' . 1; ?>" data-bs-toggle="modal" data-bs-target="#eliminarPais" type="image" src="<?php echo base_url(); ?>assets/img/delete.png" width="20" height="20" title="Eliminar Registro"></input>
                            </td>`
                    }
                    $('#tbodyT').html(cadena)
                }
            })
        }
    })

    $('#formularioPaises').on('submit', function(e) {
        pais = $('#codigoPais').val()
        nombre = $('#nombrePais').val()
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

    function seleccionaPais(id, tp) {
        if (tp == 2) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('srchPs'); ?>" + "/" + id,
                dataType: "json",
                success: function(rs) {
                    $("#tipeFunct").val(tp);
                    $("#idPais").val(rs[0]['id']);
                    $("#tituloModal").text('Editar Pais - ' + rs[0]['nombre'])
                    $("#btnGuardar").text('Actualizar');
                    $("#codigoPais").val(rs[0]['codigo']);
                    $("#nombrePais").val(rs[0]['nombre']);
                    $("#AgregarPais").modal("show");
                }
            })
        } else {
            $("#id").val(0);
            $("#tituloModal").text('Agregar Pais')
            $("#tipeFunct").val(tp);
            $("#codigoPais").val('');
            $("#nombrePais").val('')
        }
    }

    $('#eliminarPais').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))
    })
</script>