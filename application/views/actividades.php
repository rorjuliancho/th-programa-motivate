<?php if ($this->session->userdata('tipoUsuario') == "Admin") { ?>



    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('.eliminar-actividad').on('click', function() {
                var idActividad = $(this).data('id');
                $('#modalEliminar').data('id', idActividad); // Almacena el ID en el modal
            });

            $('#modalEliminar').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Botón que abrió el modal
                var idActividad = $(this).data('id'); // Obtiene el ID almacenado en el modal

                // Agrega el ID al botón de confirmación del modal
                $('#confirmarEliminar').attr('href', '<?= base_url() ?>Welcome/cambiarEstadoActividad/' + idActividad);
            });
        });
    </script>






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
                                        <a href="<?= base_url() ?>Welcome/editarActividades/<?= $actividad->idactividades ?>">Editar</a>
                                        <!-- <a href="<?= base_url() ?>Welcome/getIdDelete/<?= $actividad->idactividades ?>"> Eliminar</a> -->
                                        <a href="#" class="eliminar-actividad" data-id="<?= $actividad->idactividades ?>" data-toggle="modal" data-target="#modalEliminar"> Eliminar</a>
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