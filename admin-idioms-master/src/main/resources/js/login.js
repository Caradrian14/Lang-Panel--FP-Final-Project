$(document).ready(function() {
    $('#login-form').submit(function(event) {
      // Evita que el formulario se envíe de manera tradicional.
      event.preventDefault();
    
      // Envía los datos del formulario al controlador mediante AJAX.
      $.ajax({
        type: 'POST',
        url: 'http://localhost/src/main/project/router/route.php',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
          // Maneja la respuesta del servidor.
          if (response.success) {
            // Redirige al usuario a la página de inicio de la aplicación.
            window.location.href = 'https://www.w3schools.com/jquery/';
          } else {
            // Muestra un mensaje de error al usuario.
            $('#login-error').text(response.message);
          }
        }
      });
    });
  });