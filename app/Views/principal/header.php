<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <link href="<?php echo base_url(); ?>assets/bootstrap-5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php base_url(); ?>assets/css/principal.css">
    <link rel="icon" href="<?php base_url(); ?>assets/img/logoEmpresa.png">
    <title><?php echo $titulo ?></title>
</head>

<header>
    <div class="logo-empresa">
        <img src="assets/img/logoEmpresa.png" alt="logo empresa">
    </div>
    <div class="info-page">
        <h1>
            <?php echo $titulo ?>
        </h1>
        <h3>
            <?php echo $nombre ?>
        </h3>
    </div>
    <div class="logo-sena">
        <img src="<?php base_url(); ?>assets/img/logoSenaBlanco.png" alt="logo sena">
    </div>
</header>
