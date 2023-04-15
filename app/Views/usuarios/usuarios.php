<div class="container card my-4 ">
    <div>
        <h1 class="titulo_Vista text-center">
            <?php echo $titulo ?>
        </h1>
    </div>
    <div class="d-flex justify-content-between">
        <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarUsuario" onclick="seleccionarUsuario(<?php echo 1 . ',' . 1 ?>)"><i class="bi bi-clipboard-plus"></i> Agregar</button>
            <a href="<?php echo base_url('/usuarios/eliminados'); ?>" type="button" class="btn btn-secondary"><i class="bi bi-folder-x"></i> Eliminados</a>
            <a href="<?php echo base_url('/home'); ?>" class="btn btn-primary regresar_Btn"><i class="bi bi-arrow-counterclockwise"></i> Regresar</a>

        </div>
    </div>

    <br>
    <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; overflow:scroll-horizontal;overflow-x: scroll !important;height: 600px;">
        <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#008040;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>#</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th># Identificación</th>
                    <th>Email</th>
                    <?php if ($dataUser['rol'] == 'Super Administrador') { ?>

                        <th colspan="2">Acciones</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;" id="tbodyT">
                <?php $contador = 0 ?>
                <?php if (empty($datos)) { ?>
                    <tr>
                        <td colspan="6" class="text-center h4"><?php echo '¡No Hay Usuarios!' ?></td>
                    </tr>
                <?php } else { ?>
                    <?php foreach ($datos as $valor) { ?>
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
                                <?php echo $valor['n_iden']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $valor['email']; ?>
                            </td>
                            <?php if ($dataUser['rol'] == 'Super Administrador') { ?>

                                <td class="text-center" colspan="2">
                                    <input href="#" onclick="seleccionarUsuario(<?php echo $valor['id'] . ',' . 2 ?>);" data-bs-toggle="modal" data-bs-target="#agregarUsuario" type="image" src="<?php echo base_url(); ?>assets/img/editar.png" width="20" height="20" title="Editar Registro"></input>

                                    <input href="#" data-href="<?php echo base_url('dltUsu') . '/' . $valor['id'] . '/' . 'I' . '/' . 1; ?>" data-bs-toggle="modal" data-bs-target="#eliminarUsuario" type="image" src="<?php echo base_url(); ?>assets/img/delete.png" width="20" height="20" title="Eliminar Registro" value="<?php echo $valor['id']; ?>"></input>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>



<!-- MODAL AGREGAR - EDITAR USUARIO -->
<form method="POST" action="<?php echo base_url('instrUsu'); ?>" autocomplete="off" id="formularioUsuarios">
    <div class="modal fade" id="agregarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <input type="text" name="id" id="id" value="0" hidden>
        <input type="text" name="tp" id="tp" hidden>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tituloModal">Agregar Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="d-flex column-gap-3" style="width: 100%">
                            <div class="mb-3" style="width: 100%">
                                <label for="nombres" class="col-form-label">Nombres:</label>
                                <input type="text" name="nombres" class="form-control" id="nombres">
                            </div>
                            <div class="mb-3" style="width: 100%">
                                <label for="apellidos" class="col-form-label">Apellidos:</label>
                                <input type="text" name="apellidos" class="form-control" id="apellidos">
                            </div>
                        </div>
                        <div class="d-flex column-gap-3" style="width: 100%">
                            <div class="mb-3" style="width: 100%">
                                <label for="nombres" class="col-form-label"># Identificacíon:</label>
                                <input type="number" name="n_iden" class="form-control" id="n_iden">
                            </div>
                            <div class="mb-3" style="width: 100%">
                                <label for="apellidos" class="col-form-label">Rol:</label>
                                <select class="form-select" name="rol" id="rol">
                                    <option value="" selected> -- Seleccione un Rol --</option>
                                    <option value="1">Super Administrador</option>
                                    <option value="2">Administrador</option>
                                </select>
                                <!-- <input type="email" name="email" class="form-control" id="email"> -->
                            </div>
                        </div>
                        <div class="mb-3" style="width: 100%">
                            <label for="apellidos" class="col-form-label">Email:</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="d-flex column-gap-3" style="width: 100%">
                            <div class="mb-3" style="width: 100%">
                                <label for="nombres" class="col-form-label">Contraseña:</label>
                                <input type="password" name="contra" class="form-control" id="contra" minlength="5">
                                <small class="normal">¡La contraseña debe contar con un minimo de 6 caracteres!</small>
                            </div>
                            <div class="mb-3" style="width: 100%">
                                <div>
                                    <label for="nombres" class="col-form-label">Confirmar Contraseña:</label>
                                    <input type="password" name="confirContra" class="form-control" id="confirContra" minlength="5">
                                </div>
                                <small id="msgConfir" class="normal"></small>
                            </div>
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

<!-- MODAL ELIMINAR USUARIO -->
<div class="modal fade" id="eliminarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    function verifiContra(tipo) {
        contra = $('#contra').val()
        confirContra = $('#confirContra').val()
        if (tipo == 2) {
            if (contra == '' && confirContra == '') {
                $('#msgConfir').text('').removeClass().addClass('normal')
            } else if (contra == confirContra) {
                $('#msgConfir').text('¡Contraseñas valida!').removeClass().addClass('valido')
            } else if (contra == '') {
                $('#msgConfir').text('¡Ingrese una contraseña!').removeClass().addClass('normal')
            } else if (confirContra == '') {
                $('#msgConfir').text('').removeClass().addClass('normal')
            } else if (contra != confirContra) {
                return $('#msgConfir').text('¡Las contraseñas no coinciden!').removeClass().addClass('invalido')
            }
        } else {
            if (contra == '' && confirContra == '') {
                $('#msgConfir').text('').removeClass().addClass('normal')
            } else if (contra == '' && confirContra) {
                $('#msgConfir').text('¡Ingrese una contraseña!').removeClass().addClass('normal')
            } else if (confirContra == '') {
                $('#msgConfir').text('').removeClass().addClass('normal')
            } else if (confirContra && contra == confirContra) {
                $('#msgConfir').text('¡Contraseñas valida!').removeClass().addClass('valido')
            } else if (confirContra && contra != confirContra) {
                return $('#msgConfir').text('¡Las contraseñas no coinciden!').removeClass().addClass('invalido')
            }
        }
    }

    $('#confirContra').on('input', function(e) {
        verifiContra(2)
    })

    $('#contra').on('input', function(e) {
        verifiContra(1)
    })

    $('#formularioUsuarios').on('submit', function(e) {
        nombres = $('#nombres').val()
        apellidos = $('#apellidos').val()
        n_iden = $('#n_iden').val()
        email = $('#email').val()
        rol = $('#rol').val()
        contra = $('#contra').val()
        confirContra = $('#confirContra').val()
        tp = $('#tp').val()

        if (tp == 2) {
            if ([nombres, apellidos, n_iden, email, rol].includes('')) {
                e.preventDefault()
                return Swal.fire({
                    position: 'center',
                    icon: 'error',
                    text: '¡Hay campos vacios o las contraseña no coinciden!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        } else {
            if ([nombres, apellidos, n_iden, email, rol, contra, confirContra].includes('') || contra != confirContra) {
                e.preventDefault()
                return Swal.fire({
                    position: 'center',
                    icon: 'error',
                    text: '¡Hay campos vacios o las contraseña no coinciden!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    })

    function seleccionarUsuario(id, tp) {
        if (tp == 2) {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('srchUsu/') ?>" + id,
                dataType: 'json',
                success: function(res) {
                    $('#tp').val(2)
                    $('#id').val(res[0]['id'])
                    $('#nombres').val(res[0]['nombres'])
                    $('#apellidos').val(res[0]['apellidos'])
                    $('#n_iden').val(res[0]['n_iden'])
                    $('#rol').val(res[0]['id_rol'])
                    $('#email').val(res[0]['email'])
                    $('#contra').val('')
                    $('#confirContra').val('')
                    $('#tituloModal').text('Editar Usuario - ' + res[0]['nombres'] + ' ' + res[0]['apellidos'])
                }
            })

        } else {
            $('#id').val('')
            $('#tp').val(1)
            $('#nombres').val('')
            $('#apellidos').val('')
            $('#n_iden').val('')
            $('#rol').val('')
            $('#email').val('')
            $('#contra').val('')
            $('#confirContra').val('')
            $('#tituloModal').text('Agregar Usuario')
        }
    }

    $('#eliminarUsuario').on('shown.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))
    })
</script>