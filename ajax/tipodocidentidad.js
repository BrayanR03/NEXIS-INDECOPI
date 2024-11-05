$(document).ready(function () {
    console.log("INICIO DE TIPODOCUMENTOSIDENTIDAD.JS :D");
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
    let descripcionTDIFiltro = $('#Descripcion').val();

    function loadTipoDocumentosIdentidad(descripcionTDIFiltro = '', pagina, registrosPorPagina) {
        $.ajax({
            url: './controllers/TipoDocumentosIdentidad/listarTipoDocIdentidad.php',
            method: 'POST',
            dataType: 'json',
            data: { descripcionTDIFiltro, pagina, registrosPorPagina },
            success: function (response) {
                console.log(response);
                // return
                let { data } = response
                if (data.length > 0 && Array.isArray(data)) {
                    let row = data.map(tipodocid => `
                    <tr>
                        <td>${tipodocid.idTipoDocumentoIdentidad}</td>
                        <td>${tipodocid.Descripcion}</td>
                        <td>${tipodocid.Estado}</td>
                        <td>
                        <a href="#" id="btnEditarTipoDocumentoIdentidad" >Editar</a>
                        </td>

                    </tr>`).join('');
                    $('#bodyListaTipoDocumentosIdentidad').html(row);
                } else {
                    let row = `<tr>
                        <td colSpan="10" className="mensajeSinRegistros"> Aún no existen tipos documento de identidad registrados</td>
                    </tr>`
                    $('#bodyListaTipoDocumentosIdentidad').html(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    loadTotalTipoDocumentosIdentidad(descripcionTDIFiltro);
    loadTipoDocumentosIdentidad(descripcionTDIFiltro, pagina, registrosPorPagina);
    // buscarDocumentos
    $(document).off("input", "#Descripcion").on("input", "#Descripcion", function (e) {
        e.preventDefault();
        descripcionTDIFiltro= $('#Descripcion').val();
        pagina = 1

        // generarOpcionesPaginacion()
        loadTipoDocumentosIdentidad(descripcionTDIFiltro, pagina, registrosPorPagina);
        loadTotalTipoDocumentosIdentidad(descripcionTDIFiltro);
    })

    function loadTotalTipoDocumentosIdentidad(descripcionTDIFiltro) {
        $.ajax({
            url: './controllers/TipoDocumentosIdentidad/totalTipoDocIdentidad.php',
            method: 'GET',
            dataType: 'json',
            data: { descripcionTDIFiltro},
            success: function (response) {
                // console.log(response);
                // return 
                console.log(response);
                let totalTDIRegistradosInput = document.getElementById("totalTDIRegistrados");
                totalTDIRegistradosInput.innerText = response[0].total;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    // ABRIR MODAL REGISTRAR AREA
$(document).off("click", "#btnRegistrarTipoDocumentoIdentidad").on("click", "#btnRegistrarTipoDocumentoIdentidad", function (e) {
    e.preventDefault();
    let modalRegistrar = $("#modalRegistrarTipoDocumentoIdentidad");
    $("#registrarTipoDocumentoIdentidadForm").trigger("reset");

    modalRegistrar.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalRegistrar.modal('show');

    modalRegistrar.on('shown.bs.modal', function () {
        $("#descripcionTipoDocumentoIdentidadNuevo").focus();
    });
});

// REGISTRAR AREA DIRECTO A BD
$(document).off('submit', '#registrarTipoDocumentoIdentidadForm').on('submit', '#registrarTipoDocumentoIdentidadForm', function (e) {
    e.preventDefault();

    let descripcion = $.trim($('#descripcionTipoDocumentoIdentidadNuevo').val());

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
        url: "./controllers/TipoDocumentosIdentidad/registrarTipoDocIdentidad.php",
        type: "POST",
        datatype: "json",
        data: { descripcion: descripcion },
        success: function (response) {
            console.log(response);
            // return
            response = JSON.parse(response);
            if (response.message === 'Tipo Documento Identidad encontrado') {
                alert("Este Tipo Documento de Identidad ya se encuentra Registrado");
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
                    alert("SE REGISTRO EL TIPO DOCUMENTO DE IDENTIDAD");
                    // Swal.fire({
                    //     icon: "success",
                    //     title: "¡Éxito!",
                    //     text: response.message,
                    //     allowEnterKey: false,
                    //     allowEscapeKey: false,
                    //     allowOutsideClick: false,
                    //     stopKeydownPropagation: false
                    // }).then(() => {
                    $('#modalRegistrarTipoDocumentoIdentidad').modal('hide');
                    pagina = 1;
                    // generarOpcionesPaginacion();
                    loadTipoDocumentosIdentidad(descripcionTDIFiltro, pagina, registrosPorPagina);
                    loadTotalTipoDocumentosIdentidad(descripcionTDIFiltro);
                    // });
                } else {
                    alert("Error al Registrar el Tipo Documentos de Identidad");
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
$(document).on("click", "#btnEditarTipoDocumentoIdentidad", function (e) {
    e.preventDefault();
    let modalEditar = $("#modalEditarTipoDocumentoIdentidad");
    let fila = $(this).closest("tr");
    let idTipoDocumentoIdentidad = parseInt(fila.find('td:eq(0)').text());
    let descripcion = fila.find('td:eq(1)').text();
    let estado = fila.find('td:eq(2)').text();
    // descripcionDB = descripcion;
    $("#estadoTipoDocumentoIdentidad").val(estado.trim());
    $("#descripcionTipoDocumentoIdentidad").val(descripcion.trim());
        $("#idTipoDocumentoIdentidad").val(idTipoDocumentoIdentidad);

    modalEditar.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalEditar.modal('show');

    modalEditar.one('shown.bs.modal', function () {
        $("#descripcionTipoDocumentoIdentidad").focus();
    });
});

// Actualizar Area en Modelo
$(document).off('submit', '#editarTipoDocumentoForm').on('submit', '#editarTipoDocumentoIdentidadForm', function (e) {
    e.preventDefault();
    $(this).off('submit'); // Desenganchar el evento de submit

    let estado = $.trim($('#estadoTipoDocumentoIdentidad').val());
    let descripcion = $.trim($('#descripcionTipoDocumentoIdentidad').val());
    let idTipoDocumentoIdentidad = $.trim($('#idTipoDocumentoIdentidad').val());

    if (descripcion.length === 0 || idTipoDocumentoIdentidad.length === 0) {
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
        url: "./controllers/TipoDocumentosIdentidad/actualizarTipoDocIdentidad.php",
        type: "POST",
        datatype: "json",
        data: { idTipoDocumentoIdentidad, descripcion,estado },
        success: function (response) {
            console.log(response);
            // return
            response = JSON.parse(response);
                if (response.status === 'success') {
                    alert("Se Actualizo el Tipo Documento de Identidad");
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
                        $('#modalEditarTipoDocumentoIdentidad').modal('hide');
                        loadTipoDocumentosIdentidad(descripcionTDIFiltro,pagina, registrosPorPagina);
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
    url: './controllers/TipoDocumentosIdentidad/listarTipoDocIdentidadCombo.php',
    method: 'GET',
    dataType: 'json',
    data: {},
    success: function(data) {
        if (data && Array.isArray(data)) {
            let options = `<option disabled selected value="">Seleccionar</option>` +
                data.map(tipodocident =>
                    `<option value="${tipodocident.idTipoDocumentoIdentidad}">${tipodocident.Descripcion}</option>`
                ).join('');


            $('.selectTipoDocumentoIdentidad').html(options);
            
        } else {
            console.warn('No data received or data is not an array.');
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error fetching the content:', textStatus, errorThrown);
    }
});