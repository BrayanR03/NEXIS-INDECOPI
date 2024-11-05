$(document).ready(function () {
    console.log("INICIO DE tipo personas.JS :D");
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
    let descripcionTPFiltro = $('#Descripcion').val();


    function loadTipoPersonas(descripcionTPFiltro = '', pagina, registrosPorPagina) {
        $.ajax({
            url: './controllers/TipoPersonas/listarTipoPersonas.php',
            method: 'POST',
            dataType: 'json',
            data: { descripcionTPFiltro, pagina, registrosPorPagina },
            success: function (response) {
                console.log(response);
                // return
                let { data } = response
                if (data.length > 0 && Array.isArray(data)) {
                    let row = data.map(tipopersona => `
                    <tr>
                        <td>${tipopersona.idTipoPersona}</td>
                        <td>${tipopersona.Descripcion}</td>
                        <td>${tipopersona.Estado}</td>
                        <td>
                        <a href="#" id="btnEditarTipoPersona" >Editar</a>
                        </td>

                    </tr>`).join('');
                    $('#bodyListaTipoPersonas').html(row);
                } else {
                    let row = `<tr>
                        <td colSpan="10" className="mensajeSinRegistros"> Aún no existen tipos de persona registrados</td>
                    </tr>`
                    $('#bodyListaTipoPersonas').html(row);
                        
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    loadTotalTipoPersonas(descripcionTPFiltro);
    loadTipoPersonas(descripcionTPFiltro, pagina, registrosPorPagina);
    // buscarDocumentos
    $(document).off("input", "#Descripcion").on("input", "#Descripcion", function (e) {
        e.preventDefault();
        descripcionTPFiltro = $('#Descripcion').val();
        pagina = 1

        // generarOpcionesPaginacion()
        loadTipoPersonas(descripcionTPFiltro, pagina, registrosPorPagina);
        loadTotalTipoPersonas(descripcionTPFiltro);
    })

    function loadTotalTipoPersonas(descripcionTPFiltro) {
        $.ajax({
            url: './controllers/TipoPersonas/totalTipoPersonasRegistradas.php',
            method: 'GET',
            dataType: 'json',
            data: { descripcionTPFiltro},
            success: function (response) {
                // console.log(response);
                // return 
                console.log(response);
                let totalTPRegistradosInput = document.getElementById("totalTPRegistrados");
                totalTPRegistradosInput.innerText = response[0].total;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    
// ABRIR MODAL REGISTRAR AREA
$(document).off("click", "#btnRegistrarTipoPersona").on("click", "#btnRegistrarTipoPersona", function (e) {
    e.preventDefault();
    let modalRegistrar = $("#modalRegistrarTipoPersona");
    $("#registrarTipoPersonaForm").trigger("reset");

    modalRegistrar.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalRegistrar.modal('show');

    modalRegistrar.on('shown.bs.modal', function () {
        $("#descripcionTipoPersonaNuevo").focus();
    });
});

// REGISTRAR AREA DIRECTO A BD
$(document).off('submit', '#registrarTipoPersonaForm').on('submit', '#registrarTipoPersonaForm', function (e) {
    e.preventDefault();

    let descripcion = $.trim($('#descripcionTipoPersonaNuevo').val());

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
        url: "./controllers/TipoPersonas/registrarTipoPersonas.php",
        type: "POST",
        datatype: "json",
        data: { descripcion: descripcion },
        success: function (response) {
            console.log(response);
            // return
            response = JSON.parse(response);
            if (response.message === 'Tipo Persona encontrado') {
                alert("Este Tipo de Persona ya se encuentra Registrado");
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
                    alert("SE REGISTRO EL TIPO DE PERSONA");
                    // Swal.fire({
                    //     icon: "success",
                    //     title: "¡Éxito!",
                    //     text: response.message,
                    //     allowEnterKey: false,
                    //     allowEscapeKey: false,
                    //     allowOutsideClick: false,
                    //     stopKeydownPropagation: false
                    // }).then(() => {
                    $('#modalRegistrarTipoPersona').modal('hide');
                    pagina = 1;
                    // generarOpcionesPaginacion();
                    loadTipoPersonas(descripcionTPFiltro, pagina, registrosPorPagina);
                    loadTotalTipoPersonas(descripcionTPFiltro);
                    // });
                } else {
                    alert("Error al Registrar el Tipo de Personas");
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
$(document).on("click", "#btnEditarTipoPersona", function (e) {
    e.preventDefault();
    let modalEditar = $("#modalEditarTipoPersona");
    let fila = $(this).closest("tr");
    let idTipoPersona = parseInt(fila.find('td:eq(0)').text());
    let descripcion = fila.find('td:eq(1)').text();
    let estado = fila.find('td:eq(2)').text();
    // descripcionDB = descripcion;
    $("#estadoTipoPersona").val(estado.trim());
    $("#descripcionTipoPersona").val(descripcion.trim());
        $("#idTipoPersona").val(idTipoPersona);

    modalEditar.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalEditar.modal('show');

    modalEditar.one('shown.bs.modal', function () {
        $("#descripcionTipoPersona").focus();
    });
});

// Actualizar Area en Modelo
$(document).off('submit', '#editarTipoPersonaForm').on('submit', '#editarTipoPersonaForm', function (e) {
    e.preventDefault();
    $(this).off('submit'); // Desenganchar el evento de submit

    let estado = $.trim($('#estadoTipoPersona').val());
    let descripcion = $.trim($('#descripcionTipoPersona').val());
    let idTipoPersona = $.trim($('#idTipoPersona').val());

    if (descripcion.length === 0 || idTipoPersona.length === 0) {
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
        url: "./controllers/TipoPersonas/actualizarTipoPersonas.php",
        type: "POST",
        datatype: "json",
        data: { idTipoPersona, descripcion,estado },
        success: function (response) {
            console.log(response);
            // return
            response = JSON.parse(response);
                if (response.status === 'success') {
                    alert("Se Actualizo el Tipo Persona");
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
                        $('#modalEditarTipoPersona').modal('hide');
                        loadTipoPersonas(descripcionTPFiltro,pagina, registrosPorPagina);
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
    url: './controllers/TipoPersonas/listarTipoPersonasCombo.php',
    method: 'GET',
    dataType: 'json',
    data: {},
    success: function(data) {
        // console.log(data);
        if (data && Array.isArray(data)) {
            let options = `<option disabled selected value="">Seleccionar</option>` +
                data.map(tipopersonas =>
                    `<option value="${tipopersonas.idTipoPersona}">${tipopersonas.Descripcion}</option>`
                ).join('');


            $('.selectTipoPersona').html(options);
        } else {
            console.warn('No data received or data is not an array.');
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error fetching the content:', textStatus, errorThrown);
    }
});