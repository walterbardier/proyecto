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

if ($stmt->execute([$correo_electronico, $nombre_completo, $fecha_nacimiento, $numero_telefono, $nombre_usuario])) {
    // Si la actualización fue exitosa, devolver una respuesta JSON
    echo json_encode(['success' => true, 'message' => '¡Datos actualizados con éxito!']);
} else {
    // Si hubo un error, devolver un mensaje de error
    echo json_encode(['success' => false, 'message' => 'Hubo un error al actualizar los datos.']);
}

?>
