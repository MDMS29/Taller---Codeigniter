$(document).ready(function () {
    function listarEmpleados(e) {
        e.preventDefault();
        $.ajax({
            url: baseUrl + 'ver-empleados',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            type: 'POST',
        }).done(function (res) {
            data = JSON.parse(res);
            // alert(data)
        })
    }
    listarEmpleados()
});