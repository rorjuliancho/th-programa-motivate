<div class="container-fluid">
    <div class="row">
        <?php foreach ($traerColaboradores as $tColab) { ?>

            <div class="col-lg-4 col-md-4 col-sm-12 p-2">
                <a href="<?= base_url() ?>Welcome/admin" class="btn btn-danger"><i class="fas fa fa-rotate-left"> </i> Regresar</a>
            </div>


            <div class="col-lg-12 col-md-12 col-sm-12 p-2">
                <form action="<?= base_url() ?>Welcome/actualizarColaborador" method="POST" class="form-control p-4">
                    <input type="text" name="id" hidden value="<?= $tColab->idcolaborador ?>">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-3">
                                <label for="">
                                    <h6>Nombre</h6>
                                </label>
                                <input type="text" name="nombre" value="<?= $tColab->nombre ?>" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="">
                                    <h6>Apellido</h6>
                                </label>
                                <input type="text" name="apellido" value="<?= $tColab->apellido ?>" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="">
                                    <h6>Cedula</h6>
                                </label>
                                <input type="text" name="cedula" value="<?= $tColab->cedula ?>" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="">
                                    <h6>Fecha Ingreso</h6>
                                </label>
                                <?php if (empty($tColab->fechaIngreso)) { ?>
                                    <input type="date" name="fechaIngreso" value="" class="form-control">
                                <?php } else { ?>
                                    <input type="date" name="fechaIngreso" value="<?= date('Y-m-d', strtotime(str_replace('-', '/', $tColab->fechaIngreso))) ?>" class="form-control">
                                <?php } ?>

                            </div>
                            <div class="col-md-3 mt-3">
                                <label for="">
                                    <h6>Correo Electrónico</h6>
                                </label>
                                <input type="email" name="email" value="<?= $tColab->correoElectronico ?>" class="form-control">
                            </div>
                            <div class="col-md-3  mt-3">
                                <label for="">
                                    <h6>Cargo</h6>
                                </label>
                                <input type="text" name="cargo" value="<?= $tColab->cargo ?>" class="form-control">
                            </div>
                            <div class="col-md-3  mt-3">
                                <label for="">
                                    <h6>Empresa</h6>
                                </label>
                                <select name="empresa" class="form-control" id="">
                                    <?php foreach ($empresa as $e) { ?>
                                        <?php if ($e->idempresa == $tColab->id_empresa) { ?>
                                            <option selected value="<?= $e->idempresa ?>"><?= $e->nombre ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $e->idempresa ?>"><?= $e->nombre ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-success">Actualizar Información</button>
                    </center>

                </form>
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