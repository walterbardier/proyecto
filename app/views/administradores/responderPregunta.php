<?php
session_start();

// Verifica si el administrador está autenticado
if (!isset($_SESSION['usuario']['username'])) {
    die('No estás logueado. Por favor, inicia sesión.');
}

// Conexión a la base de datos
$host = 'localhost';
$dbname = 'proyecto2024';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener el id de la pregunta a responder
    if (isset($_GET['id_pregunta'])) {
        $id_pregunta = $_GET['id_pregunta'];

        // Consultar la pregunta específica
        $stmt = $pdo->prepare("SELECT preguntas.id, preguntas.texto_pregunta, usuarios.nombre_usuario 
                               FROM preguntas 
                               INNER JOIN usuarios ON preguntas.id_usuario = usuarios.id 
                               WHERE preguntas.id = ?");
        $stmt->execute([$id_pregunta]);
        $pregunta = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$pregunta) {
            die('Pregunta no encontrada.');
        }
    } else {
        die('ID de pregunta no proporcionado.');
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Río Negro Conectado</title>

    <link rel="stylesheet" href="../../../public/css/loginstyle.css?v=<?php echo(rand()); ?>" />
    <!-- <script src="/js/mi_script.js?v=<?php echo(rand()); ?>"></script> -->

</head>
<body>
    <div class="answer-container">
        <div class="header">
            <!-- Botón para volver atrás -->
            <a href="javascript:history.back()">
                <img src="../../../public/imgs/volver.png" alt="Volver" class="volver-img" width="50" height="50">
            </a>
            <!-- Título de la sección -->
            <h2>Responder a la pregunta</h2>
        </div>

        <!-- Mostrar la pregunta -->
        <p><b>Pregunta de <?php echo htmlspecialchars($pregunta['nombre_usuario']); ?>:
        <br>
        </b> <?php echo htmlspecialchars($pregunta['texto_pregunta']); ?></p>

        <!-- Formulario para enviar la respuesta -->
        <form action="procesarRespuesta.php" method="POST">
            <input type="hidden" name="id_pregunta" value="<?php echo $pregunta['id']; ?>">
            <textarea name="texto_respuesta" cols="63" rows="4" class="form-control text-white rounded-0 bg-transparent" placeholder="Escribe tu respuesta aquí..."></textarea>
            <br>
            <button type="submit">Enviar respuesta</button>
        </form>
    </div>
</body>
</html>
