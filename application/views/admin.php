<?php if ($this->session->userdata('tipoUsuario') == "Admin") { ?>
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-6 stretched-link">
                <a class="btn btn-warning" href="<?= base_url() ?>Welcome/actividades"><i class="fas fa fa-check-square-o"></i> Actividades</a>
            </div>
            <div class="col-6 pb-2 text-right stretched-link">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa fa-plus"></i> Crear colaboradores
                </button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCargaExcel">
                    <i class="fas fa fa-file-excel-o"></i> Cargar datos
                </button>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped" id="table-colaboradores">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Cedula</th>
                                    <th scope="col">Empresa</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($todosColaboradores) { ?>
                                    <?php foreach ($todosColaboradores as $colab) { ?>
                                        <tr>
                                            <th scope="row"><?= $colab->idcolaborador ?></th>
                                            <td><?= $colab->nombrecolab ?></td>
                                            <td><?= $colab->apellido ?></td>
                                            <td><?= $colab->cedula ?></td>
                                            <td><?= $colab->nombreempresa ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="<?= base_url() ?>Welcome/viewColaborador/<?= $colab->idcolaborador ?>" class="stretched-link"> <i class="fas fa fa-eye"></i> </a>
                                                <a class="btn btn-success btn-sm" href="<?= base_url() ?>Welcome/editColaborador/<?= $colab->idcolaborador ?>" class="stretched-link"> <i class="fas fa fa-edit"></i> </a>
                                                <a class="btn btn-danger btn-sm eliminar-colaborador" href="#" data-id="<?= $colab->idcolaborador ?>" data-toggle="modal" data-target="#modalEliminarColaborador"> <i class="fas fa fa-trash"></i></a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Ingrese los datos del colaborador:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url('Welcome/guardar_colaborador'); ?>">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Ingrese nombre">
                        </div>
                        <div class="form-group">
                            <label>Apellido:</label>
                            <input type="text" class="form-control" name="apellido" placeholder="Ingrese apellido">
                        </div>
                        <div class="form-group">
                            <label>Cédula:</label>
                            <input type="number" class="form-control" name="cedula" placeholder="Ingrese cédula">
                        </div>
                        <div class="form-group">
                            <label>Fecha de ingreso:</label>
                            <input type="date" class="form-control" name="fechaIngreso" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Cargo:</label>
                            <input type="text" class="form-control" name="cargo" placeholder="Ingrese el cargo">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Correo electrónico:</label>
                            <input type="email" class="form-control" name="correoElectronico" placeholder="Ingrese correo electrónico">
                        </div>
                        <div>
                            <label>Empresa:</label>
                            <select name="id_empresa" class="custom-select">
                                <option selected>Selecciona una empresa</option>
                                <?php foreach ($todasEmpresas as $empresas) { ?>
                                    <option value="<?= $empresas->idempresa ?>"><?= $empresas->nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <br>
                        <div>
                            <label>Tipo de usuario:</label>
                            <select name="tipoUsuario" class="custom-select">
                                <option selected>Selecciona el tipo de usuario:</option>
                                <option value="Admin">Admin</option>
                                <option value="Colaborador">Colaborador</option>
                            </select>
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
    <div class="modal fade" id="modalCargaExcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel">Cargar datos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url('Welcome/guardar_datos'); ?>" enctype="multipart/form-data">
                        <div class="outer-container">
                            <div class="my-3">
                                <label>Elija el archivo de Excel</label>
                                <input type="file" name="file" id="file" accept=".xls,.xlsx">
                            </div>
                        </div>
                        <div id="response" class="<?php if (!empty($type)) {
                                                        echo $type . " display-block";
                                                    } ?>">
                            <?php if (!empty($message)) {
                                echo $message;
                            } ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Cargar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalEliminarColaborador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> ¿Estás seguro de eliminar este colaborador?
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" data-dismiss="modal" style="color: white;">Cerrar</a>
                    <a type="button" id="confirmarEliminarColaborador" class="btn btn-primary">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <?php redirect('welcome/logout'); ?>
<?php } ?>