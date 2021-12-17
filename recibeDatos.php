<?php
require "./cargadores/cargarhelper.php";

Sesion::iniciar();
BD::conectar();

if(isset($_POST['borrarUsuario'])){
    $id = $_POST['borrarUsuario'];
    $tabla = "usuario";

    BD::borrarDatos($id, $tabla);
}

if(isset($_POST['modificaUsuario'])){
    $id = $_POST['modificaUsuario'];
    $datos = explode(",", $_POST['valor']);

    $tabla = "usuario";
    $nombre = $datos[0];
    $apellidos = $datos[1];
    BD::modificaDatos($id, $nombre, $apellidos, $tabla);
}