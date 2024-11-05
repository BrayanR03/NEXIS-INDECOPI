
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


            $('.selectTipoDocumentoNotificacion').html(options);
            
        } else {
            console.warn('No data received or data is not an array.');
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error fetching the content:', textStatus, errorThrown);
    }
});