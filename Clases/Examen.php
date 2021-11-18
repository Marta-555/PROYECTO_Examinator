<?php
class Examen {

    /**
     * Atributos de clase
     */
    protected $id;
    protected $descripcion;
    protected $nPreguntas;
    protected $duracion;
    protected $activo;

    /**
     * Métodos getter
     */
    public function getId(){return $this->id; }
    public function getDescripcion(){return $this->descripcion; }
    public function getnPreguntas(){return $this->nPreguntas; }
    public function getDuracion(){return $this->duracion; }
    public function getActivo(){return $this->activo; }

    /**
     * Constructor
     */
    public function __construct($row){
        $this->id = $row['id'];
        $this->descripcion = $row['descripcion'];
        $this->nPreguntas = $row['nPreguntas'];
        $this->duracion = $row['duracion'];
        $this->activo = $row['activo'];
    }

}


?>