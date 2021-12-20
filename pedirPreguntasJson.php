<?php
require "cargadores/cargarhelper.php";
$obj = new stdClass();

BD::conectar();
$preguntas = BD::obtienePreguntas_Tematica();

if($preguntas != null){
    echo json_encode($preguntas);


    $obj->respuesta = "OK";

} else {
    $obj->respuesta = "ERROR";
}






?>
