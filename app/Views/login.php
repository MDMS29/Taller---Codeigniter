<!DOCTYPE html>
<html lang="en">

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
</head>

<body class="container-lg d-flex align-items-center justify-content-center login">
    <form method="POST" action="<?php echo base_url('login'); ?>" class=" ">
        <div class="border  border-black rounded-top p-4">
            <h2 class="text-center"><?= $titulo ?></h2>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Email:</label>
                <input type="email" name="user" class="form-control" id="user" placeholder="Ej: sñr@correo.com" required>
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Contraseña:</label>
                <input type="password" name="pass" class="form-control" id="pass" placeholder="Ej: xxxxxxxx" required>
            </div>
        </div>
        <button type="submit" class="p-2 text-uppercase btn-login" id="btnGuardar">Ingresar</button>
    </form>
</body>

</html>