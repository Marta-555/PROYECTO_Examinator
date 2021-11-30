<?php
require "./cargadores/cargarhelper.php";


$valida = new Validacion();

if(isset($_POST['aceptar'])){
  $valida->Requerido('usuario');
  $valida->Requerido('password');

  if($valida->ValidacionPasada()){
    if(Login::Identifica($_POST['usuario'],$_POST['password'], isset($_POST['recuerdame'])?$_POST['recuerdame']:false)){
      header("Location: index.php");
    } else {
      header("Location: iniciarsesion.php");
    }
  } else {
    header("Location: iniciarsesion.php");
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
  <form action="" method="post">
    <p id="logo">
      <img src="img/logo.png" name="logo" alt="logo"> <br>
    </p>
    <p id="user">
      <label for="usuario">Usuario/email</label> <br>
      <input type="text" name="usuario" id="usuario" maxlength="50" required="required"><br>
    </p>
    <p id="pass">
      <label for="password">Contraseña</label> <br>
      <input type="password" name="password" id="password" maxlength="50" required="required"><br>
    </p>
    <p>
      <input type="submit" name="aceptar" value="Aceptar" class="btn">
    </p>
    <p>
      <label for="recuerdame">
        <input type='checkbox' name='recuerdame'> Recuerdame
      </label>
    </p>
    <p><a href="">¿Has olvidado tu contraseña?</a></p>
    <p><a href="">Nueva cuenta de usuario</a></p>
  </form>
</body>
</html>



