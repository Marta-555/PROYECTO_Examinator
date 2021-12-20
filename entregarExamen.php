<?php
require "./cargadores/cargarhelper.php";
$obj = new stdClass();

Sesion::iniciar();
$usuario = Sesion::leer("login");

BD::conectar();

if(isset($_POST['examen'])){

    $datosJson = json_decode($_POST['examen']);
    $id_examen = $datosJson[0]->id_examen;
    $ejecucion = $_POST['examen'];

    $campos = "id";
    $id_alumno = BD::obtieneDatosAlumno($usuario, $campos);

    BD::altaExamenRealizado($id_alumno, $id_examen, "5", $ejecucion);


    $obj->respuesta = "OK";

} else {
    $obj->respuesta = "ERROR";
}
