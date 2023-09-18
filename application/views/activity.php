<?php if ($this->session->userdata('logueado') == TRUE) { ?>
    <div class="container-fluid activity-panel">
        <div class="row">
            <?php if ($nombreActividad) { ?>
                <?php foreach ($nombreActividad as $a) { ?>
                    <h3><strong><?= $a->nombre ?></strong></h3>
                    <p><?= $a->descripcion ?></p>
                    <?php if (is_null($a->qr)) { ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-hover table-bordered text-center" id="table_activity">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Nombre Capacitacion</th>
                                                <th>Fecha</th>
                                                <th>Puntuacion</th>
                                                <th>Observaciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($detalleActividad) { ?>
                                                <?php foreach ($detalleActividad as $a) { ?>
                                                    <tr>
                                                        <td><?= $a->nombreActividad ?></td>
                                                        <td><?= $a->fechaCreacion ?></td>
                                                        <td><?= $a->puntos ?></td>
                                                        <td><?= $a->observaciones ?></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-9 col-md-12 col-sm-12 p-2">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-hover table-bordered text-center" id="table_activity">
                                        <thead class="thead-dark text-center">
                                            <tr>
                                                <th>Nombre Capacitacion</th>
                                                <th>Fecha</th>
                                                <th>Puntuacion</th>
                                                <th>Observaciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($detalleActividad) { ?>
                                                <?php foreach ($detalleActividad as $a) { ?>
                                                    <tr>
                                                        <td><?= $a->nombreActividad ?></td>
                                                        <td><?= $a->fechaCreacion ?></td>
                                                        <td><?= $a->puntos ?></td>
                                                        <td><?= $a->observaciones ?></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 my-auto text-center my-auto">
                            <div class="card p-4">
                                <div class="card-body">
                                    <img src="<?= base_url() ?>public/images/qr/<?= $a->qr ?>" alt="">

                                    <p class="p-2 text-center"><?= $a->mensajeQr ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
<?php } else { ?>
    <?php redirect('Welcome/logout') ?>
<?php } ?>