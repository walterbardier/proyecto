<?php
session_start();
require_once('../models/conexionModel.php');

// Obtener la instancia de la conexión
$db = ConexionModel::getInstance()->getDatabaseInstance();

// Obtener los datos del formulario
$nombre_usuario = $_POST['nombre_usuario'];
$correo_electronico = $_POST['correo_electronico'];
$nombre_completo = $_POST['nombre_completo'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$numero_telefono = $_POST['numero_telefono'];

// Actualizar la información del usuario en la base de datos
$sql = "UPDATE usuarios SET correo_electronico = ?, nombre_completo = ?, fecha_nacimiento = ?, numero_telefono = ? WHERE nombre_usuario = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$correo_electronico, $nombre_completo, $fecha_nacimiento, $numero_telefono, $nombre_usuario]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>¡Datos actualizados!</title>
    <!-- Font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + LeadMark main styles -->
    <link rel="stylesheet" href="../views/usuarios/assets/css/leadmark.css?v=<?php echo(rand()); ?>">
</head>

<body>
    <div class="container">
    <br><br><br>
    <div class='col'>
        <form>
            <div class='form-row'>
                <div class='form-group col-12'>
                    <h4><b>¡Los datos han sido actualizados!</b></h4>
                </div>
                <div class='form-group col-12 mb-0'>
                    <a href="../views/usuarios/perfilUsuario.php">
                        <button class="btn btn-primary rounded" type="button" name="volver">Volver atrás</button>
                    </a>
                </div>
            </div>
        
        </div>
    </div>
</body>
</html>
