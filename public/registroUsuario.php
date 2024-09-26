<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | RÍO NEGRO CONECTADO</title>

    <link rel="stylesheet" href="./css/loginstyle.css?v=<?php echo(rand()); ?>" />
    <!-- <script src="/js/mi_script.js?v=<?php echo(rand()); ?>"></script> -->

</head>
<body>
    <div class="login-container">
        <!-- <h2><b>Registro de Usuario</b></h2> -->
        <!-- <img src="./imgs/RioNegro.png" alt="Río Negro" width="260" height="60" style="margin: 13px;"> -->
        <br>

        <form action="../public/procesarRegU.php" method="post">
            <!-- <label for="id"><b>Cédula de identidad</b></label>
            <input type="number" id="id" name="id" required> -->

            <label for="nombre_usuario"><b>Nombre de Usuario</b></label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required>

            <label for="contrasena"><b>Contraseña</b></label>
            <input type="password" id="contrasena" name="contrasena" required>
            
            <!-- <label for="nombre_completo"><b>Nombre completo</b></label>
            <input type="text" id="nombre_completo" name="nombre_completo" required> -->

            <label for="correo_electronico"><b>Correo electrónico</b></label>
            <input type="text" id="correo_electronico" name="correo_electronico" required>


            <label for="fecha_nacimiento"><b>Fecha de nacimiento</b></label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
            

            <!-- <label for="nombre_completo"><b>Teléfono</b></label>
            <input type="number" id="numero_telefono" name="numero_telefono" required> -->
            
            <br><br>

            <button type="submit">Registrarse</button>

            <br><br>
        </form>
    </div>
</body>
</html>

