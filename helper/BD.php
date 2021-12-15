<?php
require "./cargadores/cargarclases.php";
require "./cargadores/cargarhelper.php";

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

    public static function existeCorreo(string $tabla, $email) {
        $sql = self::$conexion->query("Select * from autoescuela.".$tabla." where email='$email'");

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
            $u = new Usuario(array('email'=>$registro['email'], 'nombre'=>$registro['nombre'], 'apellidos'=>$registro['apellidos'], 'password'=>$registro['password'], 'fecha_nacim'=>$registro['fecha_nacim'],'rol'=>$registro['rol'], 'foto'=>$registro['foto']));
        }
        return $u;
    }

    public static function altaUsuarioPorConfirmar($id_usuario, $email){
        $sql = self::$conexion->prepare("Insert into autoescuela.altas_por_confirmar values(:id_usuario, :email, NOW())");

        $sql->bindParam(':id_usuario', $id_usuario);
        $sql->bindParam(':email', $email);
        $sql->execute();
    }

    public static function borrarAltaPorConfirmar($idAlta){
        $sql = self::$conexion->prepare("Delete from autoescuela.altas_por_confirmar where id_usuario='$idAlta'");
        $sql->execute();
    }

    /**
     * Método para dar da alta un usuario en la BD
     */
    public static function altaUsuario (Usuario $u) {
        $sql = self::$conexion->prepare("Insert into autoescuela.usuario values(default, :email, :nombre, :apellidos, :password, :fecha_nacim, :rol, :foto)");

        $email = $u->getEmail();
        $nombre = $u->getNombre();
        $apellidos = $u->getApellidos();
        $password = $u->getPassword();
        $fecha_nacim = $u->getFecha_nacim();
        $rol = $u->getRol();
        $foto = $u->getFoto();

        $sql->bindParam(':email', $email);
        $sql->bindParam(':nombre', $nombre);
        $sql->bindParam(':apellidos', $apellidos);
        $sql->bindParam(':password', $password);
        $sql->bindParam(':fecha_nacim', $fecha_nacim);
        $sql->bindParam(':rol', $rol);
        $sql->bindParam(':foto', $foto);

        $sql->execute();

    }

    public static function altaPregunta(Pregunta $p){
        $sql = self::$conexion->prepare("Insert into autoescuela.preguntas values(default, :enunciado, :resp_correcta, :recurso, :tematica)");

        $enunciadoP = $p->getEnunciado();
        $rCorrecta = $p->getRespCorrecta();
        $recurso = $p->getRecurso();
        $tematica = $p->getTematica();

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
        $descripcion = $t->getDescripcion();

        $sql->bindParam(':descripcion', $descripcion);
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

    public static function listarDatos(string $tabla, array $campos=null, int $pagina, int $filas):array {
        $registros = array();

        $otroscampos=null;
        if(is_null($campos)){
            $otroscampos="*";
        } else {
            $otroscampos=implode(",",$campos);
        }
        $sql = self::$conexion->query("Select ".$otroscampos." from autoescuela.".$tabla);

        $registros = $sql->fetchAll();
        $total = count($registros);
        $paginas = ceil($total/$filas);

        $registros = array();
        if($pagina <= $paginas){
            $inicio = ($pagina-1) * $filas;
            $sql = self::$conexion->query("Select ".$otroscampos." from autoescuela.".$tabla." limit ".$inicio.", ".$filas);
            $registros = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $registros;

    }


    public static function listarDatosPreg(int $pagina, int $filas):array {
        $registros = array();
        $sql = self::$conexion->query("SELECT preguntas.id, preguntas.enunciado, tematica.descripcion FROM autoescuela.preguntas, autoescuela.tematica WHERE preguntas.tematica=tematica.id");

        $registros = $sql->fetchAll();
        $total = count($registros);
        $paginas = ceil($total/$filas);

        $registros = array();
        if($pagina <= $paginas){
            $inicio = ($pagina-1) * $filas;
            $sql = self::$conexion->query("SELECT preguntas.id, preguntas.enunciado, tematica.descripcion FROM autoescuela.preguntas, autoescuela.tematica WHERE preguntas.tematica=tematica.id limit ".$inicio.",".$filas);
            $registros = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $registros;
    }

    public static function listarDatosExamen(string $correo, int $pagina, int $filas):array {
        $sqlId = self::$conexion->query("Select id from autoescuela.usuario where email = '$correo'");
        while($registro = $sqlId->fetch()){
            $id = $registro['id'];
        }

        $registros = array();
        $sql = self::$conexion->query("Select fecha, calificacion from autoescuela.examen_realizado where id_alumno='$id'");

        $registros = $sql->fetchAll();
        $total = count($registros);
        $paginas = ceil($total/$filas);

        $registros = array();
        if($pagina <= $paginas){
            $inicio = ($pagina-1) * $filas;
            $sql = self::$conexion->query("Select fecha, calificacion from autoescuela.examen_realizado where id_alumno='$id'");
            $registros = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $registros;

    }

    public static function listarDatosPredef(int $pagina, int $filas):array {
        $registros = array();
        $sql = self::$conexion->query("Select id, descripcion, n_preguntas, duracion from autoescuela.examen where activo='1'");

        $registros = $sql->fetchAll();
        $total = count($registros);
        $paginas = ceil($total/$filas);

        $registros = array();
        if($pagina <= $paginas){
            $inicio = ($pagina-1) * $filas;
            $sql = self::$conexion->query("Select id, descripcion, n_preguntas, duracion from autoescuela.examen where activo='1'");
            $registros = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $registros;
    }

    public static function identificaRol($login) {
        $sql = self::$conexion->query("Select rol from autoescuela.usuario where email = '$login'");

        while($registro = $sql->fetch()){
            $rol = $registro['rol'];
        }
        return $rol;
    }

    //Método que devuelve un array con todos los datos que componen un examen
    public static function leerExamen(){
        $examen = array();
        $id = self::obtieneIdExamen();

        //Tomamos los datos del examen
        $sql = self::$conexion->query("SELECT id, descripcion, n_preguntas, duracion FROM autoescuela.examen as e where id='$id'");

        $examen = $sql->fetch(PDO::FETCH_ASSOC);

        //Tomamos los datos de las preguntas y las incorporamos al examen
        $preguntas = self::preguntasExamen($id);
        $examen['preguntas'] = $preguntas;

        return $examen;
    }

    //Obtenemos el id de un examen de forma aleatoria
    public static function obtieneIdExamen(){
        //Consultamos los exámenes que esté activos
        $sql = self::$conexion->query("SELECT id FROM autoescuela.examen where activo='1'");
        $disponibles = array();
        while($registro = $sql->fetch()){
            $disponibles[] = $registro['id'];
        }
        //Escogemos aleatoriamente uno y obtenemos su id
        $indice = array_rand($disponibles);
        $id = $disponibles[$indice];

        return $id;
    }

    public static function preguntasExamen($idExamen){
        $preguntas = array();

        $sql = self::$conexion->query("select e.id_pregunta, enunciado, recurso from autoescuela.examen_preguntas e join autoescuela.preguntas p on e.id_pregunta = p.id where e.id_examen = '$idExamen'");

        $p = array();
        while($registro = $sql->fetch(PDO::FETCH_ASSOC)){
            $p = $registro;
            $idP = $registro['id_pregunta'];

            //Tomamos los datos de las respuestas y se las añadimos a cada pregunta
            $r = self::respPreguntas($idP);
            $p['respuestas'] = $r;

            $preguntas[] = $p;
        }
        return $preguntas;
    }

    //Obtenemos las respuestas de cada pregunta
    public static function respPreguntas($idPregunta){
        $r = array();
        $sql = self::$conexion->query("select id, enunciado from autoescuela.respuestas where pregunta ='$idPregunta'");
        while($registros = $sql->fetch(PDO::FETCH_ASSOC)){
            $r[] = $registros;
        }
        return $r;
    }

}

?>