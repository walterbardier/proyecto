<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Río Negro Conectado</title>
    <link rel="stylesheet" href="./css/loginstyle.css?v=<?php echo(rand()); ?>" />
    
    <style>
        /* Estilos del modal emergente */
        .modal {
            display: none; /* Oculto por defecto */
            position: fixed; /* Posiciona sobre la página */
            z-index: 9999; /* Muy por encima de otros elementos */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro */
        }

        .modal-content {
            background-color: white;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            border-radius: 13px; /* Bordes redondeados */
            width: 30%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); /* Centrado */
            text-align: center;
            z-index: 10000;
        }

        .modal-content h4 {
            margin-bottom: 20px;
        }

        /* Estilo del botón Aceptar */
        .close-btn {
            background-color: #193961; /* Color personalizado */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px; /* Bordes redondeados */
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .close-btn:hover {
            background-color: #1a486e; /* Color ligeramente más claro al pasar el mouse */
        }

        /* Animación para la transición */
        .fade-out {
            opacity: 0;
            transform: scale(0.95); /* Reduce el tamaño ligeramente */
            transition: opacity 0.5s ease, transform 0.5s ease; /* Aplica la transición a ambos estilos */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="./imgs/RioNegro2.png" alt="Río Negro" width="260" height="60" style="margin: 13px;">
        <br>
        
        <form id="loginForm" action="../app/controllers/procesarLogin.php" method="post">
            <label for="username"><b>Nombre de Usuario</b></label>
            <input type="text" id="username" name="username" placeholder="Usuario" required>

            <label for="password"><b>Contraseña</b></label>
            <input type="password" id="password" name="password" placeholder="Contraseña" required>
            
            <label for="role"><b>Rol</b></label>
            <select id="role" name="role" required>
                <option value="usuario">Usuario</option>
                <option value="administrador">Administrador</option>
            </select>
            
            <button type="submit">Iniciar sesión</button>

            <br><br>
            <a href="#" id="registerLink">Registrarse</a>
        </form>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <h4 id="modalMessage"></h4>
            <button id="closeModal" class="close-btn">Aceptar</button>
        </div>
    </div>

    <script>
        // Manejar el clic en el enlace "Registrarse"
        document.getElementById('registerLink').addEventListener('click', function(event) {
            event.preventDefault(); // Evita la acción por defecto del enlace
            
            const container = document.querySelector('.login-container');
            container.classList.add('fade-out'); // Aplica la clase de animación
            
            // Espera a que termine la animación antes de redirigir
            setTimeout(function() {
                window.location.href = 'registroUsuario.php'; // Redirigir a registroUsuario.php
            }, 500); // Duración de la animación en milisegundos
        });

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío por defecto del formulario

            const formData = new FormData(this);

            fetch('../app/controllers/procesarLogin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const modal = document.getElementById('myModal');
                const modalMessage = document.getElementById('modalMessage');
                const closeModal = document.getElementById('closeModal');

                // Mostrar el mensaje en el modal
                modalMessage.innerHTML = data.success ? '¡Inicio de sesión exitoso!' : data.message;

                // Mostrar el modal
                modal.style.display = 'block';

                // Cuando el usuario haga clic en "Aceptar"
                closeModal.onclick = function() {
                    modal.style.display = 'none';
                    if (data.success) {
                        const container = document.querySelector('.login-container');
                        container.classList.add('fade-out'); // Aplica la clase de animación
                        
                        // Espera a que termine la animación antes de redirigir
                        setTimeout(function() {
                            window.location.href = data.redirect; // Redirigir a la URL que devuelve logInPage()
                        }, 500); // Duración de la animación en milisegundos
                    }
                };
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>
