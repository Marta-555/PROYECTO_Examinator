<?php
require "./cargadores/cargarhelper.php";

BD::conectar();
if(isset($_GET['tabla'])){
    $tabla = $_GET['tabla'];

    if($tabla == "usuario"){
        $campos = ["id", "nombre", "apellidos", "email", "rol"];
        $datos = BD::listarDatos("usuario", $campos, $_GET['pagina'], $_GET['filas']);
    }

    if($tabla == "tematica"){
        $campos = null;
        $datos = BD::listarDatos("tematica", $campos, $_GET['pagina'], $_GET['filas']);
    }

    if($tabla == "examen"){
        $campos = null;
        $datos = BD::listarDatos("examen", $campos, $_GET['pagina'], $_GET['filas']);
    }

    if($tabla == "historicoExam"){
        $correo = $_SESSION['login'];
        $campos = ["fecha", "calificacion"];
        $datos = BD::listarDatosExamen($correo, $campos, $_GET['pagina'], $_GET['filas']);
    }

    if($tabla == "pregunta"){
        $datos = BD::listarDatosPreg($_GET['pagina'], $_GET['filas']);
    }

    if($tabla == "examPredef"){
        $datos = BD::listarDatosPredef($_GET['pagina'], $_GET['filas']);
    }

    echo json_encode($datos);


}

?>