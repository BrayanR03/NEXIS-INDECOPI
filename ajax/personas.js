$(document).ready(function () {
    console.log("INICIO DE PERSONAS.JS :D");
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



    // ABRIR MODAL REGISTRAR PERSONA
    $(document).off("click", "#btnSolicitarCasilla").on("click", "#btnSolicitarCasilla", function (e) {
        e.preventDefault();
        let modalRegistrar = $("#modalRegistrarPersona");
        $("#registrarPersonaForm").trigger("reset");

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.on('shown.bs.modal', function () {
            // $("#nombresPersonaNuevo").focus();
            // $("#numDocumentoIdentidadPersonaNuevo").disabled=false;
            // email.disabled=false;
            // domicilio.disabled=false;
            // numDocumento.disabled=false;
        });
    });

    // REGISTRAR PERSONA DIRECTO A BD
    $(document).off('submit', '#registrarPersonaForm').on('submit', '#registrarPersonaForm', function (e) {
        e.preventDefault();

        // let dni = $.trim($('#dniPersonaNuevo').val());
        let razonSocialPersonaNuevo= $.trim($('#razonSocialPersonaNuevo').val());
        console.log(razonSocialPersonaNuevo);
        let nombres = $.trim($('#nombresPersonaNuevo').val());
        let apellidos = $.trim($('#apellidosPersonaNuevo').val());
        // let apellidoPaterno = $.trim($('#apellidoPaternoPersonaNuevo').val());
        // let apellidoMaterno = $.trim($('#apellidoMaternoPersonaNuevo').val());
        let dniCUI = $.trim($('#CUIPersonaNuevo').val());
        let email = $.trim($('#emailPersonaNuevo').val());
        let telefono = $.trim($('#telefonoPersonaNuevo').val());
        let domicilio = $.trim($('#domicilioPersonaNuevo').val());
        let tipoPersona = $('#tipoPersonaPersonaNuevo').val();
        let tipoDocumentoIdentidad = $('#tipoDocumentoIdentidadPersonaNuevo').val();
        let numDocumentoIdentidad = $.trim($('#numDocumentoIdentidadPersonaNuevo').val());
        let representanteLegal = $.trim($('#representanteLegalPersonaNuevo').val());
        if(tipoPersona==='Seleccionar'){alert('Debes seleccionar un tipo de persona, para solicitar tu casilla.!!'); return}

        if (email.length === 0 ||
            telefono.length === 0 || domicilio.length === 0 || numDocumentoIdentidad.length === 0) {
            alert("Campos Vacíos");
            return
        }

        // descripcion = capitalizeWords(descripcion);

        $.ajax({
            url: "./controllers/Personas/registrarPersona.php",
            type: "POST",
            datatype: "json",
            data: {
                nombres: nombres, apellidos: apellidos, dniCUI: dniCUI, email: email,
                telefono: telefono, domicilio: domicilio, tipoPersona: tipoPersona, tipoDocumentoIdentidad: tipoDocumentoIdentidad, numDocumentoIdentidad: numDocumentoIdentidad,
                representanteLegal: representanteLegal,razonSocialPersonaNuevo:razonSocialPersonaNuevo
            },
            success: function (response) {
                console.log(response);
                // return
                response = JSON.parse(response);
                if (response.message === 'NumDoc encontrado') {
                    alert("Ya te encuentras registrado!!!");
                } else {
                    if (response.status === 'success') {
                        alert("SE REGISTRO EL LA PERSONA");
                        $('#modalRegistrarPersona').modal('hide');
                        
                        pagina = 1;
                        loadPersonas(datosBusquedaFiltro, filtroBusqueda, pagina, registrosPorPagina);
                        loadTotalPersonas(datosBusquedaFiltro, filtroBusqueda);
                        vistaNormal();
                    } else {
                        alert("Error al Registrar la Persona");
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error updating the area:', textStatus, errorThrown);
            }
        });
    });


    let pagina = 1;
    let datosBusquedaFiltro = $('#datosBusquedaFiltro').val();
    // let numDocumentoIdentidadPersonaFiltro = $('#numDocumentoIdentidadPersonaFiltro').val();
    let filtroBusqueda = document.querySelector('input[name="filtroBusqueda"]:checked').value;
    //CARGAR LISTA DE PERSONAS
    function loadPersonas(datosBusquedaFiltro = '', filtroBusqueda = '', pagina, registrosPorPagina) {
        console.log("Antes de entrar al AJAX");
        $.ajax({
            url: './controllers/Personas/listarPersonas.php',
            method: 'POST',
            dataType: 'json',
            data: { datosBusquedaFiltro, filtroBusqueda, pagina, registrosPorPagina },
            success: function (response) {
                console.log("DENTRO DEL SUCECSS");
                // console.log(response);
                // return
                let { data } = response
                if (data.length > 0 && Array.isArray(data)) {
                    let row = data.map(persona => `
                    <tr>
                        <td>${persona.idPersona}</td>
                        <td>${persona.Nombres}</td>
                        <td>${persona.Apellidos ? persona.Apellidos:''}</td>
                        <td>${persona.Email}</td>
                        <td>${persona.Telefono}</td>
                        <td>${persona.Domicilio}</td>
                        <td hidden>${persona.idTipoPersona}</td>
                        <td>${persona.TipoPersona}</td>
                        <td hidden>${persona.idTipoDocumentoIdentidad}</td>
                        <td>${persona.TipoDocumentoIdentidad}</td>
                        <td>${persona.NroDocumentoIdentidad}</td>
                        <td>${persona.DniCUI  ? persona.DniCUI : ''}</td>
                        <td>${persona.RepresentanteLegal ? persona.RepresentanteLegal : ''}</td>
                        <td>${persona.Estado}</td>
                        <td>
                        <a href="#" id="btnEditarPersona" >Editar</a>
                        </td>
    
                    </tr>`).join('');
                    $('#bodyListaPersonas').html(row);
                } else {
                    let row = `<tr>
                        <td colSpan="10" className="mensajeSinRegistros"> Aún no existen personas registradas</td>
                    </tr>`
                    $('#bodyListaPersonas').html(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }
    loadTotalPersonas(datosBusquedaFiltro, filtroBusqueda);
    loadPersonas(datosBusquedaFiltro, filtroBusqueda, pagina, registrosPorPagina);
    // buscarPersonas
    // $(document).off("input", "#datosBusquedaFiltro").on("input", "#datosBusquedaFiltro", function (e) {
    $(document).off("input change", "#datosBusquedaFiltro, input[name='filtroBusqueda']").on("input change", "#datosBusquedaFiltro, input[name='filtroBusqueda']", function (e) {
        e.preventDefault();
        datosBusquedaFiltro = $('#datosBusquedaFiltro').val();
        filtroBusqueda = document.querySelector('input[name="filtroBusqueda"]:checked').value;
        pagina = 1
        console.log("FILTRO DINAMICO");
        console.log(datosBusquedaFiltro);
        console.log(filtroBusqueda);

        // generarOpcionesPaginacion()
        loadPersonas(datosBusquedaFiltro, filtroBusqueda, pagina, registrosPorPagina);
        loadTotalPersonas(datosBusquedaFiltro, filtroBusqueda);
    })
    // Listener para el cambio de selección del radio button
    // $(document).off("change", "input[name='filtroBusqueda']").on("change", "input[name='filtroBusqueda']", function (e) {
    //     // Actualizar el filtro seleccionado cuando se cambie el radio button
    //     e.preventDefault();
    //     filtroBusqueda=document.querySelector('input[name="filtroBusqueda"]:checked').value;

    //     // Obtener el valor actual del input de búsqueda
    //     datosBusquedaFiltro = $('#datosBusquedaFiltro').val();
    //     pagina = 1;

    //     // Cargar personas y el total basado en el nuevo filtro y el texto ingresado
    //     loadPersonas(datosBusquedaFiltro, filtroBusqueda, pagina, registrosPorPagina);
    //     loadTotalPersonas(datosBusquedaFiltro, filtroBusqueda);
    // });
    function loadTotalPersonas(datosBusquedaFiltro, filtroBusqueda) {
        console.log("ANTES DE AJAX, FUNCION TOTAL PERSONAS");
        $.ajax({
            url: './controllers/Personas/totalPersonasRegistradas.php',
            method: 'GET',
            dataType: 'json',
            data: { datosBusquedaFiltro, filtroBusqueda },
            success: function (response) {
                // console.log(response);
                // return 
                console.log(response);
                let totalPersonasInput = document.getElementById("totalPersonasRegistradas");
                totalPersonasInput.innerText = response[0].total;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    function vistaNormal(){
        const nombresDiv = document.querySelector('.nombresPersonaDiv'); // Div de Nombres
        const apellidosDiv = document.querySelector('.apellidosPersonaDiv'); // Div de Apellidos
        const dniCUIDiv = document.querySelector('.dniCUIDiv'); // Div de DNI CUI
        const representanteLegalDiv = document.querySelector('.representanteLegalDiv'); // Div de Representante Legal
        const razonSocialDiv = document.querySelector('.razonSocialDiv');
        const tipoDocumentoSelect = document.getElementById('tipoDocumentoIdentidadPersonaNuevo');
        const telefono = document.getElementById('telefonoPersonaNuevo');
        const numDocumento = document.getElementById('numDocumentoIdentidadPersonaNuevo');
        const email = document.getElementById('emailPersonaNuevo');
        const domicilio = document.getElementById('domicilioPersonaNuevo');
        nombresDiv.hidden = true;
        apellidosDiv.hidden = true;
        dniCUIDiv.hidden = true;
        razonSocialDiv.hidden = true;
        representanteLegalDiv.hidden = true;
        telefono.disabled = true;
        email.disabled = true;
        domicilio.disabled = true;
        numDocumento.disabled = true;
        tipoDocumentoSelect.disabled=true;

        $("#representanteLegalPersonaNuevo").val("");
        $("#numDocumentoIdentidadPersonaNuevo").val("");
        $("#CUIPersonaNuevo").val("");
        $("#razonSocialPersonaNuevo").val("");
        $("#nombresPersonaNuevo").val("");
        $("#apellidosPersonaNuevo").val("");
        $("#emailPersonaNuevo").val("");
        $("#telefonoPersonaNuevo").val("");
        $("#domicilioPersonaNuevo").val("");
    }

    let datosBusquedaFiltroBD = '';

    // Editar Persona
    $(document).on("click", "#btnEditarPersona", function (e) {
        e.preventDefault();
        let modalEditar = $("#modalEditarPersona");
        let fila = $(this).closest("tr");
        let idPersona = parseInt(fila.find('td:eq(0)').text());
        let nombres = fila.find('td:eq(1)').text();
        let apellidos = fila.find('td:eq(2)').text();
        let email = fila.find('td:eq(3)').text();
        let telefono = fila.find('td:eq(4)').text();
        let domicilio = fila.find('td:eq(5)').text();
        let idTipoPersona = fila.find('td:eq(6)').text();
        let tipoPersona = fila.find('td:eq(7)').text();
        let idTipoDocumentoIdentidad = parseInt(fila.find('td:eq(8)').text());
        let tipoDocumentoIdentidad = fila.find('td:eq(9)').text();
        let numDocumentoIdentidad = fila.find('td:eq(10)').text();
        let dniCUI = fila.find('td:eq(11)').text();
        let representanteLegal = fila.find('td:eq(12)').text();
        let estadoPersonaEditar = fila.find('td:eq(13)').text();
        
        $("#nombresPersona").val(nombres.trim());
        $("#apellidosPersona").val(apellidos.trim());
        $("#emailPersona").val(email.trim());
        $("#telefonoPersona").val(telefono.trim());
        $("#domicilioPersona").val(domicilio.trim());
        $("#tipoPersonaEditar").val(idTipoPersona);
        $("#tipoDocumentoIdentidadEditar").val(idTipoDocumentoIdentidad);
        $("#numDocumentoIdentidad").val(numDocumentoIdentidad.trim());
        $("#CUIPersona").val(dniCUI.trim());
        $("#representanteLegal").val(representanteLegal.trim());
        $("#estadoPersonaEditar").val(estadoPersonaEditar);
        $("#idPersona").val(idPersona);

        modalEditar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalEditar.modal('show');

        modalEditar.one('shown.bs.modal', function () {
            $("#nombresPersona").focus();
        });
    });

    // Actualizar Area en Modelo
    $(document).off('submit', '#editarPersonaForm').on('submit', '#editarPersonaForm', function (e) {
        e.preventDefault();
        $(this).off('submit'); // Desenganchar el evento de submit

        let nombres = $.trim($('#nombresPersona').val());
        let apellidos = $.trim($('#apellidosPersona').val());
        let email = $.trim($('#emailPersona').val());
        let telefono = $.trim($('#telefonoPersona').val());
        let domicilio = $.trim($('#domicilioPersona').val());
        // let idTipoPersona = $('#tipoPersona').val();
        let tipoPersona = $('#tipoPersonaEditar').val();
        // let idTipoDocumentoIdentidad = $('#tipoDocumentoIdentidad').val();
        let tipoDocumentoIdentidad = $('#tipoDocumentoIdentidadEditar').val();
        let numDocumentoIdentidad = $.trim($('#numDocumentoIdentidad').val());
        let dniCUI = $.trim($('#CUIPersona').val());
        let representanteLegal = $.trim($('#representanteLegal').val());
        let estadoPersonaEditar = $.trim($('#estadoPersonaEditar').val());
        let idPersona = $.trim($('#idPersona').val());

        // if(idTipoPersona==='NATURAL' || idTipoPersona==='Natural'){
        //     idTipoPersona=1;
        // }else{
        //     idTipoPersona=2;
        // }

        // if(idTipoDocumentoIdentidad==='Dni'){
        //     idTipoDocumentoIdentidad=1;
        // }else if(idTipoDocumentoIdentidad==='Ruc'){
        //     idTipoDocumentoIdentidad=2;
        // }else{
        //     idTipoDocumentoIdentidad=3;
        // }
        if (nombres.length === 0 || apellidos.length === 0 || email.length === 0 ||
            telefono.length === 0 || domicilio.length === 0 || numDocumentoIdentidad.length === 0 || idPersona.length === 0 ) {

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
            url: "./controllers/Personas/actualizarPersonas.php",
            type: "POST",
            datatype: "json",
            data: {
                idPersona, nombres, apellidos, email, telefono, domicilio, tipoPersona, tipoDocumentoIdentidad,
                numDocumentoIdentidad, dniCUI, representanteLegal, estadoPersonaEditar
            },
            success: function (response) {
                console.log(response);
                // return
                response = JSON.parse(response);
                if (response.message === 'Persona encontrada') {
                    alert("La persona que intenta actualizar ya existe en la base de datos");
                    return;
                    // Swal.fire({
                    //     icon: "warning",
                    //     title: "¡Advertencia!",
                    //     text: "La descripción que intenta actualizar ya existe en la base de datos",
                    //     allowEnterKey: false,
                    //     allowEscapeKey: false,
                    //     allowOutsideClick: false,
                    //     stopKeydownPropagation: false
                    // });
                } else {
                    if (response.status === 'success') {
                        alert("Se Actualizo la Persona");
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
                        $('#modalEditarPersona').modal('hide');
                        loadPersonas(datosBusquedaFiltro, filtroBusqueda, pagina, registrosPorPagina);
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
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error updating the area:', textStatus, errorThrown);
            }
        });
    });


// Estado de la persona
$(document).on("click", "#btnEstadoPersona", function (e) {

    e.preventDefault();
    let modalEstado = $("#modalEstadoPersona");
    let fila = $(this).closest("tr");
    let idPersona = parseInt(fila.find('td:eq(0)').text());
    let nombres = fila.find('td:eq(1)').text() +' '+ fila.find('td:eq(2)').text();;
    let estadoPersona = fila.find('td:eq(13)').text();
    nombresBD = nombres;
    estadoPersonaBD=estadoPersona;
    $("#estadoPersona").val(estadoPersona);
    // }
    $("#nombresPersonaEstado").val(nombres.trim());
    $("#idPersonaEstado").val(idPersona);

    modalEstado.modal({
        backdrop: 'static',
        keyboard: false
    });

    modalEstado.modal('show');

    modalEstado.one('shown.bs.modal', function () {
        $("#estadoPersona").focus();
    });
});

// Actualizar Estado Persona en Modelo
$(document).off('submit', '#editarEstadoPersonaForm').on('submit', '#editarEstadoPersonaForm', function (e) {
    e.preventDefault();
    $(this).off('submit'); // Desenganchar el evento de submit

    let estado=$('#estadoPersona').val();
    let nombres = $.trim($('#nombresPersonaEstado').val());
    let idPersona = $.trim($('#idPersonaEstado').val());
    // console.log(idPersona);
    if (nombres.length === 0 || idPersona.length === 0) {
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
        url: "./controllers/Personas/estadoPersona.php",
        type: "POST",
        datatype: "json",
        data: { idPersona, nombres,estado },
        success: function (response) {
            console.log(response);
            // return
            response = JSON.parse(response);
                if (response.status === 'success') {
                    alert("Se Actualizo el estado de la Persona");
                    
                        $('#modalEstadoPersona').modal('hide');
                        loadPersonas(datosBusquedaFiltro, filtroBusqueda, pagina, registrosPorPagina);
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