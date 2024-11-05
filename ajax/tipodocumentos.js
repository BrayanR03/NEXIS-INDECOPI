$(document).ready(function () {
    console.log("INICIO DE TIPODOCUMENTOS.JS :D");
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
    let descripcionTDFiltro = $('#Descripcion').val();

    function loadTipoDocumentos(descripcionTDFiltro = '', pagina, registrosPorPagina) {
        $.ajax({
            url: './controllers/TipoDocumentos/listadoTipoDocumentos.php',
            method: 'POST',
            dataType: 'json',
            data: { descripcionTDFiltro, pagina, registrosPorPagina },
            success: function (response) {
                console.log(response);
                // return
                let { data } = response
                if (data.length > 0 && Array.isArray(data)) {
                    let row = data.map(tipodoc => `
                    <tr>
                        <td>${tipodoc.idTipoDocumento}</td>
                        <td>${tipodoc.Descripcion}</td>
                        <td>${tipodoc.Estado}</td>
                        <td>
                        <a href="#" id="btnEditarTipoDocumento" >Editar</a>
                        </td>

                    </tr>`).join('');
                    $('#bodyListaTipoDocumentos').html(row);
                } else {
                    let row = `<tr>
                        <td colSpan="10" className="mensajeSinRegistros"> Aún no existen tipos de documento registrados</td>
                    </tr>`
                    $('#bodyListaTipoDocumentos').html(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    loadTotalTipoDocumentos(descripcionTDFiltro);
    loadTipoDocumentos(descripcionTDFiltro, pagina, registrosPorPagina);
    // buscarDocumentos
    $(document).off("input", "#Descripcion").on("input", "#Descripcion", function (e) {
        e.preventDefault();
        descripcionTDFiltro = $('#Descripcion').val();
        pagina = 1

        // generarOpcionesPaginacion()
        loadTipoDocumentos(descripcionTDFiltro, pagina, registrosPorPagina);
        loadTotalTipoDocumentos(descripcionTDFiltro);
    })

    function loadTotalTipoDocumentos(descripcionTDFiltro) {
        $.ajax({
            url: './controllers/TipoDocumentos/totalTipoDocumentosRegistrados.php',
            method: 'GET',
            dataType: 'json',
            data: { descripcionTDFiltro},
            success: function (response) {
                // console.log(response);
                // return 
                console.log(response);
                let totalTDRegistradosInput = document.getElementById("totalTDRegistrados");
                totalTDRegistradosInput.innerText = response[0].total;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }
// ABRIR MODAL REGISTRAR AREA
$(document).off("click", "#btnRegistrarTipoDocumento").on("click", "#btnRegistrarTipoDocumento", function (e) {
    e.preventDefault();
    let modalRegistrar = $("#modalRegistrarTipoDocumento");
    $("#registrarTipoDocumentoForm").trigger("reset");

    modalRegistrar.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalRegistrar.modal('show');

    modalRegistrar.on('shown.bs.modal', function () {
        $("#descripcionTipoDocumentoNuevo").focus();
    });
});

// REGISTRAR AREA DIRECTO A BD
$(document).off('submit', '#registrarTipoDocumentoForm').on('submit', '#registrarTipoDocumentoForm', function (e) {
    e.preventDefault();

    let descripcion = $.trim($('#descripcionTipoDocumentoNuevo').val());

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
        url: "./controllers/TipoDocumentos/registrarTipoDocumento.php",
        type: "POST",
        datatype: "json",
        data: { descripcion: descripcion },
        success: function (response) {
            console.log(response);
            // return
            response = JSON.parse(response);
            if (response.message === 'Tipo Documento encontrado') {
                alert("Este Tipo de Documento ya se encuentra Registrado");
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
                    alert("SE REGISTRO EL TIPO DE DOCUMENTO");
                    // Swal.fire({
                    //     icon: "success",
                    //     title: "¡Éxito!",
                    //     text: response.message,
                    //     allowEnterKey: false,
                    //     allowEscapeKey: false,
                    //     allowOutsideClick: false,
                    //     stopKeydownPropagation: false
                    // }).then(() => {
                    $('#modalRegistrarTipoDocumento').modal('hide');
                    pagina = 1;
                    // generarOpcionesPaginacion();
                    loadTipoDocumentos(descripcionTDFiltro, pagina, registrosPorPagina);
                    loadTotalTipoDocumentos(descripcionTDFiltro);
                    // });
                } else {
                    alert("Error al Registrar el Tipo de Documentos");
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
$(document).on("click", "#btnEditarTipoDocumento", function (e) {
    e.preventDefault();
    let modalEditar = $("#modalEditarTipoDocumento");
    let fila = $(this).closest("tr");
    let idTipoDocumento = parseInt(fila.find('td:eq(0)').text());
    let descripcion = fila.find('td:eq(1)').text();
    let estado = fila.find('td:eq(2)').text();
    // descripcionDB = descripcion;
    $("#estadoTipoDocumento").val(estado.trim());
    $("#descripcionTipoDocumento").val(descripcion.trim());
        $("#idTipoDocumento").val(idTipoDocumento);

    modalEditar.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalEditar.modal('show');

    modalEditar.one('shown.bs.modal', function () {
        $("#descripcionTipoDocumento").focus();
    });
});

// Actualizar Area en Modelo
$(document).off('submit', '#editarTipoDocumentoForm').on('submit', '#editarTipoDocumentoForm', function (e) {
    e.preventDefault();
    $(this).off('submit'); // Desenganchar el evento de submit

    let estado = $.trim($('#estadoTipoDocumento').val());
    let descripcion = $.trim($('#descripcionTipoDocumento').val());
    let idTipoDocumento = $.trim($('#idTipoDocumento').val());

    if (descripcion.length === 0 || idTipoDocumento.length === 0) {
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
        url: "./controllers/TipoDocumentos/actualizarTipoDocumento.php",
        type: "POST",
        datatype: "json",
        data: { idTipoDocumento, descripcion,estado },
        success: function (response) {
            console.log(response);
            // return
            response = JSON.parse(response);
                if (response.status === 'success') {
                    alert("Se Actualizo el Tipo Documento");
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
                        $('#modalEditarTipoDocumento').modal('hide');
                        loadTipoDocumentos(descripcionTDFiltro,pagina, registrosPorPagina);
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
    url: './controllers/TipoDocumentos/listarTipoDocumentoCombo.php',
    method: 'GET',
    dataType: 'json',
    data: {},
    success: function(data) {
        // console.log(data);
        if (data && Array.isArray(data)) {
            let options = `<option disabled selected value="Seleccionar">Seleccionar</option>` +
                data.map(tipodoc =>
                    `<option value="${tipodoc.idTipoDocumento}">${tipodoc.Descripcion}</option>`
                ).join('');


            $('.selectTipoDocumento').html(options);
            
        } else {
            console.warn('No data received or data is not an array.');
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error fetching the content:', textStatus, errorThrown);
    }
});