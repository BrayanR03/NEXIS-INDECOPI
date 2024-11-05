$(document).ready(function () {
    console.log("INICIO DE SEDES.JS :D");
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
    let descripcionSedeFiltro = $('#Descripcion').val();

 // generarOpcionesPaginacion()

 function loadSedes(descripcionSedeFiltro = '', pagina, registrosPorPagina) {
    $.ajax({
        url: './controllers/sedes/listarSedes.php',
        method: 'POST',
        dataType: 'json',
        data: { descripcionSedeFiltro, pagina, registrosPorPagina },
        success: function (response) {
            console.log(response);
            let { data } = response
            if (data.length > 0 && Array.isArray(data)) {
                let row = data.map(sede => `
                <tr>
                    <td>${sede.idSede}</td>
                    <td>${sede.Descripcion}</td>
                    <td>${sede.Estado}</td>
                    <td>
                    <a href="#" id="btnEditarSede" >Editar</a>
                    </td>

                </tr>`).join('');
                $('#bodyListaSedes').html(row);
            } else {
                let row = `<tr>
                    <td colSpan="10" className="mensajeSinRegistros"> Aún no existen sedes registradas</td>
                </tr>`
                $('#bodyListaSedes').html(row);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error fetching the content:', textStatus, errorThrown);
        }
    });
}

loadTotalSedes(descripcionSedeFiltro);
loadSedes(descripcionSedeFiltro, pagina, registrosPorPagina);

// buscarDocumentos
$(document).off("input", "#Descripcion").on("input", "#Descripcion", function (e) {
    e.preventDefault();
    descripcionSedeFiltro = $('#Descripcion').val();
    pagina = 1

    // generarOpcionesPaginacion()
    loadSedes(descripcionSedeFiltro, pagina, registrosPorPagina);
    loadTotalSedes(descripcionSedeFiltro);
})

function loadTotalSedes(descripcionSedeFiltro) {
    $.ajax({
        url: './controllers/sedes/totalSedesRegistradas.php',
        method: 'GET',
        dataType: 'json',
        data: { descripcionSedeFiltro},
        success: function (response) {
            // console.log(response);
            // return 
            console.log(response);
            let totalSedesInput = document.getElementById("totalSedesRegistradas");
            totalSedesInput.innerText = response[0].total;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error fetching the content:', textStatus, errorThrown);
        }
    });
}


    // ABRIR MODAL REGISTRAR SEDE
    $(document).off("click", "#btnRegistrarSede").on("click", "#btnRegistrarSede", function (e) {
        e.preventDefault();
        let modalRegistrar = $("#modalRegistrarSede");
        $("#registrarSedeForm").trigger("reset");

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.on('shown.bs.modal', function () {
            $("#descripcionSedeNuevo").focus();
        });
    });

    // REGISTRAR SEDE DIRECTO A BD
    $(document).off('submit', '#registrarSedeForm').on('submit', '#registrarSedeForm', function (e) {
        e.preventDefault();

        let descripcion = $.trim($('#descripcionSedeNuevo').val());

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
            url: "./controllers/sedes/registrarSedes.php",
            type: "POST",
            datatype: "json",
            data: { descripcion: descripcion },
            success: function (response) {
                console.log(response);
                // return
                response = JSON.parse(response);
                if (response.message === 'Sede encontrada') {
                    alert("Esta Sede ya se encuentra Registrada");
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
                        alert("SE REGISTRO LA SEDE");
                        // Swal.fire({
                        //     icon: "success",
                        //     title: "¡Éxito!",
                        //     text: response.message,
                        //     allowEnterKey: false,
                        //     allowEscapeKey: false,
                        //     allowOutsideClick: false,
                        //     stopKeydownPropagation: false
                        // }).then(() => {
                        $('#modalRegistrarSede').modal('hide');
                        pagina = 1;
                        // generarOpcionesPaginacion();
                        loadSedes(descripcionSedeFiltro, pagina, registrosPorPagina);
                        // });
                    } else {
                        alert("Error al Registrar la Sede");
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



    // Editar Sede
    $(document).on("click", "#btnEditarSede", function (e) {
        e.preventDefault();
        let modalEditar = $("#modalEditarSede");
        let fila = $(this).closest("tr");
        let idSede = parseInt(fila.find('td:eq(0)').text());
        let descripcion = fila.find('td:eq(1)').text();
        let estado = fila.find('td:eq(2)').text();
        // descripcionDB = descripcion;
        $("#estadoSede").val(estado.trim());
        $("#descripcionSede").val(descripcion.trim());
        $("#idSede").val(idSede);

        modalEditar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalEditar.modal('show');

        modalEditar.one('shown.bs.modal', function () {
            $("#descripcionSede").focus();
        });
    });

    // Actualizar Sede en Modelo
    $(document).off('submit', '#editarSedeForm').on('submit', '#editarSedeForm', function (e) {
        e.preventDefault();
        $(this).off('submit'); // Desenganchar el evento de submit

        let estado = $.trim($('#estadoSede').val());
        let descripcion = $.trim($('#descripcionSede').val());
        let idSede = $.trim($('#idSede').val());

        if (descripcion.length === 0 || idSede.length === 0) {
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

        // if (descripcionDB === descripcion) {
        //     // Swal.fire({
        //     //     icon: "warning",
        //     //     title: "¡Advertencia!",
        //     //     text: "Para actualizar el área tiene que tener una nueva descripción.",
        //     //     allowEnterKey: false,
        //     //     allowEscapeKey: false,
        //     //     allowOutsideClick: false,
        //     //     stopKeydownPropagation: false
        //     // });
        //     // return;
        //     alert("Para actualizar la sede tiene que tener una nueva descripción.");
        //     return;
        // }

        // descripcion = capitalizeWords(descripcion);

        $.ajax({
            url: "./controllers/sedes/actualizarSede.php",
            type: "POST",
            datatype: "json",
            data: { idSede, descripcion,estado },
            success: function (response) {
                console.log(response);
                // return
                response = JSON.parse(response);
                // if (response.message === 'Sede encontrada') {
                //     alert("La descripción que intenta actualizar ya existe en la base de datos");
                //     return;
                //     // Swal.fire({
                //     //     icon: "warning",
                //     //     title: "¡Advertencia!",
                //     //     text: "La descripción que intenta actualizar ya existe en la base de datos",
                //     //     allowEnterKey: false,
                //     //     allowEscapeKey: false,
                //     //     allowOutsideClick: false,
                //     //     stopKeydownPropagation: false
                //     // });
                // } else {
                    if (response.status === 'success') {
                        alert("Se Actualizo la Sede");
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
                            $('#modalEditarSede').modal('hide');
                            loadSedes(descripcionSedeFiltro,pagina, registrosPorPagina);
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

    // Estado de la Sede
$(document).on("click", "#btnEstadoSede", function (e) {
    e.preventDefault();
    let modalEstado = $("#modalEstadoSede");
    let fila = $(this).closest("tr");
    let idSede = parseInt(fila.find('td:eq(0)').text());
    let descripcion = fila.find('td:eq(1)').text();
    let estadoSede = fila.find('td:eq(2)').text();
    // descripcionDB = descripcion;
    estadoSedeBD=estadoSede;
    // if(estadoArea.trim()=="Habilitada"){

    //     $("#estadoArea").val(estadoArea.trim());
    // }else{
        
    $("#estadoSede").val(estadoSede);
    // }
    $("#descripcionSedeEstado").val(descripcion.trim());
    $("#idSedeEstado").val(idSede);

    modalEstado.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalEstado.modal('show');

    modalEstado.one('shown.bs.modal', function () {
        $("#estadoSede").focus();
    });
});

// Actualizar Rstado Sede en Modelo
$(document).off('submit', '#editarEstadoSedeForm').on('submit', '#editarEstadoSedeForm', function (e) {
    e.preventDefault();
    $(this).off('submit'); // Desenganchar el evento de submit

    let estado=$('#estadoSede').val();
    let descripcion = $.trim($('#descripcionSedeEstado').val());
    let idSede = $.trim($('#idSedeEstado').val());

    if (descripcion.length === 0 || idSede.length === 0) {
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
        url: "./controllers/sedes/estadoSedes.php",
        type: "POST",
        datatype: "json",
        data: { idSede, descripcion,estado },
        success: function (response) {
            console.log(response);
            // return
            response = JSON.parse(response);
                if (response.status === 'success') {
                    alert("Se Actualizo la Sede");
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
                        $('#modalEstadoSede').modal('hide');
                        loadSedes(descripcionSedeFiltro,pagina, registrosPorPagina);
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

//  // llenar select
//  $.ajax({
//     url: './controllers/Sedes/listarSedesCombo.php',
//     method: 'GET',
//     dataType: 'json',
//     data: {},
//     success: function(data) {
//         // console.log(data);
//         if (data && Array.isArray(data)) {
//             let options = `<option disabled selected value="Seleccionar">Seleccionar</option>` +
//                 data.map(sede =>
//                     `<option value="${sede.idSede}">${sede.Descripcion}</option>`
//                 ).join('');


//             $('.selectSede').html(options);
            
//         } else {
//             console.warn('No data received or data is not an array.');
//         }
//     },
//     error: function(jqXHR, textStatus, errorThrown) {
//         console.error('Error fetching the content:', textStatus, errorThrown);
//     }

// });