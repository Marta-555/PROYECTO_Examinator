<?php
require_once('User.php');
class BD{
    private static $conex;

    /**
     * Método para establecer la conexión con la base de datos
     */
    public static function conectar(){
        self::$conex = new PDO('mysql:host=localhost;dbname=autoescuela', 'root','');
    }

    /**
     * Método que comprueba que el usuario introducido existe
     */
    public static function existeusuario($usuario, $password){
        $sql = "SELECT * FROM autoescuela.usuario WHERE email='${usuario}' AND password='${password}'";

            if($resultado = self::$conex->query($sql)){
                $fila = $resultado->fetch();
                return ($fila != null);
            }
    }

    /**
     * Método que devuelve un usuario como resultado de una consulta
     */
    public static function obtieneUsuario($usuario,$password):User {
        $sql= self::$conex->query("SELECT * FROM autoescuela.usuario where email ='${usuario}' and password='${password}'");
        while ($registro = $sql->fetch()){
            $u=new User(array('id'=>$registro['id'],'email'=>$registro['email'],
            'password'=>$registro['password'],'name'=>$registro['name']));

        }
        return $u;

    }

    INSERT INTO `usuario` (`id`, `email`, `nombre`, `apellidos`, `password`, `fecha_nacim`, `rol`, `foto`, `activo`) VALUES (NULL, 'jp@hotmail.com', 'Juan Pedro', 'Fernández Martínez', '09876', '2000-10-03', 'Alumno', '', '2');

}

?>