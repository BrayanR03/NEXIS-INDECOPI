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


    let usuario = window.usuarioPerfil;
    let idUsuario = window.idUsuario;
    let datosBusquedaFiltroNotificaciones = $("#datosBusquedaFiltroNotificaciones").val();

    function loadInformacionMovimientos(idUsuario, datosBusquedaFiltroNotificaciones) {

        $.ajax({
            url: './controllers/Movimientos/informacionMovimientosCasillas.php',
            method: 'POST',
            dataType: 'json',
            data: { idUsuario, datosBusquedaFiltroNotificaciones },
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
                        <td><a href="#" id="btnDetalleNotificacionAdministrador">Ver Detalle</a></td>

                    </tr>`).join('');
                    $('#bodyListaRegistroMovimientos').html(row);
                } else {
                    let row = `<tr>
                        <td colSpan="10" className="mensajeSinRegistros">No hay notificaciones recibidas</td>
                    </tr>`
                    $('#bodyListaRegistroMovimientos').html(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }


    // buscarDocumentos
    $(document).off("input", "#datosBusquedaFiltroNotificaciones").on("input", "#datosBusquedaFiltroNotificaciones", function (e) {
        e.preventDefault();
        datosBusquedaFiltroNotificaciones = $('#datosBusquedaFiltroNotificaciones').val();
        pagina = 1

        // generarOpcionesPaginacion()
        loadInformacionMovimientos(idUsuario, datosBusquedaFiltroNotificaciones);
        loadTotalNotificacionesAdministrador(idUsuario, datosBusquedaFiltroNotificaciones);
    })

    function loadTotalNotificacionesAdministrador(idUsuario, datosBusquedaFiltroNotificaciones) {
        $.ajax({
            url: './controllers/Movimientos/totalMovimientosAdministrador.php',
            method: 'GET',
            dataType: 'json',
            data: { idUsuario, datosBusquedaFiltroNotificaciones },
            success: function (response) {
                // console.log(response);
                // return 
                console.log(response);
                let totalMovimientosInput = document.getElementById("totalNotificacionesRegistradas");
                totalMovimientosInput.innerText = response[0].total;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }
    loadInformacionMovimientos(idUsuario, datosBusquedaFiltroNotificaciones);
    loadTotalNotificacionesAdministrador(idUsuario, datosBusquedaFiltroNotificaciones);


    // Detalles del Movimiento
    $(document).on("click", "#btnDetalleNotificacionAdministrador", function (e) {
        e.preventDefault();
        let modalEditar = $("#modalDetalleMovimientoUsuarioAdministrador");
        let fila = $(this).closest("tr");
        let idMovimiento = parseInt(fila.find('td:eq(0)').text());
        let tipoDocumento = fila.find('td:eq(1)').text();
        let nroDocumento = fila.find('td:eq(2)').text();
        let documento = fila.find('td:eq(3)').text();
        let fechaNotificacion = fila.find('td:eq(4)').text();
        let fechaDocumento = fila.find('td:eq(5)').text();
        let estadoDocumento = fila.find('td:eq(6)').text();
        let sumilla = fila.find('td:eq(7)').text();
        let area = fila.find('td:eq(8)').text();
        let sede = fila.find('td:eq(9)').text();

        $("#idMovimientoDocumentoUsuarioAdministrador").val(idMovimiento);
        $("#tipoDocumentoUsuarioAdministrador").val(tipoDocumento.trim());
        $("#nroDocumentoUsuarioAdministrador").val(nroDocumento.trim());
        $("#nombreDocumentoUsuarioAdministrador").val(documento.trim());
        $("#fechaNotificacionUsuarioAdministrador").val(fechaNotificacion);
        $("#fechaDocumentoUsuarioAdministrador").val(fechaDocumento);
        $("#estadoDocumentoUsuarioAdministrador").val(estadoDocumento.trim());
        $("#sumillaDocumentoUsuarioAdministrador").val(sumilla);
        $('#areaDocumentoUsuarioAdministrador').val(area);
        $('#sedeDocumentoUsuarioAdministrador').val(sede);

        modalEditar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalEditar.modal('show');

        modalEditar.one('shown.bs.modal', function () {
            // $("#nombresPersona").focus();
        });
    });

    // Actualizar Area en Modelo
    $(document).off('submit', '#detalleMovimientoFormUsuarioAdministrador').on('submit', '#detalleMovimientoFormUsuarioAdministrador', function (e) {
        e.preventDefault();
        $(this).off('submit');

    });


// Detalles del Movimiento
$(document).on("click", "#btnDescargarDocumentoAdministrador", function (e) {
    e.preventDefault();
    let fila = $(this).closest("tr");
    let idMovimiento = $("#idMovimientoDocumentoUsuarioAdministrador").val();
    descargarDocumento(idMovimiento);

});



    // Registro del Movimiento
    $(document).on("click", "#btnRegistroMovimientoCasilla", function (e) {
        e.preventDefault();
        let modalEditar = $("#modalRegistrarMovimientoCasilla");
        let fila = $(this).closest("tr");


        modalEditar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalEditar.modal('show');

        modalEditar.one('shown.bs.modal', function () {
            $("#datosBusquedaFiltro").focus();
            // $("#nombresPersona").focus();
        });
    });


    /*VALEEEEEEEEEEEEEEEEEEEEE */
    $('#registrarMovimientoCasillaForm').off('submit').on('submit', function (e) {

        // $(document).off('submit', '#registrarMovimientoCasillaForm').on('submit', '#registrarMovimientoCasillaForm', function (e) {
        e.preventDefault();// Desenganchar el evento de submit

        let nroCasilla = $.trim($('#NroCasillaNotificacion').val());
        let tipoDocumento = $('#tipoDocumentoNotificacion').val();
        let nroDocumento = $.trim($('#nroDocumento').val());
        let fechaDocumento = $('#fechaDocumento').val();
        let fechaNotificacion = $('#fechaNotificacion').val();
        // let archivoDocumento=$('#archivoDocumento');
        let sumilla = $.trim($('#sumilla').val());
        let areaNotificacion = $('#areaNotificacion').val();
        let sedeNotificacion = $('#sedeNotificacion').val();
        let usuarioRegistrador = idUsuario;
        let emailDestino = $('#emailDestino').val();
        // console.log(emailDestino);
        let formData = new FormData();
        formData.append('nroCasilla', nroCasilla);
        formData.append('tipoDocumento', tipoDocumento);
        formData.append('nroDocumento', nroDocumento);
        formData.append('fechaDocumento', fechaDocumento);
        formData.append('fechaNotificacion', fechaNotificacion);
        formData.append('sumilla', sumilla);
        formData.append('areaNotificacion', areaNotificacion);
        formData.append('sedeNotificacion', sedeNotificacion);
        formData.append('usuarioRegistrador', usuarioRegistrador);
        formData.append('emailDestino', emailDestino);
        // Capturar el archivo (solo si se ha subido uno)
        let archivoInput = $('#archivoDocumento')[0].files[0];
        if (archivoInput) {
            formData.append('archivoDocumento', archivoInput);  // Agregar el archivo al FormData
        } else {
            alert("Por favor selecciona un archivo.");
            return;
        }
        // console.log(formData);
        formData.forEach((value, key) => {
            console.log(key + ': ' + value);
        });

        if (nroCasilla.length === 0 || nroDocumento.length === 0) {
            alert("Aún Hay Campos Vacíos");
            return
        } else {
            $.ajax({
                url: "./controllers/Movimientos/registrarMovimiento.php",
                type: "POST",
                data: formData,
                contentType: false, // Importante para no establecer el tipo de contenido por defecto
                processData: false,
                datatype: "json",
                beforeSend: function () {
                    // Mostrar la pantalla de carga antes de que se envíe la solicitud
                    showLoadingScreen();
                },
                success: function (response) {
                    // console.log(response);
                    hideLoadingScreen();
                    // return

                    try {
                        response = JSON.parse(response);
                        if (response.message === 'Usuario Notificado Mismo Documento') {
                            alert("Atención: Se le Notificará al Usuario por segunda vez el mismo documento");
                        } else {
                            if (response.status === 'success') {
                                alert("Se Notificó el Documento Correctamente");
                                loadInformacionMovimientos(idUsuario, datosBusquedaFiltroNotificaciones);
                                $('#modalRegistrarMovimientoCasilla').modal('hide');
                                pagina = 1;
                                let datosMovimientoDiv = document.querySelector('#datosMovimiento');
                                datosMovimientoDiv.hidden = true;
                                $('#NroCasillaNotificacion').val("");
                                $('#emailDestino').val("");
                                $('#tipoDocumentoNotificacion').val($('#tipoDocumentoNotificacion option:first').val());
                                $('#nroDocumento').val("");
                                $('#fechaDocumento').val("");
                                $('#fechaNotificacion').val("");
                                $('#sumilla').val("");
                                $('#areaNotificacion').val($('#areaNotificacion option:first').val());
                                $('#sedeNotificacion').val($('#sedeNotificacion option:first').val());
                            } else {
                                alert("Error al Notificar al Usuario: " + response.message);
                            }
                        }
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                        alert("Error en la respuesta del servidor.");
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    hideLoadingScreen();
                    console.log("excepcion error");
                    console.error('Error updating the area:', textStatus, errorThrown);
                },
                complete: function () {
                    // Ocultar la pantalla de carga cuando la solicitud haya terminado (éxito o error)
                    hideLoadingScreen();
                }
            });
        }


    });

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
    function descargarDocumento(idMovimiento) {
        window.location.href = './controllers/Movimientos/descargarDocumento.php?action=descargarDocumento&id=' + idMovimiento;
        registrarDescargaDocumento(idMovimiento);
        cerrarModal();
    }

});
