<?php
require "./cargadores/cargarhelper.php";
require "./cargadores/cargarclases.php";

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
  <link rel="stylesheet" type="text/css" href="styles/css/main.css">
  <script src="js/altaMasiva.js" ></script>
</head>
<body>
  <?php require_once("Vistas/header.php");?>

  <?php require_once("Vistas/nav.php");?>

  <section>
    <form action="" method="post" class="masiva">
      <h2>Usuarios/Alta masiva de usuarios</h2>
      <input type="file" name="archivoTexto" id="archivoTexto" required="required">
      <p>
        <textarea name="contenido" id="contenido" cols="60" rows="20" readonly></textarea>
      </p>
      <p><input type="submit" id="btAceptar" name="aceptar" value="Aceptar"></p>
    </form>
  </section>

  <?php require_once("Vistas/footer.php");?>

</body>
</html>

<?php
if(isset($_POST['aceptar'])){
  $valida = new Validacion();
  $valida->Requerido('contenido');

  if($valida->ValidacionPasada()){
    //Separamos el contenido en un array
    $lineas = explode("\n", $_POST['contenido']);
    //Guardamos en una variable la cantidad de correos a registrar, sin contar con el útlimo (valor "")
    $numCorreos = count($lineas)-1;

    //$i=1 para que no tome las cabeceras, si no hay cabecera comienza en 0
    for($i=0; $i<$numCorreos; $i++){
        $email = $lineas[$i];
      if(BD::existeCorreo($email)){
        echo "<p>El email: <strong>$email</strong> ya se encuentra registrado</p>";
        } else {
        //Generamos un id único usando la función uniqid, con un número aleatorio como prefijo
        $id_usuario = uniqid(rand());
        BD::altaUsuarioPorConfirmar($id_usuario , $email);
        //Enviamos el correo
        Correo::enviarCorreo($email, $id_usuario);

        //Si es el último correo aparece el mensaje
        if($i == $numCorreos-1){
            echo "<p><strong>¡Los usuarios han sido registrados con éxito!</strong></p><p>Recibirán un email para la activación de la cuenta</p>";
        }
      }
    }
  }

}

?>