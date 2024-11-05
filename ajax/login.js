$(document).ready(function () {
    $(document).off("click", "#btnLogin").on("click", "#btnLogin", function (e) {
        e.preventDefault();
        const user = $("#Usuario").val().trim();
        const password = $("#Password").val().trim();
        // console.log(user);
        // console.log(password);
        // return
        if(password.length<8){alert("La longitud mínima de la contraseña es de 8 dígitos!"); return}
        if(user.length===0 || password.length===0){alert("Debes completar los campos requeridos!!"); return}
        // if (isFiledsValid(user, password)) {
            $.ajax({
                url: './controllers/Login.php',
                method: 'POST',
                dataType: 'json',
                data: {user, password},
                success: function (response) {
                    // console.log(response);
                    // return
                    const {code, message, info, data} = response;
                    if (code === 404) {
                        alert("Credenciales Incorrectas");
                        // showAlertCredentialsIncorrect();
                        return;
                    }

                    if (code === 200) {
                        showModalAutenticacionUltimosDigitos();
                        saveDataSession(data);
                        // alert("200");
                        // showModalAutenticacionCUI();
                        // validateCUI(data);
                    }

                    if (code === 500) {
                        alert("Error interno del servidor");
                        // showErrorInternalServer(message, info)
                    }

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching the content:', textStatus, errorThrown);
                }
            })
            // console.log({user, password})
        // }

    })

    function saveDataSession(data) {
        // console.log(data);
        const {NumDocumentoIdentidad} = data[0];
        let cantidadDigitos=NumDocumentoIdentidad.length;
        // console.log(cantidadDigitos);
        let ultimosDigitos=NumDocumentoIdentidad.substring(cantidadDigitos-2,cantidadDigitos);
        // console.log(ultimosDigitos);
        $(document).off("click", "#btnConfirmarUltimosDigitos").on("click", "#btnConfirmarUltimosDigitos", function (e) {
            e.preventDefault();
            let valueUltimosDigitos = $("#ultimosDigitos").val();

            // if (!isValidFieldCUI(valueCUI)) return

            if (ultimosDigitos !== valueUltimosDigitos) {
                alert("Los últimos dígitos no coindicen con el de tu usuario!.");
                // showAlertIncorrectCUI();
            } else {
                $.ajax({
                    url: './controllers/Ingresar.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {data},
                    success: function (response) {
                        // console.log(response);
                        // return
                        if (response) {
                            location.reload();
                        }
                    }, error: function (jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching the content:', textStatus, errorThrown);
                    }
                })
            }
        })
    }

    function showModalAutenticacionUltimosDigitos() {
        let modalValidarCUI = $("#modalValidar");
        $("#validarUltimosDigitosForm").trigger("reset");

        modalValidarCUI.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalValidarCUI.modal('show');

        modalValidarCUI.on('shown.bs.modal', function () {
            $("#ultimosDigitos").focus();
        });

        $(document).off("click", "#btnCancelarUltimosDigitos").on("click", "#btnCancelarUltimosDigitos", function (e) {
            alert("Importante: Debes completar la autenticación doble factor!!");
            return
        })
    }

    // function validateCUI(data) {
    //     const {cui} = data;
    //     $(document).off("click", "#btnConfirmarCUI").on("click", "#btnConfirmarCUI", function (e) {
    //         e.preventDefault();
    //         let valueCUI = $("#cui").val();

    //         if (!isValidFieldCUI(valueCUI)) return

    //         if (cui !== valueCUI) {
    //             showAlertIncorrectCUI();
    //         } else {
    //             $.ajax({
    //                 url: './controllers/autenticacion/ingresar.php',
    //                 method: 'POST',
    //                 dataType: 'json',
    //                 data: {data},
    //                 success: function (response) {
    //                     if (response) {
    //                         location.reload();
    //                     }
    //                 }, error: function (jqXHR, textStatus, errorThrown) {
    //                     console.error('Error fetching the content:', textStatus, errorThrown);
    //                 }
    //             })
    //         }
    //     })
    // }

    // function showAlertIncorrectCUI() {
    //     Swal.fire({
    //         title: "¡Error!",
    //         text: 'El código único de de idenficicación (CUI) no coincide con el del usuario registrado',
    //         icon: "error",
    //         width: "350px",
    //         confirmButtonColor: "#13252E",
    //     });
    // }

    // function isValidFieldCUI(cui) {
    //     if (!/^[0-9]$/.test(cui) || cui === ''){
    //         console.log("cui invalido")
    //         Swal.fire({
    //             title: "¡Advertencia!",
    //             text: 'Ingrese un CUI valido',
    //             icon: "warning",
    //             width: "350px",
    //             confirmButtonColor: "#13252E",
    //         });
    //         return false;
    //     }
    //     return true;
    // }

    function showModalAutenticacionCUI() {
        let modalValidarCUI = $("#modalValidarCUI");
        $("#validarCUIForm").trigger("reset");

        modalValidarCUI.modal({
            backdrop: 'static',
            keyboard: false
        });

        modalValidarCUI.modal('show');

        modalValidarCUI.on('shown.bs.modal', function () {
            $("#cui").focus();
        });

        $(document).off("click", "#btnCancelarCUI").on("click", "#btnCancelarCUI", function (e) {
            // showAlertAutenticacionIncompled()
            return
        })
    }

    // function showAlertAutenticacionIncompled() {
    //     Swal.fire({
    //         title: "¡Advertencia!",
    //         text: 'Necesita completar la autenticación de doble factor para ingresar al sistema',
    //         icon: "warning",
    //         width: "350px",
    //         confirmButtonColor: "#13252E",
    //     });
    // }

    // function showErrorInternalServer(message, info) {
    //     Swal.fire({
    //         title: "¡Error!",
    //         text: message + ' {' + info + '}',
    //         icon: "error",
    //         width: "350px",
    //         confirmButtonColor: "#13252E",
    //     });
    // }

    // function showAlertCredentialsIncorrect() {
    //     Swal.fire({
    //         title: "¡Advertencia!",
    //         text: 'Las credenciales ingresadas son incorrectas',
    //         icon: "warning",
    //         width: "350px",
    //         confirmButtonColor: "#13252E",
    //     });
    // }

    // function isFiledsValid(user, password) {
    //     if (user === '' || password === '') {
    //         Swal.fire({
    //             title: "¡Advertencia!",
    //             text: 'Campos incompletos',
    //             icon: "warning",
    //             width: "350px",
    //             confirmButtonColor: "#13252E",
    //         });
    //         return false;
    //     }
    //     return true;
    // }
})


// $('#formLogin').submit(function(e) {
//     e.preventDefault();

//     let username = $.trim($('#Usuario').val());
//     let password = $.trim($('#Password').val());

//     // console.log(username);
//     // console.log(password);
//     // return
//     if (username.length == 0 || password.length == 0) {
//         alert("Ingresa un usuario y contraseña");
//         // Swal.fire({
//         //     icon: "warning",
//         //     title: "Campos Incompletos",
//         //     text: "Ingrese los campos requeridos para ingresar",
//         // });
//     } else {
//         $(this).attr('action', 'usuario/login');
//         // alert("HOLA DESDE AJAX");
//         this.submit();
//     }
// });