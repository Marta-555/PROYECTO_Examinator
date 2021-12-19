<?php
require "./cargadores/cargarhelper.php";
require "./cargadores/cargarclases.php";

Sesion::iniciar();

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
<body id="datos">
  <a href="iniciarsesion.php"><img src="img/logo.png" alt="logo" title="Iniciar sesión"></a>
  <section>
    <h2>Datos del usuario</h2>
    <form action="" method="post" class="perfilUsuario">
      <p>Rellena los siguientes datos para activar tu cuenta en Examinator:</p>
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
        <label for="password">Repetir contraseña</label> <br>
        <input type="password" name="passwordR" required="required">
      </p>
      <p>
        <label for="fecha_nacim">Fecha de nacimiento</label> <br>
        <input type="date" name="fecha_nacim" required="required">
      </p>
      <p>
        <label for="foto">Foto</label> <br>
        <input type="file" name="foto">
      </p>
      <p><input type="submit" name="registrar" value="Registrar"></p>
    </form>
  </section>
  <?php require_once("Vistas/footer.php");?>
</body>
</html>

<?php
if(isset($_POST['registrar'])){
  $valida = new Validacion();
  $valida->Requerido('nombre');
  $valida->Requerido('apellidos');
  $valida->Requerido('password');
  $valida->Requerido('passwordR');
  $valida->Requerido('fecha_nacim');

  if($valida->ValidacionPasada()){

    $idAlta = $_GET['idAlta'];
    $email = $_GET['email'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $password = $_POST['password'];
    $passwordR = $_POST['passwordR'];
    $fecha_nacim = $_POST['fecha_nacim'];
    $foto = $_POST['foto'];

    if($password == $passwordR){
      BD::conectar();
      if(BD::existeCorreo("usuario", $email)){
        echo "<span>El usuario ya se encuentra registrado</span>";
      } else {
        $usuario = new Usuario(array('email'=>$email,'nombre'=>$nombre,'apellidos'=>$apellidos, 'password'=>$password,'fecha_nacim'=>$fecha_nacim, 'rol'=>"Alumno", 'foto'=>$foto));

        BD::altaUsuario($usuario);
        BD::borrarAltaPorConfirmar($idAlta);

        header("Location: iniciarsesion.php");
      }
    } else {
      echo "<span>Las contraseñas no coinciden</span>";
    }
  }
}

?>