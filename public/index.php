<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Río Negro Conectado</title>

    <link rel="stylesheet" href="./css/loginstyle.css?v=<?php echo(rand()); ?>" />
    <!-- <script src="/js/mi_script.js?v=<?php echo(rand()); ?>"></script> -->

</head>
<body>
    
    <div class="login-container">
        
        <!-- <h2><b>Buzón Ciudadano</b></h2> -->
        <img src="./imgs/RioNegro2.png" alt="Río Negro" width="260" height="60" style="margin: 13px;">
        <br>
        
        <form action="../app/controllers/procesarLogin.php" method="post">
            <label for="username"><b>Nombre de Usuario</b></label>
            <input type="text" id="username" name="username" required>

            <label for="password"><b>Contraseña</b></label>
            <input type="password" id="password" name="password" required>
            
            <label for="role"><b>Rol</b></label>
            <select id="role" name="role" required>
                <option value="usuario">Usuario</option>
                <option value="administrador">Administrador</option>
            </select>
            
            <button type="submit">Iniciar sesión</button>

            <br><br>

            <a href='registroUsuario.php' onclick=''>Registrarse</a>
        </form>
    </div>
</body>
</html>

