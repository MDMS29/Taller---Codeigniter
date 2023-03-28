<div class="container card my-4">
    <div>
        <h1 class="titulo_Vista text-center">
            <?php echo $titulo ?>
        </h1>
    </div>
    <div class="d-flex justify-content-between">
        <div>
            <a href="<?php echo base_url('/paises'); ?>" class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise"></i> Regresar</a>
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
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;" id="tbodyT">
                <?php $contador = 0 ?>

                <?php if (empty($datos)) { ?>
                    <tr>
                        <td colspan="5" class="text-center h4"><?php echo '¡No Hay Países Eliminados!' ?></td>
                    </tr>
                <?php } else { ?>
                    <?php foreach ($datos as $valor) { ?>
                        <tr>
                            <td class="text-center">
                                <?php echo $contador += 1;   ?>
                            </td>
                            <td class="text-center">
                                + <?php echo $valor['codigo']; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $valor['nombre']; ?>
                            </td>
                            <td class="text-center" colspan="2">
                                <input href="#" data-href="<?php echo base_url('dltPs') . '/' . $valor['id'] . '/' . 'A' . '/' . 2; ?>" data-bs-toggle="modal" data-bs-target="#restaurarPais" type="image" src="<?php echo base_url(); ?>assets/img/restore.png" width="20" height="20" title="Restaurar Registro" value="<?php echo $valor['id']; ?>"></input>
                            </td>
                        </tr>
                    <?php } ?>
                <?php }  ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL RESTAURAR PAIS -->
<div class="modal fade" id="restaurarPais" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<script type="text/javascript">
    $('#srchNombre').on('input', function() {
        nombre = $('#srchNombre').val()
        if (nombre.length > 0) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('paises/filtroNombre/') ?>" + nombre + '/' + 'I',
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
                                <input href="#" data-href="http://localhost/taller/public/dltPs/${res[i]['id']}/I/2" data-bs-toggle="modal" data-bs-target="#restaurarPais" type="image" src="<?php echo base_url(); ?>assets/img/restore.png" width="20" height="20" title="Restaurar Registro"></input>
                            </td>`
                    }
                    $('#tbodyT').html(cadena)
                }
            })
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('paises/filtroNombre/') ?>" + 'seeAll' + '/' + 'I',
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
                            <input href="#" data-href="http://localhost/taller/public/dltPs/${res[i]['id']}/I/2" data-bs-toggle="modal" data-bs-target="#restaurarPais" type="image" src="<?php echo base_url(); ?>assets/img/restore.png" width="20" height="20" title="Restaurar Registro"></input>
                            </td>`
                    }
                    $('#tbodyT').html(cadena)
                }
            })
        }
    })

    $('#restaurarPais').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))
    })
</script>