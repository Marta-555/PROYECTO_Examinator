<?php
require "cargadores/cargarhelper.php";
require "cargadores/cargarclases.php";


Sesion::iniciar();

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

    $usuario = new Usuario(array('email'=>$_POST['email'],'nombre'=>$_POST['nombre'],'apellidos'=>$_POST['apellidos'], 'password'=>$_POST['password'],'fecha_nacim'=>$_POST['fecha_nacim'], 'rol'=>$_POST['rol'], 'foto'=>$_POST['foto']));

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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles/css/main.css">
</head>
<body>
  <?php require_once("Vistas/header.php");?>

  <?php require_once("Vistas/nav.php");?>

  <section class="perfilUsuario">
    <h2>Perfil de usuario</h2>
    <form action="" method="post">
      <p><input type="submit" name="registrar" value="Editar"></p>
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


    </form>
  </section>

  <?php require_once("Vistas/footer.php");?>

</body>
</html>