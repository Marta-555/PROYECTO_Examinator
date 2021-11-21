<?php
require_once('./Clases/Usuario.php');

class BD{
    private static $conexion;

    /**
     * Método para establecer la conexión con la base de datos
     */
    public static function conectar(){
        self::$conexion = new PDO('mysql:host=localhost;dbname=autoescuela', 'root','');
    }

    /**
     * Método que comprueba que el usuario introducido existe
     */
    public static function existeUsuario($usuario, $password) {
        $sql = self::$conexion->query("select * from autoescuela.usuario where email='$usuario' and password='$password'");

        $resultado = $sql->fetch();
        if($resultado != 0){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Método que devuelve un usuario como resultado de una consulta
     */
    public static function obtieneUsuario($usuario,$password):Usuario {
        $sql= self::$conexion->query("select * from autoescuela.usuario where email ='$usuario' and password='$password'");
        while ($registro = $sql->fetch()){
            $u = new Usuario(array('id'=>$registro['id'],'email'=>$registro['email'], 'nombre'=>$registro['nombre'], 'apellidos'=>$registro['apellidos'], 'password'=>$registro['password'], 'fecha_nacim'=>$registro['fecha_nacim'],'rol'=>$registro['rol'], 'foto'=>$registro['foto'], 'activo'=>$registro['activo']));
        }
        return $u;

    }

    /**
     * Método para dar da alta un usuario en la BD
     */
    public static function altaUsuario (Usuario $u)
    {
        $sql = self::$conexion->prepare("Insert into autoescuela.usuario values(default, :email, :nombre, :apellidos, :password, :fecha_nacim, :rol, :foto, :activo)");

        $email = $u->getEmail();
        $nombre = $u->getNombre();
        $apellidos = $u->getApellidos();
        $password = $u->getPassword();
        $fecha_nacim = $u->getFecha_nacim();
        $rol = $u->getRol();
        $foto = $u->getFoto();
        $activo = $u->getActivo();

        $sql->bindParam(':email', $email);
        $sql->bindParam(':nombre', $nombre);
        $sql->bindParam(':apellidos', $apellidos);
        $sql->bindParam(':password', $password);
        $sql->bindParam(':fecha_nacim', $fecha_nacim);
        $sql->bindParam(':rol', $rol);
        $sql->bindParam(':foto', $foto);
        $sql->bindParam(':activo', $activo);

        $sql->execute();

    }
}

?>