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
  <script src="js/tablas/tablaHistoricoExam.js"></script>
</head>
<body>
  <?php require_once("Vistas/header.php");?>

  <?php require_once("Vistas/navAlumno.php");?>

  <section>
    <h2>Histórico de exámenes</h2>

    <table>
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Puntuación</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="cuerpo"></tbody>
    </table>

    <p id="paginador"></p>
  </section>

  <?php require_once("Vistas/footer.php");?>

</body>
</html>