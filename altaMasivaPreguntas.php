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
    for($i=1; $i<count($lineas)-1; $i++){
      array_push($preguntas, explode(",", $lineas[$i]));
    }

    for($i=0; $i<count($preguntas); $i++){

      $enunciado = $preguntas[$i][0];
      $recurso = $preguntas[$i][1];
      $resp_1 = $preguntas[$i][2];
      $resp_2 = $preguntas[$i][3];
      $resp_3 = $preguntas[$i][4];
      $rCorrecta = $preguntas[$i][5];
      $tematica = $preguntas[$i][6];

      $p = new Pregunta(array('id'=>'default', 'enunciado'=>$enunciado, 'respCorrecta'=>null, 'recurso'=>$recurso, 'tematica'=>$tematica));
      BD::altaPregunta($p);

      $respuestas = array($resp_1, $resp_2, $resp_3);
      $idPregunta = BD::obtieneId("preguntas");

      for($a=0; $a<count($respuestas); $a++){
        $r = new Respuesta(array('enunciado'=>$respuestas[$i], 'pregunta'=>$idPregunta));
        BD::altaRespuesta($r);
        if($a == $rCorrecta-1){
          $idRespuesta = BD::obtieneId("respuestas");

          BD::modificaRCorrecta($idRespuesta, $idPregunta);
        }
      }

    }

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