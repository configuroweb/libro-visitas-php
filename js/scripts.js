document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        let hasError = false;
        // Ejemplo de validación simple
        if (document.querySelector('input[name="nombre"]').value.trim() === '') {
            alert('Por favor, ingresa tu nombre.');
            hasError = true;
        }

        if (document.querySelector('textarea[name="mensaje"]').value.trim() === '') {
            alert('Por favor, ingresa un mensaje.');
            hasError = true;
        }

        if (hasError) {
            e.preventDefault(); // Previene que el formulario se envíe
        }
    });
});
