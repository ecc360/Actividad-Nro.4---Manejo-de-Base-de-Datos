document.addEventListener("DOMContentLoaded", function() {
    const cuentoForm = document.getElementById("cuento-form");

    cuentoForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar que se envíe el formulario

        // Obtener datos del formulario de cuento
        const nombre = document.getElementById("nombre").value;
        const apodo = document.getElementById("apodo").value;
        const colorCabello = document.getElementById("color-cabello").value;
        const colorOjos = document.getElementById("color-ojos").value;
        const edad = document.getElementById("edad").value;
        const hobby = document.getElementById("hobby").value;

        // Generar el cuento
        const cuento = `Había una vez una persona llamada ${nombre}, pero todos la conocían como ${apodo}. 
        Tenía el cabello de color ${colorCabello} y unos ojos tan brillantes como el ${colorOjos}. 
        A sus ${edad} años, su hobby favorito era ${hobby}. Un día, mientras practicaba su hobby, 
        sucedió algo inesperado...`;

        // Mostrar el cuento en la página
        const cuentoContainer = document.createElement("div");
        cuentoContainer.innerHTML = `<h3>Tu cuento:</h3><p>${cuento}</p>`;
        document.getElementById("diseña-tu-cuento").appendChild(cuentoContainer);

        // Enviar datos del formulario al servidor
        enviarDatosAlServidor({ cliente: nombre, email: '', telefono: '', servicio: hobby });
    });

    // Función para enviar datos del formulario al servidor
    function enviarDatosAlServidor(datos) {
        fetch('http://localhost:3000/guardar-solicitud', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datos)
        })
        .then(response => {
            if (response.ok) {
                console.log('Solicitud enviada correctamente');
            } else {
                throw new Error('Error al enviar la solicitud');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Función para cancelar el formulario
    function cancelarFormulario() {
        cuentoForm.reset(); // Reiniciar el formulario y limpiar los campos
    }

    // Obtener el botón de cancelar
    const cancelarBtn = document.getElementById("cancelar-btn");
    if (cancelarBtn) {
        // Agregar un listener para el evento 'click'
        cancelarBtn.addEventListener("click", cancelarFormulario);
    }
});
