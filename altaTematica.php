<?php
require "./cargadores/cargarhelper.php";
require "./cargadores/cargarclases.php";

Sesion::iniciar();
if(!Sesion::existe("login")) {
  header("Location:iniciarsesion.php");
}

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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles/css/main.css">
</head>
<body>
  <?php require_once("Vistas/header.php");?>

  <?php require_once("Vistas/nav.php");?>

  <section>
    <h2>Alta temática</h2>
    <form action="" method="post" class="alta">
      <p>
        Introduzca la nueva temática que desea dar de alta: <br>
        <label for="descripcion">Descripción: </label>
        <input type="text" name="descripcion" required="required">
      </p>
      <input type="submit" class="btAlta" name="aceptar" value="Aceptar">
    </form>
  </section>

  <?php require_once("Vistas/footer.php");?>
</body>
</html>