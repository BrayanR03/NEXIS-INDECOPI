$(document).ready(function () {
    console.log("INICIO DE AREAS.JS :D");
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
    let descripcionAreaFiltro = $('#Descripcion').val();



    // generarOpcionesPaginacion()

    function loadAreas(descripcionAreaFiltro = '', pagina, registrosPorPagina) {
        $.ajax({
            url: './controllers/Areas/listarAreas.php',
            method: 'POST',
            dataType: 'json',
            data: { descripcionAreaFiltro, pagina, registrosPorPagina },
            success: function (response) {
                console.log(response);
                let { data } = response
                if (data.length > 0 && Array.isArray(data)) {
                    let row = data.map(area => `
                    <tr>
                        <td>${area.idArea}</td>
                        <td>${area.Descripcion}</td>
                        <td>${area.Estado}</td>
                        <td>
                        <a href="#" id="btnEditarArea" >Editar</a>
                        </td>

                    </tr>`).join('');
                    $('#bodyListaAreas').html(row);
                } else {
                    let row = `<tr>
                        <td colSpan="10" className="mensajeSinRegistros"> Aún no existen áreas registradas</td>
                    </tr>`
                    $('#bodyListaAreas').html(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    loadTotalAreas(descripcionAreaFiltro);
    loadAreas(descripcionAreaFiltro, pagina, registrosPorPagina);
    // buscarDocumentos
    $(document).off("input", "#Descripcion").on("input", "#Descripcion", function (e) {
        e.preventDefault();
        descripcionAreaFiltro = $('#Descripcion').val();
        pagina = 1

        // generarOpcionesPaginacion()
        loadAreas(descripcionAreaFiltro, pagina, registrosPorPagina);
        loadTotalAreas(descripcionAreaFiltro);
    })

    function loadTotalAreas(descripcionAreaFiltro) {
        $.ajax({
            url: './controllers/Areas/totalAreasRegistradas.php',
            method: 'GET',
            dataType: 'json',
            data: { descripcionAreaFiltro },
            success: function (response) {
                // console.log(response);
                // return 
                console.log(response);
                let totalAreasInput = document.getElementById("totalAreasRegistradas");
                totalAreasInput.innerText = response[0].total;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }


    // ABRIR MODAL REGISTRAR AREA
    $(document).off("click", "#btnRegistrarArea").on("click", "#btnRegistrarArea", function (e) {
        e.preventDefault();
        let modalRegistrar = $("#modalRegistrarArea");
        $("#registrarAreaForm").trigger("reset");

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.on('shown.bs.modal', function () {
            $("#descripcionAreaNuevo").focus();
        });
    });

    // REGISTRAR AREA DIRECTO A BD
    $(document).off('submit', '#registrarAreaForm').on('submit', '#registrarAreaForm', function (e) {
        e.preventDefault();

        let descripcion = $.trim($('#descripcionAreaNuevo').val());

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
            url: "./controllers/Areas/registrarAreas.php",
            type: "POST",
            datatype: "json",
            data: { descripcion: descripcion },
            success: function (response) {
                console.log(response);
                // return
                response = JSON.parse(response);
                if (response.message === 'Area encontrada') {
                    alert("Esta Área ya se encuentra Registrada");
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
                        alert("SE REGISTRO EL ÁREA");
                        // Swal.fire({
                        //     icon: "success",
                        //     title: "¡Éxito!",
                        //     text: response.message,
                        //     allowEnterKey: false,
                        //     allowEscapeKey: false,
                        //     allowOutsideClick: false,
                        //     stopKeydownPropagation: false
                        // }).then(() => {
                        $('#modalRegistrarArea').modal('hide');
                        pagina = 1;
                        // generarOpcionesPaginacion();
                        loadAreas(descripcionAreaFiltro, pagina, registrosPorPagina);
                        loadTotalAreas(descripcionAreaFiltro);
                        // });
                    } else {
                        alert("Error al Registrar el Área");
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
    $(document).on("click", "#btnEditarArea", function (e) {
        e.preventDefault();
        let modalEditar = $("#modalEditarArea");
        let fila = $(this).closest("tr");
        let codArea = parseInt(fila.find('td:eq(0)').text());
        let descripcion = fila.find('td:eq(1)').text();
        let estado = fila.find('td:eq(2)').text();
        // descripcionDB = descripcion;
        $("#estadoArea").val(estado.trim());
        $("#descripcionArea").val(descripcion.trim());
        $("#codArea").val(codArea);

        modalEditar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalEditar.modal('show');

        modalEditar.one('shown.bs.modal', function () {
            $("#descripcionArea").focus();
        });
    });

    // Actualizar Area en Modelo
    $(document).off('submit', '#editarAreaForm').on('submit', '#editarAreaForm', function (e) {
        e.preventDefault();
        $(this).off('submit'); // Desenganchar el evento de submit

        let estado = $.trim($('#estadoArea').val());
        let descripcion = $.trim($('#descripcionArea').val());
        let codArea = $.trim($('#codArea').val());

        if (descripcion.length === 0 || codArea.length === 0) {
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
        //     alert("Para actualizar el área tiene que tener una nueva descripción.");
        //     return;
        // }

        // descripcion = capitalizeWords(descripcion);

        $.ajax({
            url: "./controllers/Areas/actualizarAreas.php",
            type: "POST",
            datatype: "json",
            data: { codArea, descripcion,estado },
            success: function (response) {
                console.log(response);
                // return
                response = JSON.parse(response);
                // if (response.message === 'Area encontrada') {
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
                        alert("Se Actualizo el Área");
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
                            $('#modalEditarArea').modal('hide');
                            loadAreas(descripcionAreaFiltro,pagina, registrosPorPagina);
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


// Estado del Area
$(document).on("click", "#btnEstadoArea", function (e) {
    e.preventDefault();
    let modalEstado = $("#modalEstadoArea");
    let fila = $(this).closest("tr");
    let codArea = parseInt(fila.find('td:eq(0)').text());
    let descripcion = fila.find('td:eq(1)').text();
    let estadoArea = fila.find('td:eq(2)').text();
    // descripcionDB = descripcion;
    estadoAreaBD=estadoArea;
    // if(estadoArea.trim()=="Habilitada"){

    //     $("#estadoArea").val(estadoArea.trim());
    // }else{
        
    $("#estadoArea").val(estadoArea);
    // }
    $("#descripcionAreaEstado").val(descripcion.trim());
    $("#codAreaEstado").val(codArea);

    modalEstado.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalEstado.modal('show');

    modalEstado.one('shown.bs.modal', function () {
        $("#estadoArea").focus();
    });
});

// Actualizar Rstado Area en Modelo
$(document).off('submit', '#editarEstadoAreaForm').on('submit', '#editarEstadoAreaForm', function (e) {
    e.preventDefault();
    $(this).off('submit'); // Desenganchar el evento de submit

    let estado=$('#estadoArea').val();
    let descripcion = $.trim($('#descripcionAreaEstado').val());
    let codArea = $.trim($('#codAreaEstado').val());

    if (descripcion.length === 0 || codArea.length === 0) {
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
        url: "./controllers/Areas/estadoAreas.php",
        type: "POST",
        datatype: "json",
        data: { codArea, descripcion,estado },
        success: function (response) {
            console.log(response);
            // return
            response = JSON.parse(response);
                if (response.status === 'success') {
                    alert("Se Actualizo el Área");
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
                        $('#modalEstadoArea').modal('hide');
                        loadAreas(descripcionAreaFiltro,pagina, registrosPorPagina);
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


    // function generarOpcionesPaginacion() {

    //     $.ajax({
    //         url: './controllers/Areas/totalAreasRegistradas.php',
    //         method: 'GET',
    //         dataType: 'json',
    //         success: function(response) {
    //             let { data } = response;
    //             let totalAreas = data[0]['total']
    //             // let totalPaginas = Math.ceil(totalAreas/registrosPorPagina);

    //             $('#totalAreasRegistradas').text(totalAreas)

    //             // let paginas = '';
    //             // for (let i = 0; i < totalPaginas; i++){
    //             //     paginas+= `<li class="optionPage${i+1==pagina ? ' selectedPage' : ''}" id=${i+1}> ${i+1} </li>`
    //             // }

    //             // $('#opcionesPaginacionAreas').html(paginas)
    //         },
    //         error: function (jqXHR, textStatus, errorThrown) {
    //             console.error('Error fetching the content:', textStatus, errorThrown);
    //         }
    //     });
    // }


});

    // // llenar select
    // $.ajax({
    //     url: './controllers/Areas/listarAreasCombo.php',
    //     method: 'GET',
    //     dataType: 'json',
    //     data: {},
    //     success: function(data) {
    //         // console.log(data);
    //         if (data && Array.isArray(data)) {
    //             let options = `<option disabled selected value="Seleccionar">Seleccionar</option>` +
    //                 data.map(area =>
    //                     `<option value="${area.idArea}">${area.Descripcion}</option>`
    //                 ).join('');
    
    
    //             $('.selectArea').html(options);
                
    //         } else {
    //             console.warn('No data received or data is not an array.');
    //         }
    //     },
    //     error: function(jqXHR, textStatus, errorThrown) {
    //         console.error('Error fetching the content:', textStatus, errorThrown);
    //     }
    
    // });