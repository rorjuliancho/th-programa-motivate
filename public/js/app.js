$(document).ready(function () {
    $('#table_activity').DataTable({
        pageLength: 5
    });

    $('#table-colaboradores').DataTable({

    });

    $('#table-actividades').DataTable({

    });

    $('.eliminar-actividad').on('click', function () {
        var idActividad = $(this).data('id');
        $('#modalEliminar').data('id', idActividad); // Almacena el ID en el modal
    });

    $('#modalEliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que abrió el modal
        var idActividad = $(this).data('id'); // Obtiene el ID almacenado en el modal

        // Agrega el ID al botón de confirmación del modal
        $('#confirmarEliminar').attr('href', '<?= base_url() ?>Welcome/cambiarEstadoActividad/' + idActividad);
    });


    $('.eliminar-colaborador').on('click', function () {
        var idColaborador = $(this).data('id');
        $('#modalEliminarColaborador').data('id', idColaborador);
    });

    $('#modalEliminarColaborador').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que abrió el modal
        var idColaborador = $(this).data('id'); // Obtiene el ID almacenado en el modal
        // Agrega el ID al botón de confirmación del modal
        $('#confirmarEliminarColaborador').attr('href', 'deleteColaborador/' + idColaborador);
    });



});

