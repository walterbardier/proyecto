<?php
require_once("LoginController.php");
$login = new LoginController();
$result = $login->logInPage($_POST);

header('Content-Type: application/json');
echo json_encode($result);
?>
