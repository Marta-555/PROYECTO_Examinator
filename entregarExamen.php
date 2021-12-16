<?php
require "./cargadores/cargarhelper.php";

Sesion::iniciar();
$usuario = Sesion::leer("login");



if(isset($_POST['examen'])){

    $datosJson = json_decode($_POST['examen']);
    $id_examen = $datosJson[0]->id_examen;

    $ejecucion = $_POST['examen'];

    BD::conectar();
    $id_alumno = BD::obtieneIdAlumno($usuario);

    BD::altaExamenRealizado($id_alumno, $id_examen, "5", $ejecucion);


}
