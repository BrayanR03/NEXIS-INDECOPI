$(document).ready(function () {
    $(document).off("click", "#btnLogout").on("click", "#btnLogout", function (e) {
        // console.log("cerraste sesion");
        $.ajax({
            url: './controllers/Logout.php',
            dataType: 'json',
            success: function (response) {
                if (response) {
                    location.reload();
                }
            }, error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        })
    })

    function cerrarSesion() {
        $.ajax({
            url: './controllers/Logout.php',
            dataType: 'json',
            success: function (response) {
                if (response) {
                    location.reload();
                }
            }, error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error fetching the content:', textStatus, errorThrown);
            }
        })
    }
})