<div class="container-fluid">
    <div class="row">
        <?php foreach ($traerColaboradores as $tColab) { ?>
            <div class="col-lg-4 col-md-4 col-sm-12 p-2">
                <a href="<?= base_url() ?>Welcome/admin" class="btn btn-danger"><i class="fas fa fa-rotate-left"> </i> Regresar</a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 p-2">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 p-2">
                <div class="card">
                    <div class="card-body border border-primary rounded">
                        <?= $tColab->nombre ?> <?= $tColab->apellido ?> -
                        <?php if ($tColab->nombre_empresa == 'bps') { ?>
                            <span><strong>BPSMART</strong></span>
                        <?php } else { ?>
                            <?php strtoupper($tColab->nombre_empresa); ?>
                        <?php } ?>


                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <?php foreach ($puntajeColaborador as $colab) { ?>
            <div class="col-lg-4 col-md-4 col-sm-12 p-2">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-2"><img src="<?= base_url() ?>public/images/actividades/<?= $colab->imagen ?>" alt=""> </div>
                                <div class="col-8 my-auto"><strong> <?= $colab->nombre ?></strong></div>
                                <div class="col-2 my-auto"><strong> <?= $colab->puntuacion ? $colab->puntuacion : '-' ?></strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>