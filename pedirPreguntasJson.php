<?php
require "cargadores/cargarhelper.php";

BD::conectar();
$preguntas = BD::obtienePreguntas_Tematica();
//var_dump($preguntas);


echo json_encode($preguntas);
//echo json_last_error_msg();



?>
