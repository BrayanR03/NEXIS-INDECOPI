$(document).ready(function () {
    console.log("INICIO DE CASILLAS.JS :D");
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

    // ABRIR MODAL ASIGNAR CASILLA
    $(document).off("click", "#btnAsignarCasilla").on("click", "#btnAsignarCasilla", function (e) {
        e.preventDefault();
        let modalRegistrar = $("#modalAsignarCasilla");
        $("#asignarCasillaForm").trigger("reset");
        let fila = $(this).closest("tr");
        let idPersona = parseInt(fila.find('td:eq(4)').text());
        let nombres = fila.find('td:eq(5)').text();
        let tipoPersona = fila.find('td:eq(6)').text();
        let tipoDocumentoIdentidad = fila.find('td:eq(7)').text();
        let numDocumentoIdentidad = fila.find('td:eq(8)').text();
        let representanteLegal = fila.find('td:eq(9)').text();

        $("#idPersonaAsignadoCasilla").val(idPersona);
        $("#nombresPersonaCasilla").val(nombres.trim());
        $("#tipoPersonaCasilla").val(tipoPersona.trim());
        $("#tipoDocumentoIdentidadCasilla").val(tipoDocumentoIdentidad.trim());
        $("#numDocumentoIdentidadPersonaCasilla").val(numDocumentoIdentidad.trim());
        $("#representanteLegalCasilla").val(representanteLegal.trim());

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.on('shown.bs.modal', function () {
            $.ajax({
                url: './controllers/Casillas/idUltimaCasilla.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data && Array.isArray(data)) {
                        let idCasilla = data[0].idCasilla; // Captura el primer idCasilla de la lista (o el que necesites)
                        $('#idCasillaAsignar').val(idCasilla); // Establece el valor
                    } else {
                        console.warn('No data received or data is not an array.');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error al obtener los datos:', textStatus, errorThrown);
                }
            });
            $("#usuarioUsuario").focus();
        });
    });

    // REGISTRAR USUARIO DIRECTO A BD
    $(document).off('submit', '#asignarCasillaForm').on('submit', '#asignarCasillaForm', function (e) {
        e.preventDefault();

        // let dni = $.trim($('#dniPersonaNuevo').val());
        let idPersonaAsignar = $.trim($('#idPersonaAsignadoCasilla').val());
        let fechaApertura = $('#fechaApertura').val();
        let idTipoCasilla = $('#tipoCasillaAsignar').val();
        console.log(idTipoCasilla);
        if (idTipoCasilla === null || idTipoCasilla === '') {
            alert("Debes Seleccionar un Tipo de Casilla");
            $("#tipoCasillaAsignar").focus();
            return
        }
        if (idPersonaAsignar.length === 0 || fechaApertura.length === 0) {
            alert("Hay Campos Vacíos Sin Completar!!");
            return
        }

        // descripcion = capitalizeWords(descripcion);

        $.ajax({
            url: "./controllers/Casillas/registrarCasilla.php",
            type: "POST",
            datatype: "json",
            data: {
                idPersonaAsignar: idPersonaAsignar, fechaApertura: fechaApertura, idTipoCasilla: idTipoCasilla
            },
            success: function (response) {
                console.log(response);
                // return
                response = JSON.parse(response);
                if (response.status === 'success') {
                    alert("SE ASIGNO LA CASILLA CORRECTAMENTE");
                    $('#modalAsignarCasilla').modal('hide');
                    pagina = 1;
                    loadTotalCasillas(datosBusquedaFiltro, filtroBusqueda);
                    loadCasillas(datosBusquedaFiltro, filtroBusqueda, pagina, registrosPorPagina);

                } else {
                    alert("Error al Registrar la Casilla");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error updating the area:', textStatus, errorThrown);
            }
        });
    });


    let pagina = 1;
    let datosBusquedaFiltro = $('#datosBusquedaFiltro').val();
    // let usuario = $('#UsuarioPersona').val();
    // let usuario= window.usuarioPerfil;
    // let numDocumentoIdentidadPersonaFiltro = $('#numDocumentoIdentidadPersonaFiltro').val();
    let filtroBusqueda = document.querySelector('input[name="filtroBusqueda"]:checked').value;
    // console.log(filtroBusqueda);
    // console.log(datosBusquedaFiltro);
    //CARGAR LISTA DE USUARIOS
    function loadCasillas(datosBusquedaFiltro = '', filtroBusqueda = '', pagina, registrosPorPagina) {
        $.ajax({
            url: './controllers/Casillas/listadoCasillas.php',
            method: 'POST',
            dataType: 'json',
            data: { datosBusquedaFiltro, filtroBusqueda, pagina, registrosPorPagina },
            success: function (response) {
                console.log(response);
                let { data } = response;
                if (data.length > 0 && Array.isArray(data)) {
                    let row = data.map(casilla => {
                        // Verificar si el usuario está asignado o no
                        let acciones = '';
                        if (!casilla.idCasilla || casilla.idCasilla === 'No Asignado') {
                            acciones = `<a href="#" style="background-color: #006B2D;" class="btnNuevoRegistro" id="btnAsignarCasilla">Asignar Casilla</a>`;
                        } else {
                            acciones = `
                                <a href="#" id="btnEditarCasilla">Editar</a>
                            `;
                        }

                        return `
                            <tr>
                                <td hidden>${casilla.idTipoCasilla}</td>
                                <td style='color:red'>${casilla.TipoCasilla ? casilla.TipoCasilla : 'No Asignada'}</td>
                                <td style='color:red'>${casilla.idCasilla ? casilla.idCasilla : 'No Asignada'}</td>
                                <td >${casilla.FechaApertura ? casilla.FechaApertura : 'No Asignada'}</td>
                                <td hidden>${casilla.idPersona}</td>
                                <td>${casilla.Persona}</td>
                                <td>${casilla.TipoPersona}</td>
                                <td>${casilla.TipoDocumentoIdentidad}</td>
                                <td>${casilla.NumDocumentoIdentidad}</td>
                                <td>${casilla.RepresentanteLegal ? casilla.RepresentanteLegal : ''}</td>
                                <td>${casilla.Estado ? casilla.Estado:'No Establecido'}</td>
                                <td>
                                    ${acciones}
                                </td>
                            </tr>
                        `;
                    }).join('');
                    $('#bodyListaCasillas').html(row);
                } else {
                    let row = `<tr>
                        <td colSpan="10" className="mensajeSinRegistros"> Aún no existen personas registradas</td>
                    </tr>`;
                    $('#bodyListaCasillas').html(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

   

    // loadUltimoIdCasilla();
    loadTotalCasillas(datosBusquedaFiltro, filtroBusqueda);
    loadCasillas(datosBusquedaFiltro, filtroBusqueda, pagina, registrosPorPagina);
    // loadInformacionCasilla(usuario);
    // buscarPersonas
    // $(document).off("input", "#datosBusquedaFiltro").on("input", "#datosBusquedaFiltro", function (e) {
    $(document).off("input change", "#datosBusquedaFiltro, input[name='filtroBusqueda']").on("input change", "#datosBusquedaFiltro, input[name='filtroBusqueda']", function (e) {
        e.preventDefault();
        datosBusquedaFiltro = $('#datosBusquedaFiltro').val();
        filtroBusqueda = document.querySelector('input[name="filtroBusqueda"]:checked').value;
        pagina = 1
        loadCasillas(datosBusquedaFiltro, filtroBusqueda, pagina, registrosPorPagina);
        loadTotalCasillas(datosBusquedaFiltro, filtroBusqueda);
    })

    function loadTotalCasillas(datosBusquedaFiltro, filtroBusqueda) {
        $.ajax({
            url: './controllers/Casillas/totalCasillasRegistradas.php',
            method: 'GET',
            dataType: 'json',
            data: { datosBusquedaFiltro, filtroBusqueda },
            success: function (response) {
                console.log(response);
                // return
                let totalCasillasInput = document.getElementById("totalCasillasRegistradas");
                totalCasillasInput.innerText = response[0].total;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }


    // Editar Casilla
    $(document).on("click", "#btnEditarCasilla", function (e) {
        e.preventDefault();
        let modalEditar = $("#modalEditarCasilla");
        let fila = $(this).closest("tr");
        let idPersona = parseInt(fila.find('td:eq(4)').text());
        let FechaApertura = fila.find('td:eq(3)').text();
        let idTipoCasilla = parseInt(fila.find('td:eq(0)').text());
        let estado = fila.find('td:eq(10)').text();
        let idCasilla = parseInt(fila.find('td:eq(2)').text());
        let nombres = fila.find('td:eq(5)').text();;
        let tipoPersona = fila.find('td:eq(6)').text();;
        let tipoDocumentoIdentidad = fila.find('td:eq(7)').text();;
        let numDocumentoIdentidad = fila.find('td:eq(8)').text();;
        let representanteLegal = fila.find('td:eq(9)').text();;
        console.log(estado);

        $("#idPersonaEditarCasilla").val(idPersona);
        $("#nombresPersonaCasillaEditar").val(nombres.trim());
        $("#tipoPersonaCasillaEditar").val(tipoPersona.trim());
        $("#tipoDocumentoIdentidadCasillaEditar").val(tipoDocumentoIdentidad.trim());
        $("#numDocumentoIdentidadPersonaCasillaEditar").val(numDocumentoIdentidad.trim());
        $("#numDocumentoIdentidadPersonaUsuarioEditar").val(numDocumentoIdentidad.trim());
        $("#representanteLegalCasillaEditar").val(representanteLegal);
        $("#estadoCasilla").val(estado.trim());
        $("#idCasillaAsignarEditar").val(idCasilla);
        $('#tipoCasillaAsignarEditar').val(idTipoCasilla);
        $('#fechaAperturaEditar').val(FechaApertura);

        modalEditar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalEditar.modal('show');

        modalEditar.one('shown.bs.modal', function () {
            $("#tipoCasillaAsignarEditar").focus();
        });
    });

    // Actualizar Area en Modelo
    $(document).off('submit', '#editarCasillaForm').on('submit', '#editarCasillaForm', function (e) {
        e.preventDefault();
        $(this).off('submit'); // Desenganchar el evento de submit

        let idCasilla = $.trim($('#idCasillaAsignarEditar').val());
        let FechaApertura= $.trim($('#fechaAperturaEditar').val());
        let idTipoCasilla= $.trim($('#tipoCasillaAsignarEditar').val());
        let idPersona= $.trim($('#idPersonaEditarCasilla').val());
        let estado = $.trim($('#estadoCasilla').val());



        if (idCasilla.length === 0 || idPersona.length === 0 || estado.length === 0 || idTipoCasilla.length === 0) {

            alert("Campos Incompletos");
            return;
        }


        $.ajax({
            url: "./controllers/Casillas/actualizarCasilla.php",
            type: "POST",
            datatype: "json",
            data: {
                idCasilla:idCasilla, FechaApertura:FechaApertura, idTipoCasilla:idTipoCasilla, estado:estado, idPersona:idPersona
            },
            success: function (response) {
                console.log(response);
                // return
                response = JSON.parse(response);
                    if (response.status === 'success') {
                        alert("Se Actualizo la Casilla del Usuario");
                        
                        $('#modalEditarCasilla').modal('hide');
                        loadCasillas(datosBusquedaFiltro, filtroBusqueda, pagina, registrosPorPagina);
                        // });
                    } else {
                        alert("Error");
                        return;
                    }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error updating the area:', textStatus, errorThrown);
            }
        });
    });


});