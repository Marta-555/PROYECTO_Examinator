<?php
    require "./cargadores/cargarhelper.php";
    BD::conectar();
?>
<header>
    <?php
        $login = $_SESSION['login'];
        if(BD::identificaRol($login) == "Administrador"){
            echo "<a href='index.php'><img class='logo' src='img/logo.png' alt='logo'></a>";
        } else {
            echo "<a href='indexAlumno.php'><img class='logo' src='img/logo.png' alt='logo'></a>";
        }
    ?>
    <h1>Bienvenido a Examinator <br>tu web de test online</h1>

    <div>
        <a href="perfilUsuario.php"><img src="img/usuario.svg" title="Perfil de usuario"></a>
        <a href="cerrarsesion.php"><img src="img/cerrar.svg" title="Cerrar sesión"></a>
    </div>

</header>