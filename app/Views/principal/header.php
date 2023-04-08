<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <link href="<?= base_url(); ?>assets/bootstrap-5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/principal.css">
    <link rel="icon" href="<?= base_url(); ?>assets/img/logoEmpresa.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;400;900&display=swap" rel="stylesheet">
    <title>
        <?= $titulo ?>
    </title>



    <!-- SCRIPTS GLOBALES -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->
    <script src="<?= base_url(); ?>assets/bootstrap-5/dist/js/bootstrap.bundle.min.js"></script>
    <script script src="<?php echo base_url(); ?>assets/jQuery/jquery-3.6.0.js"></script>
</head>

<header>
    <a class="logo-empresa" href="<?= base_url() ?>home">
        <img src="<?= base_url(); ?>assets/img/logoEmpresa.png" alt="logo empresa">
    </a>
    <div class="info-page ">
        <h1 class="m-0">
            <?= $titulo ?>
        </h1>
        <h3>
            <?= $dataUser['nombres'] . ' ' . $dataUser['apellidos'] . ' - ' . $dataUser['rol']?>
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
        <div class="collapse navbar-collapse flex justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item hover:dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-geo-alt-fill"></i> Ubicación
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item dropdown-item">
                            <a class="nav-link active " aria-current="page" href="<?= base_url() ?>paises">Países</a>
                        </li>
                        <li class="nav-item dropdown-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>departamentos">Departamentos</a>
                        </li>
                        <li class="nav-item dropdown-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>municipios">Municipios</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold" aria-current="page" href="<?= base_url() ?>cargos"><i class="bi bi-person-badge-fill"></i> Cargos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-people-fill"></i> Administrar
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item dropdown-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>empleados">Empleados</a>
                        </li>
                        <li class="nav-item dropdown-item">
                            <a class="nav-link active" aria-current="page" href="<?= base_url() ?>usuarios">Usuarios</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link fw-semibold" aria-current="page" href="<?= base_url() ?>usuarios/cerrarSesion"><i class="bi bi-building-fill-slash"></i> Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>