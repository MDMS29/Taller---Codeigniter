<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link href="<?= base_url(); ?>assets/bootstrap-5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/principal.css">
    <link rel="icon" href="<?= base_url(); ?>assets/img/logoEmpresa.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;400;900&display=swap" rel="stylesheet">

    <!-- SCRIPTS GLOBALES -->
    <script src="<?php echo base_url('assets/jQuery/jquery-3.6.4.min.js') ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>
        <?= $titulo ?>
    </title>
</head>

<body class="container-lg d-flex align-items-center justify-content-center ">
    <form class="login" method="POST" action="<?php echo base_url('login'); ?>" id="formularioLogin">
        <div class="border  border-black rounded-top p-4">
            <h2 class="text-center"><?= $titulo ?></h2>
            <?php if ($error != ' ') { ?>
                <small class="invalido"><?= $error ?></small>
            <?php } ?>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Email:</label>
                <input type="email" name="user" class="form-control" id="user" placeholder="Ej: sñr@correo.com">
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Contraseña:</label>
                <input type="password" name="pass" class="form-control" id="pass" placeholder="Ej: xxxxxxxx">
            </div>
        </div>
        <button type="submit" class="p-2 text-uppercase btn-login" id="btnGuardar">Ingresar</button>
    </form>
</body>

</html>

<script type="text/javascript">
    $('#formularioLogin').on('submit', function(e) {
        usuario = $('#user').val()
        contrasena = $('#pass').val()
        if ([usuario, contrasena].includes('')) {
            e.preventDefault()
            return Swal.fire({
                position: 'center',
                icon: 'error',
                title: '¡Debe llenar todos los campos!',
                showConfirmButton: false,
                timer: 1500
            })
        }
    })
</script>