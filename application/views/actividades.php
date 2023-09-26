<?php if ($this->session->userdata('tipoUsuario') == "Admin") { ?>

    <div class="modal fade" id="modalVer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Actividad:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php foreach ($detalleActividad as $da) { ?>
                        <?php var_dump($da) ?>
                        <ol class="list-group list-group-numbered">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Nombre de la actividad:</div>
                                    <input class="form-control" type="text" value="<?= $da->nombre ?>">
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Imagen</div>
                                    <input type="file" class="form-control-file" name="imagen">
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Descripción</div>
                                    <textarea rows="7" cols="50" class="form-control" type="text"><?= $da->descripcion ?></textarea>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">QR</div>
                                    <input type="file" class="form-control-file" name="qr">
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Mensaje QR:</div>
                                    <textarea rows="2" cols="50" class="form-control" type="text"><?= $da->mensajeQr ?></textarea>
                                </div>
                            </li>
                        </ol>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-lg-6 my-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Crear actividades
                </button>
            </div>
            <div class="col-lg-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Imagen</th>
                            <th scope="col">Id Actividades</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($todasActividades) { ?>
                            <?php foreach ($todasActividades as $actividad) { ?>
                                <tr>
                                    <td><img style="width: 3em; height: 3em;" class="img-fluid" src="<?= base_url() ?>public/images/actividades/<?= $actividad->imagen ?>"></td>
                                    <th scope="row"><?= $actividad->idactividades ?></th>
                                    <td><?= $actividad->nombre ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>Welcome/editarActividades/<?= $actividad->idactividades?>">Editar</a>
                                         <!--<a href="#" class="stretched-link" data-toggle="modal" data-target="#modalVer">Editar </a><a href="#" class="stretched-link">Eliminar</a> -->
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
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



<?php } else { ?>
    <?php redirect('welcome/logout'); ?>
<?php } ?>