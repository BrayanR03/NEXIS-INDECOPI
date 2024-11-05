document.addEventListener('DOMContentLoaded', function () {
        // Selecciona todos los enlaces que deberían cargar contenido dinámico
        const links = document.querySelectorAll('.load-content');

        links.forEach(link => {
            console.log(link);
            
            link.addEventListener('click', function (event) {
                event.preventDefault(); // Evita que el enlace redireccione la página

                const url = this.href; // Obtiene la URL del enlace

                console.log(url);
                

                // Hace una petición a la URL usando fetch
                fetch(url)
                    .then(response => response.text())
                    .then(data => {
                        // Inserta el contenido en el div con id "dynamic-content"
                        document.getElementById('dynamic-content').innerHTML = data;
                    })
                    .catch(error => console.log('Error al cargar el contenido:', error));
            });
        });
    });
