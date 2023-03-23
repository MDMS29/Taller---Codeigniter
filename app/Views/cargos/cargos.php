<div class="container card my-4">
    <div>
        <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
    </div>
    <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarCargo" onclick="seleccionarCargo(<?php echo 1 . ',' . 1 ?>)">Agregar</button>
        <a href="<?php echo base_url('/cargos/eliminados'); ?>" type="button" class="btn btn-secondary">Eliminados</a>
        <a href="<?php echo base_url('/principal'); ?>" class="btn btn-primary regresar_Btn">Regresar</a>
    </div>

    <br>
    <div class="table-responsive" style="overflow:scroll-vertical;overflow-y: scroll !important; overflow:scroll-horizontal;overflow-x: scroll !important;height: 600px;">
        <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#008040;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>#</th>
                    <th>Nombre</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;">
                <?php foreach ($datos as $x => $valor) { ?>
                    <tr>
                        <td class="text-center"><?php echo $valor['id']; ?></td>
                        <td class="text-center"><?php echo $valor['nombre']; ?></td>
                        <td class ="text-center" colspan="2">
                            <input href="#" onclick="seleccionarCargo(<?php echo $valor['id'] . ',' . 2 ?>)" data-bs-toggle="modal" data-bs-target="#AgregarCargo" type="image" src="<?php echo base_url(); ?>assets/img/editar.png" width="20" height="20" title="Editar Registro"></input>
                            <input href="#" data-href="<?php echo base_url('/cargos/eliminarResLogic') . '/' . $valor['id'] . '/' . 'I' . '/' . 1; ?>" data-bs-toggle="modal" data-bs-target="#eliminarCargo" type="image" src="<?php echo base_url(); ?>assets/img/delete.png" width="20" height=20" title="Eliminar Registro"></input>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>



<!-- MODAL AGREGAR CARGO -->
<form method="POST" action="<?php echo base_url('cargos/insertar'); ?>" autocomplete="off" id="formularioCargo">
    <div class="modal fade" id="AgregarCargo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <input id="id" name="id" hidden>
                <input id="tp" name="tp" hidden>
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="titulo">Agregar Cargo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" id="nombre">
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

<!-- MODAL ELIMINAR DEPARTAMENTO -->
<div class="modal fade" id="eliminarCargo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<script>
    $('#formularioCargo').on('submit', function(e) {
        //Verificacion de campos vacios en el formulario
        nombre = $('#nombre').val()

        if ([nombre].includes('')) {
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

    function seleccionarCargo(id, tp) {
        if (tp == 2) {
            //Editar
            $.ajax({
                url: '<?php echo base_url('cargos/buscarCargo') ?>' + '/' + id + '/' + '',
                type: 'POST',
                dataType: 'json',
                success: function(res) {
                    $('#tp').val(tp)
                    $('#titulo').text('Actualizar Cargo')
                    $('#btnGuardar').text('Actualizar')
                    $('#id').val(res[0]['id'])
                    $('#nombre').val(res[0]['nombre'])
                    $('#AgregarCargo').modal('show')
                }
            })
        } else {
            $('#tp').val(tp)
            $('#id').val('')
            $('#nombre').val('')
            $('#titulo').text('Agregar Cargo')
            $('#btnGuardar').text('Guardar')
        }
    }

    $('#eliminarCargo').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))
    })
</script>