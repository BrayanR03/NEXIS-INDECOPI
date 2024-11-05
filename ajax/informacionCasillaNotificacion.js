$(document).ready(function () {
    console.log("INICIO DE CASILLAS.JS :D");
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
    // let usuario= window.usuarioPerfil;
    let datosBusquedaFiltro = $('#datosBusquedaFiltro').val();
    
    function loadInformacionCasillaNotificacion(datosBusquedaFiltro) {
        $.ajax({
            url: './controllers/Casillas/informacionCasillaNotificacion.php',
            method: 'POST',
            dataType: 'json',
            data: { datosBusquedaFiltro},
            success: function (response) {
                // console.log(response);
                // return
                let { data } = response;
                if (data.length > 0 && Array.isArray(data)) {
                    let row = data.map(casilla => `
                    <tr>
                        <td style='color:black'>${casilla.Persona}</td>
                        <td>${casilla.TipoPersona}</td>
                        <td>${casilla.NroDocumento}</td>
                        <td>${casilla.NroCasilla}</td>
                        <td>${casilla.TipoCasilla}</td>
                        <td hidden>${casilla.Email}</td>
                        <td>
                        <a id="btnNotificar" href="#" data-id="${casilla.NroCasilla}" data-email="${casilla.Email}" >Notificar</a>
                        </td>

                    </tr>`).join('');
                    $('#bodyListaCasillasNotificacion').html(row);
                } else {
                    let row = `<tr>
                        <td colSpan="10" className="mensajeSinRegistros">Sin Informacion</td>
                    </tr>`
                    $('#bodyListaCasillasNotificacion').html(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }
    loadInformacionCasillaNotificacion(datosBusquedaFiltro);
    $(document).off("input", "#datosBusquedaFiltro").on("input", "#datosBusquedaFiltro", function (e) {
        e.preventDefault();
        datosBusquedaFiltro = $('#datosBusquedaFiltro').val();
        console.log(datosBusquedaFiltro);
        pagina = 1
        loadInformacionCasillaNotificacion(datosBusquedaFiltro);
    });

    $(document).off("click","#btnNotificar").on("click","#btnNotificar",function(e){
        e.preventDefault();
        let datosMovimientoDiv = document.querySelector('#datosMovimiento');
        datosMovimientoDiv.hidden=false;
        let idCasilla = $(this).data('id'); 
        let email=$(this).data('email');
        console.log(idCasilla);
        // let casillaNotificacion=document.getElementById("NroCasillaNotificacion");
        // casillaNotificacion=idCasilla;
        $("#NroCasillaNotificacion").val(idCasilla);
        $("#emailDestino").val(email);

    });

    $(document).off("click","#cancelarNotificacion").on('click',"#cancelarNotificacion",function(e){
        e.preventDefault();
        let datosMovimientoDiv = document.querySelector('#datosMovimiento');
        datosMovimientoDiv.hidden=true;
        $("#NroCasillaNotificacion").val("");
        $("#datosBusquedaFiltro").val("");
        datosBusquedaFiltro="";
        loadInformacionCasillaNotificacion(datosBusquedaFiltro);
        // loadInformacionCasillaNotificacion(datosBusquedaFiltro);
        $(document).off("input", "#datosBusquedaFiltro").on("input", "#datosBusquedaFiltro", function (e) {
            e.preventDefault();
            datosBusquedaFiltro = $('#datosBusquedaFiltro').val();
            // console.log(datosBusquedaFiltro);
            pagina = 1
            loadInformacionCasillaNotificacion(datosBusquedaFiltro);
        });
    });

});