$(document).ready(function () {
    console.log("INICIO DE MOVIMIENTOS.JS :D");
    const alturaPantalla = window.innerHeight;
    let registrosPorPagina = 0;

    if (alturaPantalla >= 1000) {
        registrosPorPagina = 12;
    } else if (alturaPantalla >= 900) {
        registrosPorPagina = 10;
    } else if (alturaPantalla >= 700) {
        registrosPorPagina = 7;
    } else {
        registrosPorPagina = 5;
    }


    let idCasilla = window.usuarioidCasilla;

    function loadInformacionMovimientosUsuarioNormal(idCasilla) {

        $.ajax({
            url: './controllers/Movimientos/informacionMovimientosUsuarioNormal.php',
            method: 'POST',
            dataType: 'json',
            data: { idCasilla },
            success: function (response) {
                // console.log(response);
                // return
                let { data } = response;
                if (data.length > 0 && Array.isArray(data)) {
                    let row = data.map(movimiento => `
                    <tr>
                        <td hidden>${movimiento.idMovimiento}</td>
                        <td>${movimiento.TipoDocumento}</td>
                        <td>${movimiento.NroDocumento}</td>
                        <td>${movimiento.ExtensionDocumento}</td>
                        <td>${movimiento.FechaNotificacion}</td>
                        <td hidden>${movimiento.FechaDocumento}</td>
                        <td hidden>${movimiento.EstadoDocumento}</td>
                        <td hidden>${movimiento.Sumilla}</td>
                        <td hidden>${movimiento.Area}</td>
                        <td hidden>${movimiento.Sede}</td>
                        <td><a href="#" id="btnDetalleNotificacionUsuarioNormal">Ver Detalle</a>&nbsp;&nbsp;<a id="notificacionPorUsuario" data-idmovimiento='${movimiento.idMovimiento}' href="">Imprimir</a></td>

                    </tr>`).join('');
                    $('#bodyListaMovimientosCasillas').html(row);
                } else {
                    let row = `<tr>
                        <td colSpan="10" className="mensajeSinRegistros">No hay notificaciones recibidas</td>
                    </tr>`
                    $('#bodyListaMovimientosCasillas').html(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }
    function loadTotalNotificacionesUsuarioNormal(idCasilla) {
        $.ajax({
            url: './controllers/Casillas/totalMovimientosNormal.php',
            method: 'GET',
            dataType: 'json',
            data: { idCasilla},
            success: function (response) {
                // console.log(response);
                // return 
                console.log(response);
                let totalMovimientosUsuarioNormalInput = document.getElementById("totalNotificacionesRecibidas");
                totalMovimientosUsuarioNormalInput.innerText = response[0].total;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }
    loadInformacionMovimientosUsuarioNormal(idCasilla);
    loadTotalNotificacionesUsuarioNormal(idCasilla);

// Detalles del Movimiento
$(document).on("click", "#btnDetalleNotificacionUsuarioNormal", function (e) {
    e.preventDefault();
    let fila = $(this).closest("tr");
    let idMovimiento = parseInt(fila.find('td:eq(0)').text());

    // Registrar lectura del documento
    registrarLecturaDocumento(idMovimiento);

    // Abrir el modal después de registrar la lectura
    abrirModal(fila);
});


// Detalles del Movimiento
$(document).on("click", "#btnDescargarDocumento", function (e) {
    e.preventDefault();
    let fila = $(this).closest("tr");
    let idMovimiento = $("#idMovimientoDocumentoUsuarioNormal").val();
    descargarDocumento(idMovimiento);

});

function cerrarModal(){
    // let modalEditar = $("#modalDetalleMovimientoUsuarioNormal");
    $('#modalDetalleMovimientoUsuarioNormal').modal('hide');
}

function abrirModal(fila) {
    let modalEditar = $("#modalDetalleMovimientoUsuarioNormal");
    let tipoDocumento = fila.find('td:eq(1)').text();
    let nroDocumento = fila.find('td:eq(2)').text();
    let documentoExtension = fila.find('td:eq(3)').text();
    let fechaNotificacion = fila.find('td:eq(4)').text();
    let fechaDocumento = fila.find('td:eq(5)').text();
    let sumillaDocumento = fila.find('td:eq(7)').text();
    let areaDocumento = fila.find('td:eq(8)').text();
    let sedeDocumento = fila.find('td:eq(9)').text();
    let idMovimiento = parseInt(fila.find('td:eq(0)').text());

    // Asignar valores a los campos del modal
    $("#idMovimientoDocumentoUsuarioNormal").val(idMovimiento);
    $("#tipoDocumentoUsuarioNormal").val(tipoDocumento);
    $("#nroDocumentoUsuarioNormal").val(nroDocumento);
    $("#nombreDocumentoUsuarioNormal").val(documentoExtension);
    $("#fechaNotificacionUsuarioNormal").val(fechaNotificacion);
    $("#fechaDocumentoUsuarioNormal").val(fechaDocumento);
    $("#sumillaDocumentoUsuarioNormal").val(sumillaDocumento);
    $("#areaDocumentoUsuarioNormal").val(areaDocumento);
    $("#sedeDocumentoUsuarioNormal").val(sedeDocumento);

    // Configurar y mostrar el modal
    modalEditar.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalEditar.modal('show');
}

// DETALLE MOVIMIENTOS
$(document).off('submit', '#detalleMovimientoFormUsuarioNormal').on('submit', '#detalleMovimientoFormUsuarioNormal', function (e) {
    e.preventDefault();
    $(this).off('submit');
});

function registrarLecturaDocumento(idMovimiento) {
    $.ajax({
        url: './controllers/Movimientos/registrarLecturaDocumento.php',
        method: 'POST',
        dataType: 'json',
        data: { idMovimiento },
        success: function (response) {
            response = JSON.parse(response);
            if (response.status !== 'success') {
                alert("Ocurrió un error al registrar la fecha de lectura de la Notificación");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error fetching the content:', textStatus, errorThrown);
        }
    });
}

function registrarDescargaDocumento(idMovimiento) {
    $.ajax({
        url: './controllers/Movimientos/registrarDescargaDocumento.php',
        method: 'POST',
        dataType: 'json',
        data: { idMovimiento },
        success: function (response) {
            response = JSON.parse(response);
            if (response.status !== 'success') {
                alert("Ocurrió un error al registrar la fecha de descarga de la Notificación");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error fetching the content:', textStatus, errorThrown);
        }
    });
}
function descargarDocumento(idMovimiento){
    window.location.href = './controllers/Movimientos/descargarDocumento.php?action=descargarDocumento&id=' + idMovimiento;    
    registrarDescargaDocumento(idMovimiento);
    cerrarModal();
}

});
