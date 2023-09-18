<?php if ($this->session->userdata('logueado') == TRUE) { ?>
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 mt-4">
                <h3 class="nombre_usuario">Bienvenid@ <?= $this->session->userdata('nombre') ?> <?= $this->session->userdata('apellido') ?></h3>
                <p> <?php date_default_timezone_set("America/Bogota") ?>
                    <?= date('d-m-Y') ?>
                </p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-4 text-center my-auto">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-puntos puntos parpadea" data-toggle="modal" data-target="#exampleModalPuntuacion">
                    <?php if ($puntuacion) { ?>
                        <?php foreach ($puntuacion as $a) { ?>
                            <img class="img-fluid" src="<?= base_url() ?>public/images/icons/start.png" alt=""> <strong> <?= $a->puntuacion ?> Puntos</strong>
                        <?php } ?>
                    <?php } ?>
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 p-4">
                <h3><strong>Clasificación</strong></h3>
            </div>
        </div>
        <div class="row visibleDesktop">
            <?php if ($top) { ?>
                <?php
                $posicion = 1;
                foreach ($top as $t) { ?>

                    <div class="col-lg-2 col-md-2 col-sm-12 mb-2 ml-especial-score">
                        <div class="card">
                            <?php if ($posicion == 1) { ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-4 p-2">
                                            <img src="<?= base_url() ?>public/images/icons/1.png" alt="" class="img-fluid">
                                        </div>

                                        <div class="col-8 p-2 my-auto">
                                            <h5 class="card-title">
                                                <?php $nombre = explode(' ', $t->nombre); ?>
                                                <?php $primernombre = $nombre[0] ?>
                                                <?php $apellido = explode(' ', $t->apellido); ?>
                                                <?php $primerapellido = $apellido[0] ?>
                                                <h5><?= $primernombre ?> <br> <?= $primerapellido ?></h5>
                                                <h6 class="card-text">Puntos: <strong><?= $t->puntuacion ?></strong></h6>
                                        </div>

                                    </div>
                                </div>

                            <?php } else if ($posicion == 2) { ?>


                                <div class="container">
                                    <div class="row">
                                        <div class="col-4 p-2">
                                            <img src="<?= base_url() ?>public/images/icons/2.png" alt="" class="img-fluid">
                                        </div>

                                        <div class="col-8 p-2 my-auto">
                                            <?php $nombre = explode(' ', $t->nombre); ?>
                                            <?php $primernombre = $nombre[0] ?>
                                            <?php $apellido = explode(' ', $t->apellido); ?>
                                            <?php $primerapellido = $apellido[0] ?>
                                            <h5> <?= $primernombre ?> <br> <?= $primerapellido ?></h5>
                                            <h6 class="card-text">Puntos: <strong><?= $t->puntuacion ?></strong></h6>
                                        </div>

                                    </div>
                                </div>

                            <?php } else if ($posicion == 3) { ?>


                                <div class="container">
                                    <div class="row">
                                        <div class="col-4 p-2">
                                            <img src="<?= base_url() ?>public/images/icons/3.png" alt="" class="img-fluid">
                                        </div>

                                        <div class="col-8 p-2 my-auto">
                                            <?php $nombre = explode(' ', $t->nombre); ?>
                                            <?php $primernombre = $nombre[0] ?>
                                            <?php $apellido = explode(' ', $t->apellido); ?>
                                            <?php $primerapellido = $apellido[0] ?>
                                            <h5><?= $primernombre ?> <br> <?= $primerapellido ?></h5>
                                            <h6 class="card-text">Puntos: <strong><?= $t->puntuacion ?></strong></h6>
                                        </div>

                                    </div>
                                </div>
                            <?php } else if ($posicion == 4) { ?>

                                <div class="container">
                                    <div class="row">
                                        <div class="col-4 p-2">
                                            <img src="<?= base_url() ?>public/images/icons/4.png" alt="" class="img-fluid">
                                        </div>

                                        <div class="col-8 p-2 my-auto">
                                            <?php $nombre = explode(' ', $t->nombre); ?>
                                            <?php $primernombre = $nombre[0] ?>
                                            <?php $apellido = explode(' ', $t->apellido); ?>
                                            <?php $primerapellido = $apellido[0] ?>
                                            <h5><?= $primernombre ?> <br> <?= $primerapellido ?></h5>
                                            <h6 class="card-text">Puntos: <strong><?= $t->puntuacion ?></strong></h6>
                                        </div>

                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-4 p-2">
                                            <img src="<?= base_url() ?>public/images/icons/5.png" alt="" class="img-fluid">
                                        </div>

                                        <div class="col-8 p-2 my-auto">
                                            <?php $nombre = explode(' ', $t->nombre); ?>
                                            <?php $primernombre = $nombre[0] ?>
                                            <?php $apellido = explode(' ', $t->apellido); ?>
                                            <?php $primerapellido = $apellido[0] ?>
                                            <h5><?= $primernombre ?> <br> <?= $primerapellido ?></h5>
                                            <h6 class="card-text">Puntos: <strong><?= $t->puntuacion ?></strong></h6>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php $posicion++; ?>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="row visibleMobile">
            <div class="col-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php if ($top) { ?>
                            <?php
                            $posicion = 1;
                            foreach ($top as $t) { ?>
                                <?php if ($posicion == 1) { ?>
                                    <div class="carousel-item active">
                                    <?php } else { ?>
                                        <div class="carousel-item">
                                        <?php } ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row my-auto">
                                                        <div class="col-4 d-flex align-items-center justify-content-center">
                                                            <?php if ($posicion == 1) { ?>
                                                                <img class="w-50" src="<?= base_url() ?>public/images/icons/1.png" alt="" class="img-fluid">
                                                            <?php } else if ($posicion == 2) { ?>
                                                                <img class="w-50" src="<?= base_url() ?>public/images/icons/2.png" alt="" class="img-fluid">
                                                            <?php } else if ($posicion == 3) { ?>
                                                                <img class="w-50" src="<?= base_url() ?>public/images/icons/3.png" alt="" class="img-fluid">
                                                            <?php } else if ($posicion == 4) { ?>
                                                                <img class="w-50" src="<?= base_url() ?>public/images/icons/4.png" alt="" class="img-fluid">
                                                            <?php } else { ?>
                                                                <img class="w-50" src="<?= base_url() ?>public/images/icons/5.png" alt="" class="img-fluid">
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-8 pt-5">
                                                            <?php $nombre = explode(' ', $t->nombre); ?>
                                                            <?php $primernombre = $nombre[0] ?>
                                                            <?php $apellido = explode(' ', $t->apellido); ?>
                                                            <?php $primerapellido = $apellido[0] ?>
                                                            <h5><?= $primernombre ?> <?= $primerapellido ?></h5>
                                                            <h6 class="card-text">Puntos: <strong><?= $t->puntuacion ?></strong></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <?php $posicion++; ?>
                                    <?php } ?>
                                <?php } ?>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 p-4">
                    <h3><strong>Actividades</strong></h3>
                    <p>!Recuerda que debes asistir a todas las actividades¡</p>
                </div>
            </div>

            <div class="row">
                <?php if ($puntosColaborador) { ?>
                    <?php foreach ($puntosColaborador as $a) { ?>
                        <!--?php foreach ($actividades as $a) { ?-->
                        <div class="col-lg-2 col-md-6 col-sm-6 p-3  w-25 ">
                            <div class="card my-auto actividad">
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row  text-center">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <img src="<?= base_url() ?>public/images/actividades/<?= $a->imagen ?>" alt="Programa Motivate">
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 my-auto">
                                                <h5><?= $a->puntuacion ?> puntos</h5>
                                            </div>
                                        </div>

                                        <p><?= $a->nombre  ?></p>
                                        <a href="<?= base_url() ?>welcome/activity/<?= $a->idactividades ?>"> Ver Detalle > </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--?php } ?-->
                    <?php } ?>
                <?php } ?>
            </div>



            <!-- Modal -->
            <div class="modal fade" id="exampleModalPuntuacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><strong>Reglas Generales del Programa </strong></h5>

                        </div>
                        <div class="modal-body">
                            <div id="carouselExampleIndicatorsPuntuacion" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicatorsPuntuacion" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicatorsPuntuacion" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicatorsPuntuacion" data-slide-to="2"></li>
                                    <li data-target="#carouselExampleIndicatorsPuntuacion" data-slide-to="3"></li>
                                    <li data-target="#carouselExampleIndicatorsPuntuacion" data-slide-to="4"></li>
                                    <li data-target="#carouselExampleIndicatorsPuntuacion" data-slide-to="5"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active p-especial-modal">
                                        <ul>
                                            <li>
                                                Pueden participar todos los colaboradores que tengan contrato directo vigente con cualquiera de nuestras organizaciones.
                                            </li>
                                            <li>Los colaboradores que tengan llamados de atención, sanciones o incumplimientos al reglamento interno, podrán participar. Sin embargo, no podrán redimir los puntos al finalizar el periodo de premiación. </li>
                                            <li>Se realizarán dos premiaciones al año, una en cada semestre (Junio y Diciembre). </li>
                                            <li>Los puntos no pueden ser cedidos a ninguna otra persona y no se pueden acumular con los de otros periodos. </li>
                                            <li>Todos los puntos serán revisados y aprobados por la alta dirección antes de realizar la premiación. </li>
                                            <li>Se pueden otorgar puntos adicionales por la participación en actividades no programadas.</li>
                                        </ul>
                                    </div>

                                    <div class="carousel-item">
                                        <h5><strong>Premios a Otorgar</strong></h5>
                                        <p>En cada semestre, se premiara a los cinco colaboradores que obtuvieron mayores puntajes</p>
                                        <div class="container">
                                            <div class="row  pl-sanciones">
                                                <div class="col-6  my-auto">
                                                    <h4>Primer Puesto</h4>
                                                    <p>1 día de trabajo libre</p>
                                                </div>
                                                <div class="col-6 text-left">
                                                    <img class="img-fluid p-2" src="<?= base_url() ?>public/images/premiacion/primero.png" alt="">
                                                </div>

                                                <div class="col-6  my-auto">
                                                    <h4>Segundo Puesto</h4>
                                                    <p>1 día de trabajo libre</p>
                                                </div>

                                                <div class="col-6 ">
                                                    <img class="img-fluid  p-2" src="<?= base_url() ?>public/images/premiacion/segundo.png" alt="">
                                                </div>

                                                <div class="col-6 my-auto">
                                                    <h4>Tercer Puesto</h4>
                                                    <p>1 bono de Crepes & Waffles por $50.000 </p>
                                                </div>
                                                <div class="col-6">
                                                    <img class="img-fluid  p-2" src="<?= base_url() ?>public/images/premiacion/tercero.png" alt="">
                                                </div>

                                                <div class="col-6  my-auto">
                                                    <h4>Cuarto Puesto</h4>
                                                    <p>1 bono de Crepes & Waffles por $50.000 </p>
                                                </div>
                                                <div class="col-6">
                                                    <img class="img-fluid  p-2" src="<?= base_url() ?>public/images/premiacion/cuarto.png" alt="">
                                                </div>

                                                <div class="col-6  my-auto">
                                                    <h4>Quinto Puesto</h4>
                                                    <p> 1 canasta de frutas de $30.000 </p>
                                                </div>
                                                <div class="col-6">
                                                    <img class="img-fluid p-2" src="<?= base_url() ?>public/images/premiacion/quinto.png" alt="">
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="carousel-item">
                                        <h5><strong>Sanciones</strong></h5>
                                        <p>En caso de que la participación de un colaborador sea deficiente en el semestre (Inferior a 100 puntos), podrá recibir las siguientes amonestaciones.</p>
                                        <div class="container">
                                            <div class="row  pl-sanciones">
                                                <div class="col-6  my-auto">
                                                    <h4 class="text-100">100 puntos</h4>
                                                    <p>Llamado de atención verbal del líder y del área de SSTA</p>
                                                </div>
                                                <div class="col-6 text-left">
                                                    <img class="img-fluid" src="<?= base_url() ?>public/images/sanciones/100.png" alt="">
                                                </div>

                                                <div class="col-6  my-auto">
                                                    <h4 class="text-70">70 puntos</h4>
                                                    <p>Descargos</p>
                                                </div>
                                                <div class="col-6 ">
                                                    <img class="img-fluid" src="<?= base_url() ?>public/images/sanciones/70.png" alt="">
                                                </div>

                                                <div class="col-6 my-auto">
                                                    <h4 class="text-60">60 puntos</h4>
                                                    <p>Llamado de atención por escrito</p>
                                                </div>
                                                <div class="col-6">
                                                    <img class="img-fluid" src="<?= base_url() ?>public/images/sanciones/60.png" alt="">
                                                </div>

                                                <div class="col-6  my-auto">
                                                    <h4 class="text-40">40 puntos</h4>
                                                    <p>Sanción</p>
                                                </div>
                                                <div class="col-6">
                                                    <img class="img-fluid" src="<?= base_url() ?>public/images/sanciones/40.png" alt="">
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicatorsPuntuacion" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicatorsPuntuacion" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } else { ?>
        <?php redirect('Welcome/logout') ?>
    <?php } ?>