<?php
require_once("BD.php");


$error = "";
//Comprobamos que se han enviado los datos
if(isset($_POST['aceptar'])){
  $usuario = $_POST['usuario'];
  $password = $_POST['password'];

  //Si alguno de los campos está vacío mostramos el error
  if(empty($usuario) || empty($password)){
    $error = "Usuario y/o contraseña incorrecto";
  } else {
    if(BD::existeusuario($usuario, $password))
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
      <input type="text" name="usuario" id="usuario" maxlength="50"> <br>
    </p>
    <p id="pass">
      <label for="password">Contraseña</label> <br>
      <input type="password" name="password" id="password" maxlength="50"> <br>
    </p>
    <p>
      <input type="submit" name="aceptar" value="Aceptar">
    </p>
    <p><a href="">¿Has olvidado tu contraseña?</a></p>
    <p><a href="">Nueva cuenta de usuario</a></p>
  </form>
</body>
</html>

