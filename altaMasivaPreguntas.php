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
  <title>Alta masiva de preguntas</title>
  <script src="js/altaMasiva.js" ></script>
</head>
<body>
  <form action="" method="post">
    <h2>Preguntas/Alta masiva de preguntas</h2>
    <input type="file" name="archivoTexto" id="archivoTexto" required="required">
    <p>
      <textarea name="contenido" id="contenido" cols="60" rows="20" ></textarea>
    </p>
    <p><input type="submit" id="btAceptar" name="aceptar" value="Aceptar"></p>
  </form>
</body>
</html>