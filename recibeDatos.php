<?php
require "./cargadores/cargarhelper.php";

Sesion::iniciar();
BD::conectar();

if(isset($_POST['borrarUsuario'])){
    $id = $_POST['borrarUsuario'];
    $tabla = "usuario";

    BD::borrarDatos($id, $tabla);
}

if(isset($_POST['borrarTema'])){
    $id = $_POST['borrarTema'];
    $tabla = "tematica";

    BD::borrarDatos($id, $tabla);
}

if(isset($_POST['borrarPreg'])){
    $id = $_POST['borrarPreg'];
    $tabla = "preguntas";

    BD::borrarDatos($id, $tabla);
    //Borrar tambien sus respuestas
}



if(isset($_POST['modificaUsuario'])){
    $id = $_POST['modificaUsuario'];
    $datos = explode(",", $_POST['valor']);

    $nombre = $datos[0];
    $apellidos = $datos[1];
    BD::modificaDatosAl($id, $nombre, $apellidos);
}

if(isset($_POST['modificaTema'])){
    $id = $_POST['modificaTema'];
    $tema = ($_POST['valor']);

    BD::modificaDatosTe($id, $tema);
}

if(isset($_POST['modificaPreg'])){
    $id = $_POST['modificaPreg'];
    $preg = ($_POST['valor']);

    BD::modificaDatosPreg($id, $preg);
}

