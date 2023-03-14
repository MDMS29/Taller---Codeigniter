$(document).ready(function(){
    //CAMBIO DINAMICO SELECT PAISES
    $('#selectPais').on('change', () => {
        pais = $('#selectPais').val()
        $.ajax({
            url: baseUrl+'municipios/obtenerDepartamentosPais/'+pais,
            type: 'POST',
            dataType : 'json',
            success : function(res){
                var cadena
                cadena = `<option selected>-- Seleccionar Departamento --</option>`
                for(let i = 0; i < res.length; i++){
                    cadena += `<option value='${res[i].id}'>${res[i].nombre}</option>`
                }
                cadena += `</select>`
                $('#departamento').html(cadena)
            }
        })
    })
});
