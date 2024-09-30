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
    <link rel="stylesheet" href="../views/usuarios/assets/css/leadmark.css?v=<?php echo(rand()); ?>">
</head>
<body>
    <div class="container">
    <?php
        session_start();

        if (!isset($_SESSION['usuario']['username'])) {
            die('No estás logueado. Por favor, inicia sesión.');
        }

        // Configura la conexión a la base de datos
        $host = 'localhost'; // Cambia esto si es necesario
        $dbname = 'proyecto2024';
        $user = 'root'; // Cambia esto si es necesario
        $pass = ''; // Cambia esto si es necesario

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Obtén el id_usuario a partir del nombre de usuario
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE nombre_usuario = ?");
            $stmt->execute([$_SESSION['usuario']['username']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                die("
                <br><br><br>
                <div class='col'>
                    <form>
                        <div class='form-row'>
                            <div class='form-group col-12'>
                                <h4><b>Usuario no encontrado :(</b></h4>
                            </div>
                            <div class='form-group col-12 mb-0'>
                                <a href='../views/usuarios/startPage.php'><button class='btn btn-primary rounded' input type='button' name='volver'>Volver atrás</button></a>
                            </div>                          
                        </div>                          
                    </form>
                </div>
                ");
            }

            $id_usuario = $user['id'];

            // Obtén los datos del formulario
            $ciudad = $_POST['ciudad'];
            $categoria = $_POST['categoria']; // Nueva línea para obtener la categoría
            $texto_pregunta = $_POST['texto_pregunta'];

            // Verifica si la pregunta ya existe
            $stmt = $pdo->prepare("SELECT * FROM preguntas WHERE id_usuario = ? AND ciudad = ? AND texto_pregunta = ?");
            $stmt->execute([$id_usuario, $ciudad, $texto_pregunta]);
            $pregunta_existente = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($pregunta_existente) {
                echo "
                <br><br><br>
                <div class='col'>
                    <form>
                        <div class='form-row'>
                            <div class='form-group col-12'>
                                <h4><b>¡Ya has enviado esta pregunta! :)</b></h4>
                            </div>
                            <div class='form-group col-12 mb-0'>
                                <a href='../views/usuarios/startPage.php'><button class='btn btn-primary rounded' input type='button' name='volver'>Volver atrás</button></a>
                            </div>                          
                        </div>                          
                    </form>
                </div>
                ";
            } else {
                // Inserta la nueva pregunta en la tabla preguntas
                $stmt = $pdo->prepare("INSERT INTO preguntas (id_usuario, ciudad, texto_pregunta) VALUES (?, ?, ?)");
                $stmt->execute([$id_usuario, $ciudad, $texto_pregunta]);
                
                // Obtén el id de la pregunta recién insertada
                $id_pregunta = $pdo->lastInsertId();

                // Obtén el id de la categoría seleccionada
                $stmt = $pdo->prepare("SELECT id FROM categorias_preguntas WHERE nombre_categoria = ?");
                $stmt->execute([$categoria]);
                $categoria_data = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($categoria_data) {
                    $id_categoria = $categoria_data['id'];

                    // Inserta la relación entre la pregunta y la categoría
                    $stmt = $pdo->prepare("INSERT INTO relacion_pregunta_categoria (id_pregunta, id_categoria) VALUES (?, ?)");
                    $stmt->execute([$id_pregunta, $id_categoria]);

                    echo "
                    <br><br><br>
                    <div class='col'>
                        <form>
                            <div class='form-row'>
                                <div class='form-group col-12'>
                                    <h4><b>¡Pregunta enviada con éxito!</b></h4>
                                </div>
                                <div class='form-group col-12 mb-0'>
                                    <a href='../views/usuarios/startPage.php'><button class='btn btn-primary rounded' input type='button' name='volver'>Volver atrás</button></a>
                                </div>                          
                            </div>                          
                        </form>
                    </div>
                    ";
                } else {
                    echo "<p>Error: Categoría no encontrada.</p>";
                }
            }

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>
