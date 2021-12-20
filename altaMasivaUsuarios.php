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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="styles/css/main.css">
  <script src="js/altaMasiva.js" ></script>
</head>
<body>
  <?php require_once("Vistas/header.php");?>

  <?php require_once("Vistas/nav.php");?>

  <section>
    <form action="" method="post" class="masiva">
      <h2>Alta masiva de usuarios</h2>
      <input type="file" name="archivoTexto" id="archivoTexto">
      <p>
        <textarea name="contenido" id="contenido" cols="60" rows="20"></textarea>
      </p>
      <p><input type="submit" id="btAceptar" name="aceptar" value="Aceptar"></p>

      <p id="mensaje" class="oculto">Errores encontrados: <br> Email con formato no válido</p>
    </form>


<?php

if(isset($_POST['datos'])){

    //Separamos el contenido en un array
    $lineas = explode("\n", $_POST['datos']);

    $numCorreos = count($lineas);

    for($i=0; $i<$numCorreos; $i++){
      $email = $lineas[$i];

      if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        if(BD::existeCorreo("altas_por_confirmar",$email)){
          echo "<span>El email: <strong>$email</strong> ya se encuentra registrado</span><br>";
        } else {
          //Generamos un id único usando la función uniqid, con un número aleatorio como prefijo
          $id_usuario = uniqid(rand());
          BD::altaUsuarioPorConfirmar($id_usuario , $email);
          //Enviamos el correo
          Correo::enviarCorreo($email, $id_usuario);

          //Si es el último correo aparece el mensaje
          if($i == $numCorreos-1){
            echo "<span><strong>¡Los usuarios han sido registrados con éxito!</strong></span>";
          }

        }
      }
    }

  //}

}

?>

  </section>

  <?php require_once("Vistas/footer.php");?>

</body>
</html>