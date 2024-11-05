$(document).ready(function () {
    console.log("INICIO DE TIPOUSUARIOS.JS :D");
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

    let pagina = 1;
    let descripcionTCFiltro = $('#Descripcion').val();

    function loadTipoCasillas(descripcionTCFiltro = '', pagina, registrosPorPagina) {
        $.ajax({
            url: './controllers/TipoCasillas/listarTipoCasillas.php',
            method: 'POST',
            dataType: 'json',
            data: { descripcionTCFiltro, pagina, registrosPorPagina },
            success: function (response) {
                console.log("dentro del success");
                // console.log(response);
                // return
                let { data } = response
                if (data.length > 0 && Array.isArray(data)) {
                    
                console.log("dentro del IF");
                    let row = data.map(tipocasilla => `
                    <tr>
                        <td>${tipocasilla.idTipoCasilla}</td>
                        <td>${tipocasilla.Descripcion}</td>
                        <td>${tipocasilla.Estado}</td>
                        <td>
                        <a href="#" id="btnEditarTipoCasilla" >Editar</a>
                        </td>

                    </tr>`).join('');
                    $('#bodyListaTipoCasillas').html(row);
                } else {
                    
                console.log("dentro del else");
                    let row = `<tr>
                        <td colSpan="10" className="mensajeSinRegistros"> Aún no existen tipos de casilla registrados</td>
                    </tr>`
                    $('#bodyListaTipoCasillas').html(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    loadTotalTipoCasillas(descripcionTCFiltro);
    loadTipoCasillas(descripcionTCFiltro, pagina, registrosPorPagina);
    // buscarDocumentos
    $(document).off("input", "#Descripcion").on("input", "#Descripcion", function (e) {
        e.preventDefault();
        descripcionTCFiltro = $('#Descripcion').val();
        pagina = 1

        // generarOpcionesPaginacion()
        loadTotalTipoCasillas(descripcionTCFiltro);
        loadTipoCasillas(descripcionTCFiltro, pagina, registrosPorPagina);
    })

    function loadTotalTipoCasillas(descripcionTCFiltro) {
        $.ajax({
            url: './controllers/TipoCasillas/totalTipoCasillasRegistrados.php',
            method: 'GET',
            dataType: 'json',
            data: { descripcionTCFiltro},
            success: function (response) {
                // console.log(response);
                // return 
                console.log(response);
                let totalTCRegistradosInput = document.getElementById("totalTCRegistrados");
                totalTCRegistradosInput.innerText = response[0].total;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }
// ABRIR MODAL REGISTRAR AREA
$(document).off("click", "#btnRegistrarTipoCasilla").on("click", "#btnRegistrarTipoCasilla", function (e) {
    e.preventDefault();
    let modalRegistrar = $("#modalRegistrarTipoCasilla");
    $("#registrarTipoCasillaForm").trigger("reset");

    modalRegistrar.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalRegistrar.modal('show');

    modalRegistrar.on('shown.bs.modal', function () {
        $("#descripcionTipoCasillaNuevo").focus();
    });
});

// REGISTRAR AREA DIRECTO A BD
$(document).off('submit', '#registrarTipoCasillaForm').on('submit', '#registrarTipoCasillaForm', function (e) {
    e.preventDefault();

    let descripcion = $.trim($('#descripcionTipoCasillaNuevo').val());

    if (descripcion.length === 0) {
        alert("Campos Vacíos");
        return
        // Swal.fire({
        //     icon: "warning",
        //     title: "Campos Incompletos",
        //     text: "Ingrese los campos requeridos",
        //     allowEnterKey: false,
        //     allowEscapeKey: false,
        //     allowOutsideClick: false,
        //     stopKeydownPropagation: false
        // });
        // return;
    }

    // descripcion = capitalizeWords(descripcion);

    $.ajax({
        url: "./controllers/TipoCasillas/registrarTipoCasillas.php",
        type: "POST",
        datatype: "json",
        data: { descripcion: descripcion },
        success: function (response) {
            console.log(response);
            // return
            response = JSON.parse(response);
            if (response.message === 'Tipo Casilla encontrado') {
                alert("Este Tipo de Casilla ya se encuentra Registrada");
                // Swal.fire({
                //     icon: "warning",
                //     title: "¡Advertencia!",
                //     text: "El área que intenta registrar ya existe",
                //     allowEnterKey: false,
                //     allowEscapeKey: false,
                //     allowOutsideClick: false,
                //     stopKeydownPropagation: false
                // });
            } else {
                if (response.status === 'success') {
                    alert("SE REGISTRO EL TIPO DE CASILLA");
                    // Swal.fire({
                    //     icon: "success",
                    //     title: "¡Éxito!",
                    //     text: response.message,
                    //     allowEnterKey: false,
                    //     allowEscapeKey: false,
                    //     allowOutsideClick: false,
                    //     stopKeydownPropagation: false
                    // }).then(() => {
                    $('#modalRegistrarTipoCasilla').modal('hide');
                    pagina = 1;
                    // generarOpcionesPaginacion();
                    loadTipoCasillas(descripcionTCFiltro, pagina, registrosPorPagina);
                    loadTotalTipoCasillas(descripcionTCFiltro);
                    // });
                } else {
                    alert("Error al Registrar el Tipo de Casillas");
                    // Swal.fire({
                    //     icon: "error",
                    //     title: "Error",
                    //     text: response.message,
                    //     allowEnterKey: false,
                    //     allowEscapeKey: false,
                    //     allowOutsideClick: false,
                    //     stopKeydownPropagation: false
                    // });
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error updating the area:', textStatus, errorThrown);
        }
    });
});

// let descripcionDB = '';

// Editar Area
$(document).on("click", "#btnEditarTipoCasilla", function (e) {
    e.preventDefault();
    let modalEditar = $("#modalEditarTipoCasilla");
    let fila = $(this).closest("tr");
    let idTipoCasilla = parseInt(fila.find('td:eq(0)').text());
    let descripcion = fila.find('td:eq(1)').text();
    let estado = fila.find('td:eq(2)').text();
    // descripcionDB = descripcion;
    $("#estadoTipoCasilla").val(estado.trim());
    $("#descripcionTipoCasilla").val(descripcion.trim());
        $("#idTipoCasilla").val(idTipoCasilla);

    modalEditar.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalEditar.modal('show');

    modalEditar.one('shown.bs.modal', function () {
        $("#descripcionTipoCasilla").focus();
    });
});

// Actualizar Area en Modelo
$(document).off('submit', '#editarTipoCasillaForm').on('submit', '#editarTipoCasillaForm', function (e) {
    e.preventDefault();
    $(this).off('submit'); // Desenganchar el evento de submit

    let estado = $.trim($('#estadoTipoCasilla').val());
    let descripcion = $.trim($('#descripcionTipoCasilla').val());
    let idTipoCasilla = $.trim($('#idTipoCasilla').val());

    if (descripcion.length === 0 || idTipoCasilla.length === 0) {
        // Swal.fire({
        //     icon: "warning",
        //     title: "Campos Incompletos",
        //     text: "Ingrese los campos requeridos",
        //     allowEnterKey: false,
        //     allowEscapeKey: false,
        //     allowOutsideClick: false,
        //     stopKeydownPropagation: false
        // });
        // return;
        alert("Campos Incompletos");
        return;
    }


    // descripcion = capitalizeWords(descripcion);

    $.ajax({
        url: "./controllers/TipoCasillas/actualizarTipoCasilla.php",
        type: "POST",
        datatype: "json",
        data: { idTipoCasilla, descripcion,estado },
        success: function (response) {
            console.log(response);
            // return
            response = JSON.parse(response);
                if (response.status === 'success') {
                    alert("Se Actualizo el Tipo Casilla");
                    // return;
                    // Swal.fire({
                    //     icon: "success",
                    //     title: "Actualización Exitosa",
                    //     text: response.message,
                    //     allowEnterKey: false,
                    //     allowEscapeKey: false,
                    //     allowOutsideClick: false,
                    //     stopKeydownPropagation: false
                    // }).then(() => {
                        $('#modalEditarTipoCasilla').modal('hide');
                        loadTipoCasillas(descripcionTCFiltro,pagina, registrosPorPagina);
                    // });
                } else {
                    alert("Error");
                    return;
                    // Swal.fire({
                    //     icon: "error",
                    //     title: "Error",
                    //     text: response.message,
                    //     allowEnterKey: false,
                    //     allowEscapeKey: false,
                    //     allowOutsideClick: false,
                    //     stopKeydownPropagation: false
                    // });
                }
            
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error updating the area:', textStatus, errorThrown);
        }
    });
});



});



// llenar select
$.ajax({
    url: './controllers/TipoCasillas/listarTipoCasillasCombo.php',
    method: 'GET',
    dataType: 'json',
    data: {},
    success: function(data) {
        console.log(data);
        // return
        if (data && Array.isArray(data)) {
            let options = `<option value="" disabled selected>Seleccionar</option>` +
                data.map(tipocasillas =>
                    `<option value="${tipocasillas.idTipoCasilla}">${tipocasillas.Descripcion}</option>`
                ).join('');


            $('.selectTipoCasilla').html(options);
        } else {
            console.warn('No data received or data is not an array.');
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error fetching the content:', textStatus, errorThrown);
    }
});