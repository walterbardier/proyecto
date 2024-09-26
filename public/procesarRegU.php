<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>¡Usuario registrado! | RÍO NEGRO CONECTADO</title>

    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + LeadMark main styles -->
	<link rel="stylesheet" href="../app/views/usuarios/assets/css/leadmark.css?v=<?php echo(rand()); ?>">
    
    <link rel="stylesheet" href="../app/views/usuarios/assets/css/leadmark.css?php echo(rand()); ?>" />
    <!-- <script src="/js/mi_script.js?v=<?php echo(rand()); ?>"></script> -->
    
</head>
<body>
<div class="container">

    <?php



        $conexion = new mysqli("localhost","root","","proyecto2024");

        // Obtener datos del formulario
        // $id = $_POST['id'];
        $nombre_usuario = $_POST['nombre_usuario'];
        $correo_electronico = $_POST['correo_electronico'];
        $contrasena = $_POST['contrasena'];
        // $nombre_completo = $_POST['nombre_completo'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        // $numero_telefono = $_POST['numero_telefono'];

        // Verificar si el estudiante ya existe
        $sql_verificar = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario'";
        $result_verificar = $conexion->query($sql_verificar);

        if ($result_verificar->num_rows > 0) {
            // El estudiante ya existe, notificar
            echo "
            
            <br><br><br>
                <div class='col'>
                    <form>
                        <div class='form-row'>
                            <div class='form-group col-12'>
                                <h4><b>Ya existe el Estudiante:</b></h4>
                                <br>
                                <h6><b>Nombre: </b>$nombre_usuario</h6>
                            </div>
                            <div class='form-group col-12 mb-0'>
                                <a href='index.php'><button class='btn btn-primary rounded' input type='button' name='volver'>Volver atrás</button></a>
                            </div>                          
                        </div>                          
                    </form>
                </div>
                
                ";
        } else {
            // El estudiante no existe, registrar
            $sql_insertar = "INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena, fecha_nacimiento)
            VALUES ('$nombre_usuario', '$correo_electronico', '$contrasena', '$fecha_nacimiento')";

            if ($conexion->query($sql_insertar) === TRUE) {
                echo "
                
                <br><br><br>
                <div class='col'>
                    <form>
                        <div class='form-row'>
                            <div class='form-group col-12'>
                                <h4><b>Se ha registrado al Estudiante:</b></h4>
                                <br>
                                <h6><b>Nombre: </b>$nombre_usuario</h6>
                            </div>
                            <div class='form-group col-12 mb-0'>
                                <a href='index.php'><button class='btn btn-primary rounded' input type='button' name='volver'>Volver atrás</button></a>
                            </div>                          
                        </div>                          
                    </form>
                </div>
                
                ";
            } else {
                echo "Error al registrar estudiante: " . $conexion->error;
            }
        }

        // Cerrar la conexión
        $conexion->close();

    ?>
</div>
</body>
</html>