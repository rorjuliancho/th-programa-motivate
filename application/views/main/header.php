<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Programa Motivate</title>

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="<?= base_url() ?>public/css/styles.css">
</head>

<body class="login">
    <?php $mainUrl = $this->uri->segment(1); ?>
    <?php if ($mainUrl != '') { ?>

        <nav class="navbar navbar-expand-lg bg-motivate navbar-light justify-content-between">
            <a class="navbar-brand" href="<?= base_url() ?>welcome/main"><img class="img-fluid-logo" src="<?= base_url() ?>public/images/logo.png" alt="Logo Motivate"></a>
            <ul class="navbar-nav ms-auto mb-lg-0 mr-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <img src="<?= base_url() ?>public/images/profile.png" class="img-fluid" alt="">
                        <strong> <?= $mensajeBienvenida ?>, <?= $nombre ?></strong>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= base_url() ?>Welcome/logout"><i class="fas fa fa-power-off "></i> <small>Cerrar Sesión</small></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    <?php } else { ?>
    <?php } ?>