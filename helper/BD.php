<?php
require "./cargadores/cargarclases.php";

class BD{
    private static $conexion;

    /**
     * Método para establecer la conexión con la base de datos
     */
    public static function conectar(){
        self::$conexion = new PDO('mysql:host=localhost;dbname=autoescuela', 'root','');
        self::$conexion->query("SET NAMES utf8");
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
            $u = new Usuario(array('email'=>$registro['email'], 'nombre'=>$registro['nombre'], 'apellidos'=>$registro['apellidos'], 'password'=>$registro['password'], 'fecha_nacim'=>$registro['fecha_nacim'],'rol'=>$registro['rol'], 'foto'=>$registro['foto'], 'activo'=>$registro['activo']));
        }
        return $u;
    }

    /**
     * Método para dar da alta un usuario en la BD
     */
    public static function altaUsuario (Usuario $u) {
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

    public static function altaPregunta(Pregunta $p){
        $sql = self::$conexion->prepare("Insert into autoescuela.preguntas values(:id, :enunciado, :resp_correcta, :recurso, :tematica)");

        $id = $p->getId();
        $enunciadoP = $p->getEnunciado();
        $rCorrecta = $p->getRespCorrecta();
        $recurso = $p->getRecurso();
        $tematica = $p->getTematica();

        $sql->bindParam(':id', $id);
        $sql->bindParam(':enunciado', $enunciadoP);
        $sql->bindParam(':resp_correcta', $rCorrecta);
        $sql->bindParam(':recurso', $recurso);
        $sql->bindParam(':tematica', $tematica);

        $sql->execute();
    }

    public static function altaRespuesta(Respuesta $r){
        $sql = self::$conexion->prepare("Insert into autoescuela.respuestas values(default, :enunciado, :pregunta)");

        $enunciado = $r->getEnunciado();
        $pregunta = $r->getPregunta();

        $sql->bindParam(':enunciado', $enunciado);
        $sql->bindParam(':pregunta', $pregunta);

        $sql->execute();
    }

    public static function altaTematica(Tematica $t){
        $sql = self::$conexion->prepare("Insert into autoescuela.tematica values(default, :descripcion)");
        $tema = $t->getDescripcion();

        $sql->bindParam(':descripcion', $tema);
        $sql->execute();

    }

    public static function altaExamen(Examen $e){
        $sql = self::$conexion->prepare("Insert into autoescuela.examen values(default, :descripcion, :n_preguntas, :duracion, :activo)");

        $descripcion = $e->getDescripcion();
        $n_preguntas = $e->getnPreguntas();
        $duracion = $e->getDuracion();
        $activo = $e->getActivo();

        $sql->bindParam(':descripcion', $descripcion);
        $sql->bindParam(':n_preguntas', $n_preguntas);
        $sql->bindParam(':duracion', $duracion);
        $sql->bindParam(':activo', $activo);

        $sql->execute();
    }

    public static function altaExamenPreguntas($id_examen, $id_pregunta){
        $sql = self::$conexion->prepare("Insert into autoescuela.examen_preguntas values(:id_examen, :id_pregunta)");

        $sql->bindParam(':id_examen', $id_examen);
        $sql->bindParam(':id_pregunta', $id_pregunta);
        $sql->execute();

    }

    public static function obtieneTematicas(){
        $sql= self::$conexion->query("select * from autoescuela.tematica");

        $temas = array();
        while ($registro = $sql->fetch()){
            $t = new Tematica(array('id'=>$registro['id'], 'descripcion'=>$registro['descripcion']));
            $temas[]=$t;
        }
        return $temas;
    }

    public static function obtieneId(string $tabla){
        $sql = self::$conexion->query("Select id from autoescuela.".$tabla." order by id desc limit 1");
        while($registro = $sql->fetch()){
            $id = $registro['id'];
        }
        return $id;
    }

    public static function obtienePreguntas_Tematica(){
        $sql = self::$conexion->query("SELECT preguntas.*, tematica.id as tematica, tematica.descripcion FROM autoescuela.preguntas, autoescuela.tematica WHERE preguntas.tematica=tematica.id");

        $preguntas = array();
        while($registro = $sql->fetch(PDO::FETCH_ASSOC)){
            $p = new Pregunta(array('id'=>$registro['id'] ,'enunciado'=>$registro['enunciado'], 'respCorrecta'=>$registro['resp_correcta'], 'recurso'=>$registro['recurso'], 'tematica'=>new Tematica(array('id'=>$registro['tematica'], 'descripcion'=>$registro['descripcion']))));

            $preguntas[] = $p;
        }
        return $preguntas;

    }

    //Introducimos el id de resp_correcta en la pregunta con id...
    public static function modificaRCorrecta($idR, $idP){
        $sql = self::$conexion->prepare("Update autoescuela.preguntas set resp_correcta=".$idR." where id=".$idP."");

        $sql->execute();
    }

}

?>