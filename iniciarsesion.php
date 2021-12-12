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
  <link rel="stylesheet" type="text/css" href="styles/css/main.css">
</head>
<body>
  <form action="" method="post" id="login">
    <p>
      <img src="img/logo.png" name="logo" alt="logo"> <br>
    </p>
    <p>
      <label for="usuario">Usuario/email</label> <br>
      <input type="text" class="log" name="usuario" id="usuario" maxlength="50" required="required"><br>
    </p>
    <p>
      <label for="password">Contraseña</label> <br>
      <input type="password" class="log" name="password" id="password" maxlength="50" required="required"><br>
    </p>
    <p class="btnLogin">
      <input type="submit" class="log" name="aceptar" value="Aceptar">
    </p>
    <br>
    <p class="fnLogin">
      <input type='checkbox' name='recuerdame'>
      <label for="recuerdame">Recuerdame</label>
    </p>
    <p class="fnLogin"><a href="">¿Has olvidado tu contraseña?</a></p>
  </form>
</body>
</html>



