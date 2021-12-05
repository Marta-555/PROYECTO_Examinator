<?php
require "./cargadores/cargarhelper.php";
require "./cargadores/cargarclases.php";

Sesion::iniciar();
BD::conectar();

$valida = new Validacion();
if(isset($_POST['guardar'])){
  $valida->Requerido('descripcion');
  $valida->Requerido('duracion');

  if($valida->ValidacionPasada()){
    $descripcion = $_POST['descripcion'];
    $n_preguntas = $_POST['n_preguntas'];
    $duracion = $_POST['duracion'];

    //Damos de alta el examen con los datos recibidos por ajax
    $examen = new Examen(array('descripcion'=>$descripcion, 'n_preguntas'=>$n_preguntas, 'duracion'=>$duracion, 'activo'=>0));
    BD::altaExamen($examen);

    //Obtenemos la ultima id almacenada de la tabla examen
    $id_examen = BD::obtieneId("examen");
    //Convertimos la cadena recibida en un array que contendrá las id de las preguntas
    $id_preguntas = explode(",", $_POST['id_preguntas']);
    //Recorremos el array insertando los ids correspondientes en la tabla examen_preguntas
    for($i=0; $i<count($id_preguntas); $i++){
      BD::altaExamenPreguntas($id_examen, $id_preguntas[$i]);
    }
    header("Location:altaExamen.php");
  }
}

function pintarTematicas(){
  $tematicas = array();
  $tematicas = BD::obtieneTematicas();
  foreach($tematicas as $t){
    $i = $t->getId();
    $d = $t->getDescripcion();
    echo "<option value='$i'>".$d."</option>";
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="styles/css/estiloExamen.css">
  <script src="js/altaExamen.js"></script>
</head>
<body>
  <h1>Alta examen</h1>
  <form action="" method="post" id="form">
    <p>
      <label for="descripcion">Descripción</label>
      <input type="text" name="descripcion" id="descripcion" required="required">

      <label for="duracion">Duración</label>
      <input type="text" name="duracion" id="duracion" required="required" maxlength="3"> min.
    </p>

    <p>Filtrar:
      <select name="filtro" id="filtro">
        <option  value="0" selected>- Selecciona Temática -</option>
        <?php
          pintarTematicas();
        ?>
      </select>
    </p>
    <hr>

    <h3 class="enunPos">Preguntas posibles</h3>
    <h3 class="enunSel">Preguntas seleccionadas</h3>

    <div id="pPosibles"></div>

    <div id="pSeleccionadas"></div>

    <p class="btn"><input type="submit" id="guardar" name="guardar" value="Guardar"></p>
  </form>
</body>
</html>