<?php if ($this->session->userdata('tipoUsuario') == "Admin") { ?>
    <div class="container">
        <div class="row">
            <div class="col-6 pb-2">
                <a class="btn btn-danger" href="<?= base_url() ?>Welcome/admin"><i class="fas fa fa-arrow-left"></i> Regresar</a>
            </div>
            <div class="col-6 text-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa fa-plus"></i> Crear actividades
                </button>
            </div>
            <div class="col-lg-12 pb-5">
                <div class="card ">
                    <div class="card-body">
                        <table class="table table-striped" id="table-actividades">
                            <thead>
                                <tr>
                                    <th scope="col">Imagen</th>
                                    <th scope="col">Id Actividades</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <?php if ($todasActividades) { ?>
                                    <?php foreach ($todasActividades as $actividad) { ?>
                                        <tr>
                                            <td><img style="width: 3em; height: 3em;" class="img-fluid" src="<?= base_url() ?>public/images/actividades/<?= $actividad->imagen ?>"></td>
                                            <th scope="row"><?= $actividad->idactividades ?></th>
                                            <td><?= $actividad->nombre ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="<?= base_url() ?>Welcome/editarActividades/<?= $actividad->idactividades ?>"><i class="fas fa fa-edit"></i></a>
                                                <a class="btn btn-danger btn-sm" href="#" class="eliminar-actividad" data-id="<?= $actividad->idactividades ?>" data-toggle="modal" data-target="#modalEliminar"> <i class="fas fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingrese los datos de la actividad:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url('Welcome/guardar_actividad'); ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre de la actividad">
                        </div>
                        <div class="form-group">
                            <label>Imagen:</label>
                            <input type="file" class="form-control-file" name="imagen">
                        </div>
                        <div class="form-group">
                            <label>Descripción:</label>
                            <input type="text" class="form-control" name="descripcion" placeholder="Ingrese la descripción de la actividad">
                        </div>
                        <div class="form-group">
                            <label>Código QR:</label>
                            <input type="file" class="form-control-file" name="qr">
                        </div>
                        <div class="form-group">
                            <label>Mensaje del código QR:</label>
                            <input type="text" class="form-control" name="mensajeqr" placeholder="Ingrese el mensaje del QR">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> ¿Estás seguro de eliminar esta actividad?
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" data-dismiss="modal" style="color: white;">Cerrar</a>
                    <a type="button" id="confirmarEliminar" class="btn btn-primary">Eliminar</a>
                </div>
            </div>
        </div>
    </div>


<?php } else { ?>
    <?php redirect('welcome/logout'); ?>
<?php } ?>