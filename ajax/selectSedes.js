
 // llenar select
 $.ajax({
    url: './controllers/Sedes/listarSedesCombo.php',
    method: 'GET',
    dataType: 'json',
    data: {},
    success: function(data) {
        // console.log(data);
        if (data && Array.isArray(data)) {
            let options = `<option disabled selected value="Seleccionar">Seleccionar</option>` +
                data.map(sede =>
                    `<option value="${sede.idSede}">${sede.Descripcion}</option>`
                ).join('');


            $('.selectSede').html(options);
            
        } else {
            console.warn('No data received or data is not an array.');
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error fetching the content:', textStatus, errorThrown);
    }

});