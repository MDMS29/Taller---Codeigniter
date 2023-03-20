<div class="my-4 container">
    <div class="card">
        <h5 class="card-header text-center">¡Ha ocurrido un error!</h5>
        <div class="card-body d-flex flex-column align-items-center">
            <p class="card-text m-0 text-center fw-semibold mb-4">
                <?php echo $msgError ?>
            </p>
            <a name="url" id="url" class="btn btn-primary fw-semibold text-white" href="<?php echo base_url($url); ?>" role="button">Volver a
                <span class="text-capitalize">
                    <?php echo $url; ?>
                </span></a>

        </div>
    </div>
</div>