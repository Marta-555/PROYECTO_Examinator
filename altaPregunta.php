<?php
require "./cargadores/cargarhelper.php";
require "./cargadores/cargarclases.php";

Sesion::iniciar();
if(!Sesion::existe("login")) {
  header("Location:iniciarsesion.php");
}

BD::conectar();

function pintarTematicas(){
  $tematicas = array();
  $tematicas = BD::obtieneTematicas();
  foreach($tematicas as $t){
    $i = $t->getId();
    $d = $t->getDescripcion();
    echo "<option value='$i'>".$d."</option>";
  }
}

$valida = new Validacion();
if(isset($_POST['aceptar'])){
  $valida->Requerido('tematica');
  $valida->Requerido('enunciadoP');
  $valida->Requerido('resp1');
  $valida->Requerido('resp2');
  $valida->Requerido('resp3');
  $valida->Requerido('rCorrecta');

  if($valida->ValidacionPasada()){
    $recurso = "";
    if(isset($_FILES['recurso'])){
      $recurso = "img/Recursos".$_FILES['recurso']['name'];
      move_uploaded_file($_FILES['recurso']['tmp_name'],"../../".$recurso);
    }

    $p = new Pregunta(array('id'=>'default', 'enunciado'=>$_POST['enunciadoP'], 'respCorrecta'=>null, 'recurso'=>$recurso, 'tematica'=>$_POST['tematica']));
    BD::altaPregunta($p);

    $respuestas = array($_POST['resp1'], $_POST['resp2'], $_POST['resp3']);
    $idPregunta = BD::obtieneId("preguntas");

    //Insertamos las respuestas
    for($i=0; $i<count($respuestas); $i++){
      $r = new Respuesta(array('enunciado'=>$respuestas[$i], 'pregunta'=>$idPregunta));
      BD::altaRespuesta($r);
      if($i == $_POST['rCorrecta']){
        $idRespuesta = BD::obtieneId("respuestas");

        //Modificamos el campo resp_correcta de la tabla preguntas, añadiendo el id de la respCorrecta
        BD::modificaRCorrecta($idRespuesta, $idPregunta);
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
</head>
<body>
  <?php require_once("Vistas/header.php");?>

  <?php require_once("Vistas/nav.php");?>

  <section>
    <h2>Alta pregunta</h2>
    <form action="" method="post" class="altaPreg">
      <input type="file" class="fichero" name="recurso">
      <p>
        <label for="tematica">Temática: </label>
        <select name="tematica">
          <?php
            pintarTematicas();
          ?>
        </select>
      </p>
      <p>
          <label for="enunciadoP">Enunciado</label> <br>
          <textarea name="enunciadoP" id="enunciadoP" cols="30" rows="10"></textarea>
      </p>
      <p>
          <label for="resp1">Opcion 1</label> <br>
          <input type="text" name="resp1">
          <input type="radio" name="rCorrecta" value="0"> Correcta
      </p>
      <p>
          <label for="resp2">Opcion 2</label> <br>
          <input type="text" name="resp2">
          <input type="radio" name="rCorrecta" value="1"> Correcta
      </p>
      <p>
          <label for="resp3">Opcion 3</label> <br>
          <input type="text" name="resp3">
          <input type="radio" name="rCorrecta" value="2"> Correcta
      </p>

      <input type="submit" class="btAcept" name="aceptar" value="Aceptar">
    </form>
  </section>

  <?php require_once("Vistas/footer.php");?>

</body>
</html>