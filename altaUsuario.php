<?php
require "cargadores/cargarhelper.php";
require "cargadores/cargarclases.php";

Sesion::iniciar();
if(!Sesion::existe("login")) {
  header("Location:iniciarsesion.php");
}

BD::conectar();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alta usuario</title>
</head>
<body>
  <h1>Alta de usuario</h1>
  <form action="" method="post">
    <p>
      <label for="email">Email</label> <br>
      <input type="email" name="email" required="required">
    </p>
    <p><input type="submit" name="registrar" value="Aceptar"></p>
  </form>
</body>
</html>


<?php
if(isset($_POST['registrar'])){
  $valida = new Validacion();
  $valida->Requerido('email');
  $valida->Email('email');

  if($valida->ValidacionPasada()){

    $email = $_POST['email'];

    if(BD::existeCorreo($email)){
      echo "El email: <strong>$email</strong> ya se encuentra registrado";
    } else {
      //Generamos un id único usando la función uniqid, con un número aleatorio como prefijo
      $id_usuario = uniqid(rand());

      BD::altaUsuarioPorConfirmar($id_usuario , $email);
      //Enviamos el correo
      Correo::enviarCorreo($email, $id_usuario);

      echo "<p><strong>¡Usuario registrado con éxito!</strong></p><p>Se ha enviado un email para la activación de la cuenta</p>";
    }
  }
}

?>