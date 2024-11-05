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
    let usuario= window.usuarioPerfil;
    function loadInformacionCasilla(usuario) {
        $.ajax({
            url: './controllers/Casillas/informacionCasillaPersona.php',
            method: 'POST',
            dataType: 'json',
            data: { usuario},
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

                    </tr>`).join('');
                    $('#bodyListaInformacionCasillas').html(row);
                } else {
                    let row = `<tr>
                        <td colSpan="10" className="mensajeSinRegistros">Sin Informacion</td>
                    </tr>`
                    $('#bodyListaInformacionCasillas').html(row);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        });
    }
    loadInformacionCasilla(usuario);

});