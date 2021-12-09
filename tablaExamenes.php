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
  <title>Examenes</title>
  <script src="js/tablaExamen.js"></script>
</head>
<body>
  <h2 align='center'>Listado de examenes</h2>

  <table align='center'>
    <thead>
      <tr>
      <th scope="col">Id</th>
        <th scope="col">Descripción</th>
        <th scope="col">Nº preguntas</th>
        <th scope="col">Duración</th>
        <th scope="col">Activado</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody id="cuerpo"></tbody>
  </table>

  <p id="paginador" align='center'></p>

</body>
</html>