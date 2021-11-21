<?php
require_once('sesion.php');
require_once('BD.php');

class Login
{
    public static function Identifica($usuario, $password, $recuerdame){
        if(self::existeUsuario($usuario, $password)){
            Sesion::iniciar();
            Sesion::escribir('login', $usuario);
            if($recuerdame){
                setcookie('recuerdame', $usuario, time()+30*24*60*60);
            }
            return true;
        }
        return false;
    }

    private static function existeUsuario($usuario, $password=null){
        BD::conectar();
        return BD::existeUsuario($usuario, $password);
    }

    public static function usuarioEstaLogueado(){
        if(Sesion::leer('login')){
            return true;
        } elseif(isset($_COOKIE['recuerdame']) && self::existeUsuario($_COOKIE['recuerdame'])){
            Sesion::iniciar();
            Sesion::escribir('login', $_COOKIE['recuerdame']);
            return true;
        } else {
            return false;
        }
    }
}

?>