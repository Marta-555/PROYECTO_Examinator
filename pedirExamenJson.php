<?php
require "./cargadores/cargarhelper.php";
$obj = new stdClass();


BD::conectar();
$examen = BD::leerExamen();

if($examen != null){
    echo json_encode($examen);


    $obj->respuesta = "OK";

} else {
    $obj->respuesta = "ERROR";
}






?>
