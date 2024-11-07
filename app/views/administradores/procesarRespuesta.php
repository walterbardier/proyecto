<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Procesar Pregunta</title>
    <!-- Font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + LeadMark main styles -->
    <link rel="stylesheet" href="../../../app/views/usuarios/assets/css/leadmark.css?v=<?php echo(rand()); ?>">
</head>
<body>
    <div class="container">
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

            // Obtener el id de la pregunta y el texto de la respuesta
            if (isset($_POST['id_pregunta']) && isset($_POST['texto_respuesta'])) {
                $id_pregunta = $_POST['id_pregunta'];
                $texto_respuesta = $_POST['texto_respuesta'];

                // Obtener el id del administrador que responde
                $stmt = $pdo->prepare("SELECT id FROM administradores WHERE nombre_usuario = ?");
                $stmt->execute([$_SESSION['usuario']['username']]);
                $admin = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$admin) {
                    die('Administrador no encontrado.');
                }

                $id_administrador = $admin['id'];

                // Insertar la respuesta en la tabla respuestas
                $stmt = $pdo->prepare("INSERT INTO respuestas (id_pregunta, id_administrador, texto_respuesta) VALUES (?, ?, ?)");
                $stmt->execute([$id_pregunta, $id_administrador, $texto_respuesta]);

                // Marcar la pregunta como respondida
                $stmt = $pdo->prepare("UPDATE preguntas SET estado = 'respondida' WHERE id = ?");
                $stmt->execute([$id_pregunta]);

                echo "
                
                
                
                <form>
                        <div class='form-row'>
                            <div class='form-group col-12'>
                                <br><br>
                                <h4><b>¡Respuesta enviada con éxito! :)</b></h4>
                            </div>
                            <div class='form-group col-12 mb-0'>
                                <a href='./startPage.php'><button class='btn btn-primary rounded' input type='button' name='volver'>Volver atrás</button></a>
                            </div>                          
                        </div>                          
                    </form>
                    
                    
                    ";

            } else {
                die('Datos incompletos.');
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        ?>

    </div>

