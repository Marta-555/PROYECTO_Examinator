<?php
require "./cargadores/cargarhelper.php";
require "./cargadores/cargarclases.php";

Sesion::iniciar();

$valida = new Validacion();
if(isset($_POST['aceptar'])){

  $valida->Requerido('descripcion');

  if($valida->ValidacionPasada()){
    $tematica = new Tematica(array('id'=>'default', 'descripcion'=>$_POST['descripcion']));

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
      <label for="descripcion">Descripción</label> <br>
      <input type="text" name="descripcion" required="required">
    </p>
    <p><input type="submit" name="aceptar" value="Aceptar"></p>
  </form>
</body>
</html>