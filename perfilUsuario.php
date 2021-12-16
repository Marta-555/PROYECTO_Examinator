<?php
require "cargadores/cargarhelper.php";
require "cargadores/cargarclases.php";


Sesion::iniciar();
if(!Sesion::existe("login")) {
  header("Location:iniciarsesion.php");
}

$usuario = Sesion::leer("login");
BD::conectar();


function pintarDatos($usuario){
  $campos = "*";
  $u = BD::obtieneDatosAlumno($usuario, $campos);

  $email = $u->getEmail();
  $nombre = $u->getNombre();
  $apellidos = $u->getApellidos();
  $password = $u->getPassword();
  $fecha_nacim = $u->getFecha_nacim();
  $foto = $u->getFoto();

  echo "<form action='' method='post' id='perfilUsuario'>";
  echo "<p>Nombre: ".$nombre." ".$apellidos."</p>";
  echo "<p>Email: ".$email."</p>";
  echo "<p>Contraseña: ********* </p>";
  echo "<p>Fecha nacimiento: ".$fecha_nacim."</p>";
  echo "<div>".$foto."</div>";
  echo "<input type='submit' name='editar' value='Editar' id='btEditar'>";
  echo "</form>";
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
  <script src="js/editarPerfil.js"></script>
</head>
<body>
  <?php require_once("Vistas/header.php");?>

  <?php require_once("Vistas/nav.php");?>

  <section>
    <h2>Perfil de usuario</h2>

    <?php pintarDatos($usuario); ?>

  </section>

  <?php require_once("Vistas/footer.php");?>

</body>
</html>