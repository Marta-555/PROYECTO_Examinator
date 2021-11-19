<?php
require_once('Sesion.php');
require_once('BD.php');
class Login
{
    public static function Identifica($usuario, $password, $recuerdame){
        if(self::ExisteUsuario($usuario, $password)){
            Sesion::iniciar();
            Sesion::escribir('login', $usuario);
            if($recuerdame){
                setcookie('recuerdame', $usuario, time()+30*24*60*60);
            }
            return true;
        }
        return false;
    }

    private static function ExisteUsuario($usuario, $password=null){
        BD::conectar();
        return BD::existeusuario($usuario, $password);
    }

    public static function UsuarioEstaLogueado(){
        if(Sesion::leer('login')){
            return true;
        } elseif(isset($_COOKIE['recuerdame']) && self::ExisteUsuario($_COOKIE['recuerdame'])){
            Sesion::iniciar();
            Sesion::escribir('login', $_COOKIE['recuerdame']);
            return true;
        } else {
            return false;
        }
    }
}

?>