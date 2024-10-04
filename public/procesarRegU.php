<?php
$conexion = new mysqli("localhost", "root", "", "proyecto2024");

// Obtener datos del formulario
$nombre_usuario = $_POST['nombre_usuario'];
$correo_electronico = $_POST['correo_electronico'];
$contrasena = $_POST['contrasena'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];

// Verificar si el usuario ya existe
$sql_verificar = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario'";
$result_verificar = $conexion->query($sql_verificar);

if ($result_verificar->num_rows > 0) {
    // El usuario ya existe
    echo json_encode(['success' => false, 'message' => 'Ya existe un usuario con este nombre']);
} else {
    // El usuario no existe, registrar
    $sql_insertar = "INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena, fecha_nacimiento)
    VALUES ('$nombre_usuario', '$correo_electronico', '$contrasena', '$fecha_nacimiento')";

    if ($conexion->query($sql_insertar) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Usuario registrado exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al registrar usuario: ' . $conexion->error]);
    }
}

// Cerrar la conexión
$conexion->close();
?>
