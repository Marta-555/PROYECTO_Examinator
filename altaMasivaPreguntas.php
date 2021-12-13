<?php
require "./cargadores/cargarhelper.php";
require "./cargadores/cargarclases.php";

Sesion::iniciar();
if(!Sesion::existe("login")) {
  header("Location:iniciarsesion.php");
}

BD::conectar();



$valida = new Validacion();
if(isset($_POST['aceptar'])){
  $valida->Requerido('contenido');

  if($valida->ValidacionPasada()){
    $lineas = explode("\n", $_POST['contenido']);

    $preguntas = array();
    for($i=0; $i<count($lineas)-1; $i++){
      array_push($preguntas, explode(",", $lineas[$i]));
    }

    $cabeceras = $preguntas[0];

    //introducir los elementos del array en el constructor ???????

  }


}



//Enunciado, 3 respuestas - 1correcta, tematica, recurso
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
  <script src="js/altaMasiva.js" ></script>
</head>
<body>
  <?php require_once("Vistas/header.php");?>

  <?php require_once("Vistas/nav.php");?>

  <section>
    <form action="" method="post" class="masiva">
      <h2>Preguntas/Alta masiva de preguntas</h2>
      <input type="file" name="archivoTexto" id="archivoTexto" required="required">
      <p>
        <textarea name="contenido" id="contenido" cols="60" rows="20" ></textarea>
      </p>
      <p><input type="submit" id="btAceptar" name="aceptar" value="Aceptar"></p>
    </form>
  </section>

  <?php require_once("Vistas/footer.php");?>

</body>
</html>