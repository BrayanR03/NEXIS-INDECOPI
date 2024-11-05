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
    let descripcionTUFiltro = $('#Descripcion').val();

    function loadTipoUsuarios(descripcionTUFiltro = '', pagina, registrosPorPagina) {
        $.ajax({
            url: './controllers/TipoUsuarios/listarTipoUsuarios.php',
            method: 'POST',
            dataType: 'json',
            data: { descripcionTUFiltro, pagina, registrosPorPagina },
            success: function (response) {
                console.log(response);
                let { data } = response
                if (data.length > 0 && Array.isArray(data)) {
                    let row = data.map(tipousuario => `
                    <tr>
                        <td>${tipousuario.idTipoUsuario}</td>
                        <td>${tipousuario.Descripcion}</td>
                        <td>${tipousuario.Estado}</td>
                        <td>
                        <a href="#" id="btnEditarTipoUsuario" >Editar</a>
                        </td>

                    </tr>`).join('');
                    $('#bodyListaTipoUsuarios').html(row);
                } else {
                    let row = `<tr>
                        <td colSpan="10" className="mensajeSinRegistros"> Aún no existen tipos de usuario registrados</td>
                    </tr>`
                    $('#bodyListaTipoUsuarios').html(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    loadTotalTipoUsuarios(descripcionTUFiltro);
    loadTipoUsuarios(descripcionTUFiltro, pagina, registrosPorPagina);
    // buscarDocumentos
    $(document).off("input", "#Descripcion").on("input", "#Descripcion", function (e) {
        e.preventDefault();
        descripcionTUFiltro = $('#Descripcion').val();
        pagina = 1

        // generarOpcionesPaginacion()
        loadTipoUsuarios(descripcionTUFiltro, pagina, registrosPorPagina);
        loadTotalTipoUsuarios(descripcionTUFiltro);
    })

    function loadTotalTipoUsuarios(descripcionTUFiltro) {
        $.ajax({
            url: './controllers/TipoUsuarios/totalTipoUsuariosRegistrados.php',
            method: 'GET',
            dataType: 'json',
            data: { descripcionTUFiltro},
            success: function (response) {
                // console.log(response);
                // return 
                console.log(response);
                let totalTURegistradosInput = document.getElementById("totalTURegistrados");
                totalTURegistradosInput.innerText = response[0].total;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }
// ABRIR MODAL REGISTRAR AREA
$(document).off("click", "#btnRegistrarTipoUsuario").on("click", "#btnRegistrarTipoUsuario", function (e) {
    e.preventDefault();
    let modalRegistrar = $("#modalRegistrarTipoUsuario");
    $("#registrarTipoUsuarioForm").trigger("reset");

    modalRegistrar.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalRegistrar.modal('show');

    modalRegistrar.on('shown.bs.modal', function () {
        $("#descripcionTipoUsuarioNuevo").focus();
    });
});

// REGISTRAR AREA DIRECTO A BD
$(document).off('submit', '#registrarTipoUsuarioForm').on('submit', '#registrarTipoUsuarioForm', function (e) {
    e.preventDefault();

    let descripcion = $.trim($('#descripcionTipoUsuarioNuevo').val());

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
        url: "./controllers/TipoUsuarios/registrarTipoUsuarios.php",
        type: "POST",
        datatype: "json",
        data: { descripcion: descripcion },
        success: function (response) {
            console.log(response);
            // return
            response = JSON.parse(response);
            if (response.message === 'Tipo Usuario encontrado') {
                alert("Este Tipo de Usuario ya se encuentra Registrada");
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
                    alert("SE REGISTRO EL TIPO DE USUARIO");
                    // Swal.fire({
                    //     icon: "success",
                    //     title: "¡Éxito!",
                    //     text: response.message,
                    //     allowEnterKey: false,
                    //     allowEscapeKey: false,
                    //     allowOutsideClick: false,
                    //     stopKeydownPropagation: false
                    // }).then(() => {
                    $('#modalRegistrarTipoUsuario').modal('hide');
                    pagina = 1;
                    // generarOpcionesPaginacion();
                    loadTipoUsuarios(descripcionTUFiltro, pagina, registrosPorPagina);
                    loadTotalTipoUsuarios(descripcionTUFiltro);
                    // });
                } else {
                    alert("Error al Registrar el Tipo de Usuarios");
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
$(document).on("click", "#btnEditarTipoUsuario", function (e) {
    e.preventDefault();
    let modalEditar = $("#modalEditarTipoUsuario");
    let fila = $(this).closest("tr");
    let idTipoUsuario = parseInt(fila.find('td:eq(0)').text());
    let descripcion = fila.find('td:eq(1)').text();
    let estado = fila.find('td:eq(2)').text();
    // descripcionDB = descripcion;
    $("#estadoTipoUsuario").val(estado.trim());
    $("#descripcionTipoUsuario").val(descripcion.trim());
        $("#idTipoUsuario").val(idTipoUsuario);

    modalEditar.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalEditar.modal('show');

    modalEditar.one('shown.bs.modal', function () {
        $("#descripcionTipoUsuario").focus();
    });
});

// Actualizar Area en Modelo
$(document).off('submit', '#editarTipoUsuarioForm').on('submit', '#editarTipoUsuarioForm', function (e) {
    e.preventDefault();
    $(this).off('submit'); // Desenganchar el evento de submit

    let estado = $.trim($('#estadoTipoUsuario').val());
    let descripcion = $.trim($('#descripcionTipoUsuario').val());
    let idTipoUsuario = $.trim($('#idTipoUsuario').val());

    if (descripcion.length === 0 || idTipoUsuario.length === 0) {
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
        url: "./controllers/TipoUsuarios/actualizarTipoUsuario.php",
        type: "POST",
        datatype: "json",
        data: { idTipoUsuario, descripcion,estado },
        success: function (response) {
            console.log(response);
            // return
            response = JSON.parse(response);
                if (response.status === 'success') {
                    alert("Se Actualizo el Tipo Usuario");
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
                        $('#modalEditarTipoUsuario').modal('hide');
                        loadTipoUsuarios(descripcionTUFiltro,pagina, registrosPorPagina);
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
    url: './controllers/TipoUsuarios/listarTipoUsuariosCombo.php',
    method: 'GET',
    dataType: 'json',
    data: {},
    success: function(data) {
        // console.log(data);
        if (data && Array.isArray(data)) {
            let options = `<option disabled selected value="">Seleccionar</option>` +
                data.map(tipousuarios =>
                    `<option value="${tipousuarios.idTipoUsuario}">${tipousuarios.Descripcion}</option>`
                ).join('');


            $('.selectTipoUsuario').html(options);
        } else {
            console.warn('No data received or data is not an array.');
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error fetching the content:', textStatus, errorThrown);
    }
});