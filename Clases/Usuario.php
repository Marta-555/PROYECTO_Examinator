<?php
class Usuario{

    /**
     * Atributos de clase
     */
    protected $id;
    protected $email;
    protected $nombre;
    protected $apellidos;
    protected $password;
    protected $fecha_nacim;
    protected $rol;
    protected $foto;

    /**
     * Métodos getter
     */
    public function getId() {return $this->id; }
    public function getEmail() {return $this->email; }
    public function getNombre() {return $this->nombre; }
    public function getApellidos() {return $this->apellidos; }
    public function getPassword() {return $this->password; }
    public function getFecha_nacim() {return $this->fecha_nacim; }
    public function getRol() {return $this->rol; }
    public function getFoto(){return $this->foto; }

    /**
     * Constructor
     */
    public function __construct($row){
        //$this->id = $row['id'];
        $this->email = $row['email'];
        $this->nombre = $row['nombre'];
        $this->apellidos = $row['apellidos'];
        $this->password= $row['password'];
        $this->fecha_nacim= $row['fecha_nacim'];
        $this->rol = $row['rol'];
        $this->foto = $row['foto'];
    }

    /* public function __construct($email, $nombre, $apellidos, $password, $fecha_nacim, $rol, $foto, $activo){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->password= $password;
        $this->fecha_nacim= $fecha_nacim;
        $this->rol = $rol;
        $this->foto = $foto;
        $this->activo = $activo;
    }
    */
}

?>