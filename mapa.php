<?php
require "./cargadores/cargarhelper.php";

Sesion::iniciar();
if(!Sesion::existe("login")) {
  header("Location:iniciarsesion.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Examinator</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles/css/main.css">
</head>
<body>
  <?php require_once("Vistas/header.php");?>

  <?php require_once("Vistas/nav.php");?>

  <section class="mapaSitio">
    <h2>Mapa del sitio</h2>
    <ul>
      <li><a href="tablaUsuarios.php">Usuarios</a>
        <ul>
          <li><a href="altaUsuario.php">Alta usuario</a></li>
          <li><a href="altaMasivaUsuarios.php">Alta masiva</a></li>
        </ul>
      </li>
      <li><a href="tablaTematicas.php">Temáticas</a>
          <ul>
              <li><a href="altaTematica.php">Alta temática</a></li>
          </ul>
      </li>
      <li><a href="tablaPreguntas.php">Preguntas</a>
          <ul>
              <li><a href="altaPregunta.php">Alta pregunta</a></li>
              <li><a href="altaMasivaPreguntas.php">Alta masiva</a></li>
          </ul>
      </li>
      <li><a href="tablaExamenes.php">Exámenes</a>
          <ul>
            <li><a href="altaExamen.php">Alta examen</a></li>
            <li><a href="#">Histórico</a></li>
          </ul>
      </li>
    </ul>
  </section>

  <?php require_once("Vistas/footer.php");?>
</body>
</html>