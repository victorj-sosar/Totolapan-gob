'use strict';
$(document).ready(function () {
    $(".dropdown-menu").children(".dropdown-item").click(function (e) {
        $(this).children(".ssbmenu").slideToggle();
        e.stopPropagation();
    });
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = $('.needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            $(form).addClass('was-validated');
        }, false);
    });
    // cierra la alerta despues de 5 segundos
    setTimeout(() => {
        $(".alert").alert('close');
    }, 5000);
    $('.delete').click(function () { 
        var id = $(this).children('input').val();
        var table = $(this).children('span').text();

        if (confirm(`¿Realmente desea eliminar este elemento de la tabla ${table}?`)) {
            $.ajax({
                type: "POST",
                url: "eliminar.php",
                data: {
                    id: id,
                    table: table
                },
                success: function (response) {
                    $('#alertas').html(response)
                    setTimeout(() => {
                        location.href = "dashboard-consulta.php"; 
                    }, 3000);
                }
            });
        }
    });

    $('.edit').click(function () {
        var id = $(this).children('input').val();
        var table = $(this).children('span').text();
            $.ajax({
                type: "POST",
                url: "editar.php",
                data: {
                    id: id,
                    table: table
                },
                success: function (response) {
                    if (table == 'usuarios') {
                        $('#Uid').val(id);
                        $('#Uuser').val(response.user);
                        $('#Utipo').val(response.tipo);
                    }
                    if (table=='slider') {
                        $('#Sid').val(id);
                        $('#Stitulo').val(response.titulo);
                        $('#SDimagen').attr('src', `./../img/slider/${response.imagen}`);
                        $('#Sdescripcion').val(response.descripcion);
                    }
                    if (table == 'eventos') {
                        $('#Evid').val(id);
                        $('#Evtitulo').val(response.titulo);
                        $('#Evfecha').val(response.fecha);
                        $('#EDimagen').attr('src', `./../img/events/${response.imagen}`);
                        $('#Evdescripcion').val(response.descripcion);
                    }
                    if (table == 'convocatorias') {
                        $('#Cid').val(id);
                        $('#Ctitulo').val(response.titulo);
                        $('#Cfecha').val(response.fecha);
                        $('#CDimagen').attr('src', `./../img/announce/${response.imagen}`);
                        $('#Cfile').val(response.archivo);
                        $('#Cdescripcion').val(response.descripcion);
                    }
                }
            });
    });
});
