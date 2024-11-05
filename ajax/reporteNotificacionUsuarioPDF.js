$(document).ready(function () {
    $(document).off('click', '#notificacionPorUsuario').on('click', '#notificacionPorUsuario', function (e) {
        e.preventDefault();

        let usuario=window.usuarioPerfil;
        let persona=window.usuarioPersona;
        let tipoPersona=window.usuarioTipoPersona;
        let idCasilla = window.usuarioidCasilla;
        let idMovimiento = $(this).data('idmovimiento');
        // console.log(idMovimiento);
        // console.log(idCasilla);
        if (idCasilla.length == 0 || !idCasilla) {
            idCasilla = null;
        }
        if (idMovimiento.length == 0 || !idMovimiento) {
            idMovimiento = null;
        }
        // Abrir una nueva ventana en blanco
        var newTab = window.open();

        $.ajax({
            url: "./controllers/reports/notificacionPorUsuario.php",
            type: "POST",
            data: { idCasilla,idMovimiento,usuario,persona,tipoPersona},
            xhrFields: {
                responseType: 'blob'
            },
            success: function (blob) {
                // console.log('Blob recibido:', blob.type);  // Verificar si el blob llega correctamente
                // return 
                // console.log(blob);
                // return
                var url = window.URL.createObjectURL(blob);

                // Asignar el URL del blob a la nueva pestaña
                newTab.location.href = url;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
                newTab.close();
            }
        });



    });
});