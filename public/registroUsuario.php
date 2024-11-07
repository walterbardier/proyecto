<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Crear usuario | Río Negro Conectado</title>
    
    <!-- font icons -->
    <link rel="stylesheet" href="./css/assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + LeadMark main styles -->
    <link rel="stylesheet" href="./css/assets/css/leadmark.css?v=<?php echo(rand()); ?>">
    
    <style>
        /* Estilo para la animación de aparición y expansión */
        .fade-in {
            opacity: 1; /* Totalmente visible */
            transform: scale(1); /* Tamaño normal */
            transition: opacity 0.5s ease, transform 0.5s ease; /* Transición para ambos efectos */
        }

        /* Inicialmente el contenedor estará oculto */
        .hidden {
            opacity: 0; /* Oculto */
            transform: scale(0.95); /* Tamaño reducido */
            transition: opacity 0.5s ease, transform 0.5s ease; /* Transición para ambos efectos */
        }

        /* Animación para la transición a la página de registro */
        .fade-out {
            opacity: 0;
            transform: scale(0.95); /* Reduce el tamaño ligeramente */
            transition: opacity 0.5s ease, transform 0.5s ease; /* Aplica la transición a ambos estilos */
        }
    </style>
</head>

<body>
    <div class="login-container hidden" id="formContainer">
        <form action="../public/procesarRegU.php" method="post">
            <label for="nombre_usuario"><b>Nombre de Usuario</b></label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" placeholder="Usuario" required>

            <label for="contrasena"><b>Contraseña</b></label>
            <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>

            <label for="correo_electronico"><b>Correo electrónico</b></label>
            <input type="text" id="correo_electronico" name="correo_electronico" placeholder="Correo electrónico" required>

            <label for="fecha_nacimiento"><b>Fecha de nacimiento</b></label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

            <br>
            <button type="submit">Registrarse</button>

            <br><br>
            <!-- Botón para volver atrás -->
            <a hhref="#" id="backLink">
                <img src="imgs/volver2.png" alt="Volver" class="volver-img" width="40" height="40">
            </a>
        </form>
    </div>

    <!-- Modal de éxito o error -->
    <div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="responseModalLabel">Resultado del Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalMessage">
                    <!-- El mensaje del resultado aparecerá aquí -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Aplicar el efecto de aparición y expansión al contenedor
            $('#formContainer').removeClass('hidden').addClass('fade-in');

            // Intercepta el envío del formulario
            $('form').submit(function(e) {
                e.preventDefault(); // Prevenir el comportamiento por defecto del formulario

                var formData = $(this).serialize(); // Serializar los datos del formulario

                $.ajax({
                    url: '../public/procesarRegU.php', // Ruta del archivo PHP que procesa el formulario
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Mostrar el mensaje en el modal
                        $('#modalMessage').text(response.message);
                        
                        // Mostrar el modal
                        $('#responseModal').modal('show');

                        // Agregar un evento al botón "Aceptar" del modal
                        $('.modal-footer .btn').off('click').on('click', function() {
                            // Redirigir a index.php al hacer clic en "Aceptar"
                            window.location.href = 'index.php';
                        });
                    },
                    error: function() {
                        alert('Hubo un error al procesar el registro.');
                    }
                });
            });

            // Evento para el hipervínculo "Volver"
            $('#backLink').click(function(event) {
                event.preventDefault(); // Prevenir el comportamiento por defecto del enlace
                
                // Aplicar el efecto de fade-out antes de redirigir
                $('#formContainer').addClass('fade-out'); // Aplicar la clase de animación

                // Espera a que termine la animación antes de redirigir
                setTimeout(function() {
                    window.location.href = 'index.php'; // Redirigir después del fade-out
                }, 500); // Duración de la animación en milisegundos
            });
        });
    </script>

</body>
</html>
