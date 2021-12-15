<?php
require "./cargadores/cargarhelper.php";

BD::conectar();
$examen = BD::leerExamen();


echo json_encode($examen);



?>
