<?php
function generarCodigo($longitud)
{
    $key = '';
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyz_ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $max = strlen($pattern) - 1;
    for ($i = 0; $i < $longitud; $i++) $key .= $pattern[mt_rand(0, $max)];
    return $key;
}

function enviarCodeActi($correo, $activacion)
{
    $email = \Config\Services::email();
    $data['respuesta'] = '';

    $array  = array(
        'correo' => $correo,
        'activacion' => $activacion,
        'base_url' => base_url()
    );

    $email->setFrom('senamalamboadso1@gmail.com', 'COMPANY');
    $email->setTo($correo);
    $email->setSubject('Activar cuenta de la compañia');
    $html = view('usuarios/htmlMensaje', $array);
    $email->setMessage($html);
    if ($email->send()) {
        $data['respuesta'] = 'si';
    } else {
        $data['respuesta'] = 'no';
        $data['msj'] = $email->printDebugger(['headers']);
    }

    return $data;
}
function datosLogin(){
    return $dataUser = [
        "id" => session('id'),
        'nombres' => session('nombres'),
        'apellidos' => session('apellidos'),
        'rol' => session('rol')
    ];
}
