<?php
require "./cargadores/cargarhelper.php";
require "./cargadores/cargarclases.php";

Sesion::iniciar();

$valida = new Validacion();
if(isset($_POST['aceptar'])){

  $valida->Requerido('tema');

  if($valida->ValidacionPasada()){
    $tematica = new Tematica(array('tema'=>$_POST['tema']));

    BD::conectar();
    BD::altaTematica($tematica);
  }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Examinator</title>
</head>
<body>
  <h1>Alta temática</h1>
  <form action="" method="post">
    <p>
      <label for="tema">Descripción</label> <br>
      <input type="text" name="tema" required="required">
    </p>
    <p><input type="submit" name="aceptar" value="Aceptar"></p>
  </form>
</body>
</html>