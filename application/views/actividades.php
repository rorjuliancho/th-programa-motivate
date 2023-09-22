<?php if ($this->session->userdata('tipoUsuario') == "Admin") { ?>
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
                                    <td><img src="<?= base_url() ?>public/images/actividades/<?= $actividad->imagen ?>"></td>
                                    <th scope="row"><?= $actividad->idactividades ?></th>
                                    <td><?= $actividad->nombre ?></td>
                                    <td><a href="#" class="stretched-link">Ver </a><a href="#" class="stretched-link">Editar </a><a href="#" class="stretched-link">Eliminar</a></td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ingrese los de la actividad:</h5>
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