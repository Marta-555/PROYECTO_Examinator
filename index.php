<?php
require_once("helper/sesion.php");

Sesion::iniciar();
if(!Sesion::existe("login")) {
  header("Location: iniciarsesion.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Examinator</title>
  <link rel="stylesheet" href="styles/css/style.css">
</head>
<body>
  <?php require_once("Vistas/header.php");?>

  <?php require_once("Vistas/nav.php");?>

  <!--Contenido principal-->

  <?php require_once("Vistas/footer.php");?>

</body>
</html>