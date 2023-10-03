<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table class="table table-striped" id="table-colaboradores">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre Actividad</th>
                                <th scope="col">Observaciones</th>
                                <th scope="col">Puntos</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($actividadColaborador) { ?>
                                <?php foreach ($actividadColaborador as $colab) { ?>

                                    <tr>
                                        <th scope="row"><?= $colab->idpuntuacion ?></th>
                                        <td><?= $colab->nombreActividad ? $colab->nombreActividad : '-'  ?></td>
                                        <td><?= $colab->observaciones ? $colab->observaciones : '-' ?></td>
                                        <td><?= $colab->puntos ?></td>
                                        <td>
                                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModalEdit<?= $colab->idpuntuacion ?>"> <i class="fas fa fa-edit"></i> </a>
                                            <a class="btn btn-danger btn-sm" href="<?= base_url() ?>Welcome/deleteColaborador/<?= $colab->idpuntuacion ?>"><i class="fas fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="exampleModalEdit<?= $colab->idpuntuacion ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Puntaje</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url() ?>Welcome/updateActividadColaborador" method="POST">
                                                        <div class="form-row">
                                                            <input type="text" hidden value="<?= $colab->idpuntuacion ?>" name="idPuntuacion">


                                                            <div class="form-group col-12">
                                                                <label for="inputEmail4">Nombre Actividad</label>
                                                                <textarea type="text" name="nombraActividad" required class="form-control"><?= $colab->nombreActividad ?></textarea>
                                                            </div>

                                                            <div class="form-group col-12">
                                                                <label for="inputEmail4">Puntaje</label>
                                                                <input type="number" name="puntajeActividad" required class="form-control" value="<?= $colab->puntos ?>">
                                                            </div>

                                                            <div class="form-group col-12">
                                                                <label for="inputEmail4">Observaciones</label>
                                                                <textarea type="text" name="observacionesActividad" class="form-control"><?= $colab->observaciones ?></textarea>
                                                            </div>

                                                            <div class="form-group col-12 text-center">
                                                                <button type="submit" class="btn btn-success">Actualizar</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>