<?php
require "cargadores/cargarhelper.php";
require "cargadores/cargarclases.php";


Sesion::iniciar();
if(!Sesion::existe("login")) {
  header("Location:iniciarsesion.php");
}

$valida = new Validacion();

if(isset($_POST['registrar'])){
  $valida->Requerido('email');
  $valida->Email('email');
  $valida->Requerido('nombre');
  $valida->Requerido('apellidos');
  $valida->Requerido('password');
  $valida->Requerido('fecha_nacim');
  $valida->Requerido('rol');


  if($valida->ValidacionPasada()){

    $usuario = new Usuario(array('email'=>$_POST['email'],'nombre'=>$_POST['nombre'],'apellidos'=>$_POST['apellidos'], 'password'=>$_POST['password'],'fecha_nacim'=>$_POST['fecha_nacim'], 'rol'=>$_POST['rol'], 'foto'=>$_POST['foto'], 'activo'=>0));

    BD::conectar();
    BD::altaUsuario($usuario);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Examinator</title>
</head>
<body>
  <h1>Alta de usuario</h1>
  <form action="" method="post">
    <p>
      <label for="email">Email</label> <br>
      <input type="email" name="email" required="required">
    </p>
    <p>
      <label for="nombre">Nombre</label> <br>
      <input type="text" name="nombre" required="required">
    </p>
    <p>
      <label for="apellidos">Apellidos</label> <br>
      <input type="text" name="apellidos" required="required">
    </p>
    <p>
      <label for="password">Contraseña</label> <br>
      <input type="password" name="password" required="required">
    </p>
    <p>
      <label for="fecha_nacim">Fecha de nacimiento</label> <br>
      <input type="date" name="fecha_nacim" required="required">
    </p>
    <p>
      <label for="rol">Rol</label> <br>
      <select name="rol">
        <option value="Administrador">1. Administrador</option>
        <option value="Alumno" selected>2. Alumno</option>
      </select>
    </p>
    <p>
      <label for="foto">Foto</label> <br>
      <input type="file" name="foto">
    </p>
    <p><input type="submit" name="registrar" value="Aceptar"></p>

  </form>
</body>
</html>