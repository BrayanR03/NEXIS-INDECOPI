// $.ajax({
//     url: './controllers/Casillas/idUltimaCasilla.php',
//     method: 'GET',
//     dataType: 'json',
//     data: {},
//     success: function(data) {
//         console.log("ANTES DE CONDICION IF - ID CASILLA");
//         console.log(data); 
//         if (data && Array.isArray(data)) {
//             let idCasilla = data[0].idCasilla; // Captura el primer idCasilla de la lista (o el que necesites)
//             console.log("DENTRO DE AJAX ULTIMO ID ARCHIVO APARTE");
//             console.log(idCasilla);
//             $('.inputIdCasilla').val(idCasilla);
//         } else {
//             console.warn('No data received or data is not an array.');
//         }

//     },
//     error: function(jqXHR, textStatus, errorThrown) {
//         console.error('Error al obtener los datos:', textStatus, errorThrown);
//     }
// });
