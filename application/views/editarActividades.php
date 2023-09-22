<?php foreach ($detalleActividad as $da) { ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form method="POST" action="<?= base_url() ?>Welcome/cambiosActividad" enctype="multipart/form-data">
                    <input type="text" name="idActividad" hidden value="<?= $da->idactividades ?>">
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">Nombre de la actividad:</div>
                                <input class="form-control" name="nombreActividad" type="text" value="<?= $da->nombre ?>">
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
                                <textarea rows="5" cols="110" name="descripcion" class="form-control" type="text"><?= $da->descripcion ?></textarea>
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
                                <textarea rows="2" name="mensajeQr" cols="110" class="form-control" type="text"><?= $da->mensajeQr ?></textarea>
                            </div>
                        </li>
                    </ol>
                    <div class="container">
                        <div class="row text-center p-3">
                            <div class="col-6">
                                <a class="btn btn-primary" href="<?= base_url() ?>welcome/actividades/">Regresar</a>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-success" type="submit">Guardar cambios</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

<?php } ?>