$(document).ready(function () {

    function loadInformacionUsuarioPerfil(usuario) {
        $.ajax({
            url: './controllers/Usuario/perfilUsuario.php',
            method: 'POST',
            dataType: 'json',
            data: { usuario },
            success: function (response) {
                console.log(response);
                // return
                let { data } = response
                if (data.length > 0 && Array.isArray(data)) {

                    let perfil = data[0];
                    //natural admin
                    $("#idUsuarioNaturalAdministrador").val(parseInt(perfil.idUsuario));
                    $('#tipoPersonaNaturalAdministrador').val(parseInt(perfil.TipoPersona));
                    $('#tipoDocumentoIdentidadNaturalAdministrador').val(parseInt(perfil.TipoDocumentoIdentidad));
                    $('#numDocumentoIdentidadNaturalAdministrador').val(perfil.NroDocumentoIdentidad);
                    $('#CUIPersonaNaturalAdministrador').val(perfil.DniCUI);
                    $('#nombresPersonaNaturalAdministrador').val(perfil.Nombres);
                    $('#apellidosPersonaNaturalAdministrador').val(perfil.Apellidos);
                    $('#emailPersonaNaturalAdministrador').val(perfil.Email);
                    $('#telefonoPersonaNaturalAdministrador').val(perfil.Telefono);
                    $('#domicilioPersonaNaturalAdministrador').val(perfil.Domicilio);
                    $('#usuarioNaturalAdministrador').val(perfil.Usuario);

                } else {
                    alert("No se encontraron datos para este usuario");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }
    function loadInformacionUsuarioNaturalAdministradorPerfil(usuario) {
        $.ajax({
            url: './controllers/Usuario/perfilUsuario.php',
            method: 'POST',
            dataType: 'json',
            data: { usuario },
            success: function (response) {
                console.log(response);
                // return
                let { data } = response
                if (data.length > 0 && Array.isArray(data)) {

                    let perfil = data[0];
                    //natural admin
                    $("#idUsuarioNaturalAdministrador").val(parseInt(perfil.idUsuario));
                    $('#tipoPersonaNaturalAdministrador').val(parseInt(perfil.TipoPersona));
                    $('#tipoDocumentoIdentidadNaturalAdministrador').val(parseInt(perfil.TipoDocumentoIdentidad));
                    $('#numDocumentoIdentidadNaturalAdministrador').val(perfil.NroDocumentoIdentidad);
                    $('#CUIPersonaNaturalAdministrador').val(perfil.DniCUI);
                    $('#nombresPersonaNaturalAdministrador').val(perfil.Nombres);
                    $('#apellidosPersonaNaturalAdministrador').val(perfil.Apellidos);
                    $('#emailPersonaNaturalAdministrador').val(perfil.Email);
                    $('#telefonoPersonaNaturalAdministrador').val(perfil.Telefono);
                    $('#domicilioPersonaNaturalAdministrador').val(perfil.Domicilio);
                    $('#usuarioNaturalAdministrador').val(perfil.Usuario);

                } else {
                    alert("No se encontraron datos para este usuario");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    function loadInformacionUsuarioJuridicoAdministradorPerfil(usuario) {
        $.ajax({
            url: './controllers/Usuario/perfilUsuario.php',
            method: 'POST',
            dataType: 'json',
            data: { usuario },
            success: function (response) {
                console.log(response);
                // return
                let { data } = response
                if (data.length > 0 && Array.isArray(data)) {

                    let perfil = data[0];
                    //natural admin
                    $("#idUsuarioJuridicoAdministrador").val(parseInt(perfil.idUsuario));
                    $('#tipoPersonaJuridicoAdministrador').val(parseInt(perfil.TipoPersona));
                    $('#tipoDocumentoIdentidadJuridicoAdministrador').val(parseInt(perfil.TipoDocumentoIdentidad));
                    $('#numDocumentoIdentidadJuridicoAdministrador').val(perfil.NroDocumentoIdentidad);
                    $('#CUIPersonaJuridicoAdministrador').val(perfil.DniCUI);
                    $('#nombresPersonaJuridicoAdministrador').val(perfil.Nombres);
                    $('#apellidosPersonaJuridicoAdministrador').val(perfil.Apellidos);
                    $('#emailPersonaJuridicoAdministrador').val(perfil.Email);
                    $('#telefonoPersonaJuridicoAdministrador').val(perfil.Telefono);
                    $('#domicilioPersonaJuridicoAdministrador').val(perfil.Domicilio);
                    $('#usuarioJuridicoAdministrador').val(perfil.Usuario);

                } else {
                    alert("No se encontraron datos para este usuario");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    function loadInformacionUsuarioNaturalNormalPerfil(usuario) {
        $.ajax({
            url: './controllers/Usuario/perfilUsuario.php',
            method: 'POST',
            dataType: 'json',
            data: { usuario },
            success: function (response) {
                console.log(response);
                // return
                let { data } = response
                if (data.length > 0 && Array.isArray(data)) {

                    let perfil = data[0];
                    //natural admin
                    $("#idUsuarioNaturalNormal").val(parseInt(perfil.idUsuario));
                    $('#tipoPersonaNaturalNormal').val(parseInt(perfil.TipoPersona));
                    $('#tipoDocumentoIdentidadNaturalNormal').val(parseInt(perfil.TipoDocumentoIdentidad));
                    $('#numDocumentoIdentidadNaturalNormal').val(perfil.NroDocumentoIdentidad);
                    $('#CUIPersonaNaturalNormal').val(perfil.DniCUI);
                    $('#nombresPersonaNaturalNormal').val(perfil.Nombres);
                    $('#apellidosPersonaNaturalNormal').val(perfil.Apellidos);
                    $('#emailPersonaNaturalNormal').val(perfil.Email);
                    $('#telefonoPersonaNaturalNormal').val(perfil.Telefono);
                    $('#domicilioPersonaNaturalNormal').val(perfil.Domicilio);
                    $('#usuarioUsuarioNaturalNormalEditar').val(perfil.Usuario);

                } else {
                    alert("No se encontraron datos para este usuario");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }

    function loadInformacionUsuarioJuridicoNormalPerfil(usuario) {
        $.ajax({
            url: './controllers/Usuario/perfilUsuario.php',
            method: 'POST',
            dataType: 'json',
            data: { usuario },
            success: function (response) {
                console.log(response);
                // return
                let { data } = response
                if (data.length > 0 && Array.isArray(data)) {

                    let perfil = data[0];
                    //natural admin
                    $("#idUsuarioJuridicoNormal").val(parseInt(perfil.idUsuario));
                    $('#tipoPersonaJuridicoNormal').val(parseInt(perfil.TipoPersona));
                    $('#tipoDocumentoIdentidadJuridicoNormal').val(parseInt(perfil.TipoDocumentoIdentidad));
                    $('#numDocumentoIdentidadJuridicoNormal').val(perfil.NroDocumentoIdentidad);
                    // $('#CUIPersonaJuridicoNormal').val(perfil.DniCUI);
                    $('#razonSocialPersonaJuridicoNormal').val(perfil.Nombres);
                    $('#representanteLegalJuridicoNormal').val(perfil.RepresentanteLegal);
                    $('#emailPersonaJuridicoNormal').val(perfil.Email);
                    $('#telefonoPersonaJuridicoNormal').val(perfil.Telefono);
                    $('#domicilioPersonaJuridicoNormal').val(perfil.Domicilio);
                    $('#usuarioUsuarioJuridicoNormalEditar').val(perfil.Usuario);

                } else {
                    alert("No se encontraron datos para este usuario");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }


    // ABRIR MODAL EDITAR PERFIL ADMINISTRADOR
    $(document).off("click", "#PerfilUsuarioAdmin").on("click", "#PerfilUsuarioAdmin", function (e) {
        e.preventDefault();

        let usuarioPerfil = window.usuarioPerfil;
        let usuarioPersona = window.usuarioPersona;
        let usuarioTipoPersona = window.usuarioTipoPersona;
        let usuarioTipoUsuario = window.usuarioTipoUsuario;
        // const tipoPersonaSelect = document.getElementById('tipoPersonaAdministrador');
        console.log(usuarioPerfil);
        console.log(usuarioTipoPersona);
        console.log(usuarioTipoUsuario);
        let modalRegistrar = $("#modalPerfilAdministrador");
        $("#editarPerfilAdministradorForm").trigger("reset");
        if(usuarioTipoPersona==='NATURAL' && usuarioTipoUsuario==='ADMINISTRADOR'){
            loadInformacionUsuarioNaturalAdministradorPerfil(usuarioPerfil);
        }else if(usuarioTipoPersona==='JURIDICO' && usuarioTipoUsuario==='ADMINISTRADOR'){
            loadInformacionUsuarioJuridicoAdministradorPerfil(usuarioPerfil);
        }else{
            console.log("OPCIONES INVALIDAS");
        }

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.on('shown.bs.modal', function () {
            $("#nombresPersonaAdministrador").focus();
        });
    });

    // Actualizar 
    $(document).off('submit', '#editarPerfilAdministradorForm').on('submit', '#editarPerfilAdministradorForm', function (e) {
        e.preventDefault();
        $(this).off('submit'); // Desenganchar el evento de submit
        // let dni = $.trim($('#dniPersonaNuevo').val());
        let idUsuario = $.trim($('#idUsuarioNaturalAdministrador').val());
        let tipoPersona = $('#tipoPersonaNaturalAdministrador').val();
        let tipoDocumentoIdentidad = $('#tipoDocumentoIdentidadNaturalAdministrador').val();
        let numDocumentoIdentidad = $.trim($('#numDocumentoIdentidadNaturalAdministrador').val());
        let dniCUI = $.trim($('#CUIPersonaNaturalAdministrador').val());
        let nombres = $.trim($('#nombresPersonaNaturalAdministrador').val());
        let apellidos = $.trim($('#apellidosPersonaNaturalAdministrador').val());
        let email = $.trim($('#emailPersonaNaturalAdministrador').val());
        let telefono = $.trim($('#telefonoPersonaNaturalAdministrador').val());
        let domicilio = $.trim($('#domicilioPersonaNaturalAdministrador').val());
        console.log(tipoPersona);
        let usuario = $.trim($('#usuarioNaturalAdministrador').val());
        let password = $.trim($('#passwordPersonaNaturalEditarAdministrador').val());
        console.log(password);

        if (idUsuario.length === 0 || nombres.length === 0 || apellidos.length === 0 || email.length === 0 || 
            telefono.length === 0 || domicilio.length === 0 || usuario.length === 0 || numDocumentoIdentidad.length === 0) {
            alert("Campos Vacíos");
            return
        }


        $.ajax({
            url: "./controllers/Usuario/actualizarPerfilUsuario.php",
            type: "POST",
            datatype: "json",
            data: { idUsuario, nombres,apellidos, email, telefono, domicilio, tipoPersona, tipoDocumentoIdentidad, numDocumentoIdentidad, dniCUI,password },
            success: function (response) {
                console.log(response);
                // return
                response = JSON.parse(response);
                if (response.message === 'EXISTE EN OTRO USUARIO, NO ACTUALICES') {
                    alert("Este Número de Documento que ingresaste, se encuentra asignado a otro usuario!");
                    $("numDocumentoIdentidadAdministrador").focus;
                } else if (response.message === 'Usuario Encontrado') {
                    alert("El Usuario ingresado, pertenece  otra Persona");
                    $("usuarioAdministrador").focus;
                } else {
                    if (response.status === 'success') {
                        alert("Se Actualizaron tus Datos del Perfil");
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
                        $('#modalPerfilAdministrador').modal('hide');
                        // loadAreas(descripcionAreaFiltro, pagina, registrosPorPagina);
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













    // ABRIR MODAL EDITAR PERFIL NORMAL
    $(document).off("click", "#PerfilUsuarioNormal").on("click", "#PerfilUsuarioNormal", function (e) {
        e.preventDefault();

        let usuarioPerfil = window.usuarioPerfil;
        let usuarioPersona = window.usuarioPersona;
        let usuarioTipoPersona = window.usuarioTipoPersona;
        let usuarioTipoUsuario = window.usuarioTipoUsuario;

        let modalRegistrar = $("#modalPerfilNormal");
        $("#editarPerfilNormalForm").trigger("reset");
        if(usuarioTipoPersona==='NATURAL' && usuarioTipoUsuario==='NORMAL'){
            loadInformacionUsuarioNaturalNormalPerfil(usuarioPerfil);
        }else if(usuarioTipoPersona==='JURIDICO' && usuarioTipoUsuario==='NORMAL'){
            loadInformacionUsuarioJuridicoNormalPerfil(usuarioPerfil);
        }else{
            console.log("OPCIONES INVALIDAS");
        }
        console.log(usuarioPerfil);
        console.log(usuarioPersona);

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.on('shown.bs.modal', function () {
            $("#nombresPersonaNormal").focus();
        });
    });


    // Actualizar 
    $(document).off('submit', '#editarPerfilNormalForm').on('submit', '#editarPerfilNormalForm', function (e) {
        e.preventDefault();
        $(this).off('submit'); // Desenganchar el evento de submit
        // let dni = $.trim($('#dniPersonaNuevo').val());
        let idUsuario = $.trim($('#idUsuarioNaturalNormal').val());
        let tipoPersona = $('#tipoPersonaNaturalNormal').val();
        let tipoDocumentoIdentidad = $('#tipoDocumentoIdentidadNaturalNormal').val();
        let numDocumentoIdentidad = $.trim($('#numDocumentoIdentidadNaturalNormal').val());
        let dniCUI = $.trim($('#CUIPersonaNaturalNormal').val());
        let nombres = $.trim($('#nombresPersonaNaturalNormal').val());
        let apellidos = $.trim($('#apellidosPersonaNaturalNormal').val());
        let email = $.trim($('#emailPersonaNaturalNormal').val());
        let telefono = $.trim($('#telefonoPersonaNaturalNormal').val());
        let domicilio = $.trim($('#domicilioPersonaNaturalNormal').val());
        console.log(tipoPersona);
        let usuario = $.trim($('#usuarioUsuarioNaturalNormalEditar').val());
        let password = $.trim($('#passwordUsuarioNaturalNormalEditar').val());

        if (idUsuario.length === 0 || nombres.length === 0 || apellidos.length === 0 || email.length === 0 || 
            telefono.length === 0 || domicilio.length === 0 || usuario.length === 0 || numDocumentoIdentidad.length === 0) {
            alert("Campos Vacíos");
            return
        }


        $.ajax({
            url: "./controllers/Usuario/actualizarPerfilUsuario.php",
            type: "POST",
            datatype: "json",
            data: { idUsuario, nombres,apellidos, email, telefono, domicilio, tipoPersona, tipoDocumentoIdentidad, numDocumentoIdentidad, dniCUI,password },
            success: function (response) {
                console.log(response);
                // return
                response = JSON.parse(response);
                if (response.message === 'EXISTE EN OTRO USUARIO, NO ACTUALICES') {
                    alert("Este Número de Documento que ingresaste, se encuentra asignado a otro usuario!");
                    $("numDocumentoIdentidadAdministrador").focus;
                } else if (response.message === 'Usuario Encontrado') {
                    alert("El Usuario ingresado, pertenece  otra Persona");
                    $("usuarioAdministrador").focus;
                } else {
                    if (response.status === 'success') {
                        alert("Se Actualizaron tus Datos del Perfil");
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
                        $('#modalPerfilNormal').modal('hide');
                        // loadAreas(descripcionAreaFiltro, pagina, registrosPorPagina);
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






    // ABRIR MODAL EDITAR PERFIL JURIDICO NORMAL
    $(document).off("click", "#PerfilUsuarioJuridicoNormal").on("click", "#PerfilUsuarioJuridicoNormal", function (e) {
        e.preventDefault();

        let usuarioPerfil = window.usuarioPerfil;
        let usuarioPersona = window.usuarioPersona;
        let usuarioTipoPersona = window.usuarioTipoPersona;
        let usuarioTipoUsuario = window.usuarioTipoUsuario;

        let modalRegistrar = $("#modalPerfilJuridicoNormal");
        $("#editarPerfilJuridicoNormalForm").trigger("reset");
        if(usuarioTipoPersona==='NATURAL' && usuarioTipoUsuario==='NORMAL'){
            loadInformacionUsuarioNaturalNormalPerfil(usuarioPerfil);
        }else if(usuarioTipoPersona==='JURIDICO' && usuarioTipoUsuario==='NORMAL'){
            loadInformacionUsuarioJuridicoNormalPerfil(usuarioPerfil);
        }else{
            console.log("OPCIONES INVALIDAS");
        }
        console.log(usuarioPerfil);

        modalRegistrar.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalRegistrar.modal('show');

        modalRegistrar.on('shown.bs.modal', function () {
            $("#razonSocialPersonaJuridicoNormal").focus();
        });
    });


    // Actualizar 
    $(document).off('submit', '#editarPerfilJuridicoNormalForm').on('submit', '#editarPerfilJuridicoNormalForm', function (e) {
        e.preventDefault();
        $(this).off('submit'); // Desenganchar el evento de submit
        // let dni = $.trim($('#dniPersonaNuevo').val());
        let idUsuario = $.trim($('#idUsuarioJuridicoNormal').val());
        let tipoPersona = $('#tipoPersonaJuridicoNormal').val();
        let tipoDocumentoIdentidad = $('#tipoDocumentoIdentidadJuridicoNormal').val();
        let numDocumentoIdentidad = $.trim($('#numDocumentoIdentidadJuridicoNormal').val());
        let dniCUI = $.trim($('#CUIPersonaJuridicoNormal').val());
        let nombres = $.trim($('#razonSocialPersonaJuridicoNormal').val());
        let apellidos = $.trim($('#apellidosPersonaNaturalNormal').val());
        let email = $.trim($('#emailPersonaJuridicoNormal').val());
        let telefono = $.trim($('#telefonoPersonaJuridicoNormal').val());
        let domicilio = $.trim($('#domicilioPersonaJuridicoNormal').val());
        let representanteLegal= $.trim($('#representanteLegalJuridicoNormal').val());
        console.log(tipoPersona);
        let usuario = $.trim($('#usuarioUsuarioJuridicoNormalEditar').val());
        let password = $.trim($('#passwordUsuarioJuridicoNormalEditar').val());

        if (idUsuario.length === 0 || nombres.length === 0 ||  email.length === 0 || representanteLegal.length===0||
            telefono.length === 0 || domicilio.length === 0 || usuario.length === 0 || numDocumentoIdentidad.length === 0) {
            alert("Campos Vacíos");
            return
        }


        $.ajax({
            url: "./controllers/Usuario/actualizarPerfilUsuario.php",
            type: "POST",
            datatype: "json",
            data: { idUsuario, nombres, email, telefono, domicilio, tipoPersona, tipoDocumentoIdentidad, numDocumentoIdentidad,representanteLegal,dniCUI,apellidos,password },
            success: function (response) {
                console.log(response);
                // return
                response = JSON.parse(response);
                if (response.message === 'EXISTE EN OTRO USUARIO, NO ACTUALICES') {
                    alert("Este Número de Documento que ingresaste, se encuentra asignado a otro usuario!");
                    $("numDocumentoIdentidadJuridicoNormal").focus;
                } else if (response.message === 'Usuario Encontrado') {
                    alert("El Usuario ingresado, pertenece  otra Persona");
                    $("usuarioUsuarioJuridicoNormalEditar").focus;
                } else {
                    if (response.status === 'success') {
                        alert("Se Actualizaron tus Datos del Perfil");
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
                        $('#modalPerfilJuridicoNormal').modal('hide');
                        // loadAreas(descripcionAreaFiltro, pagina, registrosPorPagina);
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

});