<div class="container card my-4">
    <div>
        <h1 class="titulo_Vista text-center">
            <?php echo $titulo ?>
        </h1>
    </div>
    <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarMunicipios" onclick="seleccionarMunicipio(<?php echo 1 . ',' . 1 ?>)">Agregar</button>
        <a href="<?php echo base_url('/municipios/eliminados') ?>" class="btn btn-secondary">Eliminados</a>
        <a href="<?php echo base_url('/principal'); ?>" class="btn btn-primary regresar_Btn">Regresar</a>
    </div>

    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-sm table-striped" id="tableMunicipios" width="100%" cellspacing="0">
            <thead>
                <tr style="color:#98040a;font-weight:300;text-align:center;font-family:Arial;font-size:14px;">
                    <th>Id</th>
                    <th>Municipio</th>
                    <th>Departamento</th>
                    <th>País</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody style="font-family:Arial;font-size:12px;">
                <?php $contador = 0; ?>
                <?php foreach ($datos as $x => $valor) { ?>
                    <tr>
                        <td class="text-center">
                            <?php echo $contador += 1; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $valor['nombre']; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $valor['nombreDeparta']; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $valor['nombrePais']; ?>
                        </td>

                        <td style="height:0.2rem;width:1rem;">
                            <input href="#" data-toggle="modal" data-target="#modal-confirma" type="image" src="<?php echo base_url(); ?>assets/img/editar.png" width="20" height="20" title="Editar Registro" onclick="seleccionarMunicipio(<?php echo $valor['id'] . ',' . 2 ?>)"></input>

                            <input href="#" data-href="<?php echo base_url('/municipios/eliminarResLogic') . '/' . $valor['id'] . '/' . 'I' . '/' . 1; ?>" data-bs-toggle="modal" data-bs-target="#eliminarMuni" type="image" src="<?php echo base_url(); ?>assets/img/delete.png" width="20" height="20" title="Eliminar Registro" value="<?php echo $valor['id']; ?>"></input>
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
                <input name="id" id="id" hidden>
                <input name="tp" id="tp" hidden>
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="titulo">Agregar Municipio</h1>
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
                            <div id="contenedor-dptos">
                                <!-- CAMBIO DINAMICO SEGUN EL PAIS -->
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Municipio:</label>
                            <input type="text" name="nombre" class="form-control text-capitalize" id="nombre">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="btn-save">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>



<!-- MODAL ELIMINAR PAISES -->
<div class="modal fade" id="eliminarMuni" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    function obtenerDepartamentos(pais, idDpto) {
        if (pais == 0 && idDpto == 0) {
            //No mostrar nada si no se mandan los valores del pais y el departamento
            //Esto por si se inserta un nuevo registro.
            $('#contenedor-dptos').html('<p class="ms-3 text-danger">*Seleccione un País*</p>')
        } else {
            //Buscar los departamentos del país para mostrarlos en el Select.
            $.ajax({
                url: "<?php echo base_url('municipios/obtenerDepartamentosPais') ?>" + '/' + pais,
                type: 'POST',
                dataType: 'json',
                success: function(res) {
                    //Mostrar todos los departamentos en los items del select
                    var cadena
                    cadena = `<select class="form-select" name="departamento" id="departamento" aria-label="Departamentos"> 
                                    <option selected value="">-- Seleccionar Departamento --</option>`
                    for (let i = 0; i < res.length; i++) {
                        cadena += ` <option value='${res[i].id}'>${res[i].nombre}</option>`
                    }
                    cadena += `</select>`
                    $('#contenedor-dptos').html(cadena)

                    //Le damos el valor del departamento para que se muestre al editar el registro
                    $('#departamento').val(idDpto);
                }
            })
        }
    }
    $('#selectPais').on('change', () => {
        //Al cambio de un país se mostraran los departamentos del país seleccionado
        pais = $('#selectPais').val()
        obtenerDepartamentos(pais)
    })

    //Funcion para saber si se editara o se guardara un registro
    /*
        EDITAR (tp = 2)
        INSERTAR (tp = 1)
    */
    function seleccionarMunicipio(id, tp) {
        if (tp == 2) {
            $.ajax({
                url: "<?php echo base_url('municipios/obtenerMunicipio') ?>" + '/' + id,
                type: 'POST',
                dataType: 'json',
                success: function(res) {
                    $('#titulo').text('Actualizar Municipio ' + res[0]['nombreMuni']) //Titulo del modal
                    $('#btn-save').text('Actualizar')
                    $("#AgregarMunicipios").modal("show"); //Mostrar modal

                    $('#selectPais').val(res[0]['idPais'])
                    pais = $('#selectPais').val()
                    idDpto = res[0]['idDpto']
                    obtenerDepartamentos(pais, idDpto) //Funcion para mostrar el select dinamico segun el municipio seleccionado
                    $('#nombre').val(res[0]['nombreMuni'])
                    $('#tp').val(2)
                    $('#id').val(res[0]['id'])
                }
            })
        } else {
            $('#tp').val(1)
            $('#titulo').text('Agregar Municipio')
            $('#btn-save').text('Guardar')
            $('#selectPais').val('')
            obtenerDepartamentos(0, 0)
            $('#nombre').val('')
        }
    }

    $('#eliminarMuni').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'))
    })
</script>