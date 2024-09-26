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
        require_once("LoginController.php");
        $login = new LoginController();
        $login->logInPage($_POST);

        ?>
    </div>
</body>
