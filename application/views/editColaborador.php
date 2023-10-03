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
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-1 pl-2"><img src="<?= base_url() ?>public/images/actividades/<?= $colab->imagen ?>" alt=""> </div>
                                <div class="col-6 pr-3 my-auto"><strong> <?= $colab->nombre_actividad ?></strong></div>
                                <div class="col-2 my-auto"><strong> <?= $colab->puntuacion ? $colab->puntuacion : '-' ?></strong></div>
                                <div class="col-3 my-auto">
                                    <a class="btn btn-primary  btn-sm" data-toggle="modal" data-target="#exampleModalCreate<?= $colab->idActividades ?>" href="" class="stretched-link"><i class="fas fa fa-plus"></i> </a>
                                    <a class="btn btn-warning btn-sm" href="<?= base_url() ?>Welcome/editarActividad/<?= $colab->idcolaborador ?>/<?= $colab->idActividades ?>" class="stretched-link"><i class="fas fa fa-edit"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModalCreate<?= $colab->idActividades ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Asignar puntaje - <?= $colab->nombre_actividad ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url() ?>Welcome/agregarPuntajeColaborador" method="POST">
                                <div class="form-row">
                                    <input type="text" hidden value="<?= $colab->idActividades  ?>" name="idCActividad">
                                    <input type="text" hidden value="<?= $colab->idcolaborador ?>" name="idColaborador">

                                    <div class="form-group col-12">
                                        <label for="inputEmail4">Nombre Actividad</label>
                                        <input type="text" name="nombraActividad" required class="form-control" id="inputEmail4" placeholder="Nombre Actividad">
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="inputEmail4">Puntaje</label>
                                        <input type="number" name="puntajeActividad" required class="form-control" id="inputEmail4" placeholder="Puntaje">
                                    </div>

                                    <div class="form-group col-12">
                                        <label for="inputEmail4">Observaciones</label>
                                        <textarea type="text" name="observacionesActividad" class="form-control" id="inputEmail4" placeholder="Algún tipo de novedad"></textarea>
                                    </div>

                                    <div class="form-group col-12 text-center">
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>