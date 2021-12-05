<?php
class Examen {

    /**
     * Atributos de clase
     */
    protected $id;
    protected $descripcion;
    protected $n_preguntas;
    protected $duracion;
    protected $activo;

    /**
     * Métodos getter
     */
    public function getId(){return $this->id; }
    public function getDescripcion(){return $this->descripcion; }
    public function getnPreguntas(){return $this->n_preguntas; }
    public function getDuracion(){return $this->duracion; }
    public function getActivo(){return $this->activo; }

    /**
     * Constructor
     */
    public function __construct($row){
        $this->descripcion = $row['descripcion'];
        $this->n_preguntas = $row['n_preguntas'];
        $this->duracion = $row['duracion'];
        $this->activo = $row['activo'];
    }

}


?>