<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <link href="<?= base_url(); ?>assets/bootstrap-5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/principal.css">
    <link rel="icon" href="<?= base_url(); ?>assets/img/logoEmpresa.png">
    <title><?= $titulo ?></title>

    <!-- SCRIPTS GLOBALES -->
    <script src="<?= base_url(); ?>assets/bootstrap-5/dist/js/bootstrap.bundle.min.js"></script>
    <script script src="<?php echo base_url(); ?>assets/jQuery/jquery-3.6.0.js"></script> 
</head>

<header>
    <a class="logo-empresa" href="<?= base_url() ?>">
        <img src="assets/img/logoEmpresa.png" alt="logo empresa">
    </a>
    <div class="info-page ">
        <h1 class="m-0">
            <?= $titulo ?>
        </h1>
        <h3>
            <?= $nombre ?>
        </h3>
    </div>
    <a class="logo-sena" href="http://oferta.senasofiaplus.edu.co/sofia-oferta/" target="_blank">
        <img src="<?= base_url(); ?>assets/img/logoSenaBlanco.png" alt="logo sena">
    </a>
</header>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item hover:dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Ubicación
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>paises">Paises</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>departamentos">Departamentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>municipios">Municipios</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url() ?>cargos">Cargos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Empleados
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>empleados">Administrar</a>
                        </li>
                    </ul>
                </li>


            </ul>
        </div>
    </div>
</nav>