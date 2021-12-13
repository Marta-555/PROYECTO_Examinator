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
  <title>Examinator</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles/css/main.css">
</head>
<body>
  <?php require_once("Vistas/header.php");?>

  <?php require_once("Vistas/nav.php");?>

  <section>
    <h2>Alta de usuario</h2>
    <form action="" method="post" class="alta">
      <p>
        Introduzca el email del usuario a registrar: <br>
        <label for="email">Email: </label>
        <input type="email" name="email" required="required">
      </p>
      <input type="submit" class="btAlta" name="registrar" value="Aceptar">
    </form>
  </section>

  <?php require_once("Vistas/footer.php");?>

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