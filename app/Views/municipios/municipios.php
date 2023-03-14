<div class="container card my-4">
    <div>
        <h1 class="titulo_Vista text-center"><?php echo $titulo ?></h1>
    </div>
    <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarMunicipios">Agregar</button>
        <button type="button" class="btn btn-secondary">Eliminados</button>
        <a href="<?php echo base_url('/principal'); ?>" class="btn btn-primary regresar_Btn">Regresar</a>
    </div>

    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-sm table-striped" id="tablePaises" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#98040a;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>Id</th>
                    <th>Municipio</th>
                    <th>Departamento</th>
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
                            <?php echo $valor['nombreDeparta']; ?>
                        </td>

                        <td style="height:0.2rem;width:1rem;">
                            <input href="#" data-toggle="modal" data-target="#modal-confirma" type="image" src="<?php echo base_url(); ?>assets/img/editar.png" width="20" height="20" title="Editar Registro"></input>
                            <input href="#" data-toggle="modal" data-target="#modal-confirma" type="image" src="<?php echo base_url(); ?>assets/img/delete.png" width="20" height=20" title="Eliminar Registro"></input>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>


<!-- MODAL AGREGAR MUNICIPIO -->
<form method="POST" action="<?php echo base_url('municipios/insertar'); ?>">
<div class="modal fade" id="AgregarMunicipios" tabindex="-1" aria-labelledby="AgregarMunicipios" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Municipio</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">País:</label>
                        <select name="pais" id="selectPais" class="form-select" aria-label="Paises">
                            <option selected>-- Seleccionar País --</option>
                            <?php foreach ($paises as $x => $valor) { ?>
                                <option value="<?php echo $valor['id']; ?>"><?php echo $valor['nombre']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="departamento" class="col-form-label">Departamento:</label>
                        <select class="form-select" name="departamento" id="departamento" aria-label="Departamentos">
                            <!-- CAMBIO DINAMICO SEGUN EL PAIS -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Municipio:</label>
                        <input type="text" name="nombre" class="form-control" id="nombre">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
</form>

<script src="<?php echo base_url('assets/js/municipios.js') ?>"></script>
<script type="text/javascript">
    var baseUrl = '<?php echo base_url() ?>'
</script>