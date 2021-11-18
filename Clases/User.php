<?php
class User{

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
    protected $activo;

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
    public function getActivo(){return $this->activo; }

    /**
     * Constructor
     */
    public function __construct($row){
        $this->id = $row['id'];
        $this->email = $row['email'];
        $this->nombre = $row['nombre'];
        $this->apellidos = $row['apellidos'];
        $this->password= $row['password'];
        $this->fecha_nacim= $row['fecha_nacim'];
        $this->rol = $row['rol'];
        $this->foto = $row['foto'];
        $this->activo = $row['activo'];
    }
}

?>