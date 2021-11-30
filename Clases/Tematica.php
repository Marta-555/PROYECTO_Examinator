<?php
class Tematica{

    /**
     * Atributos de clase
     */
    protected $id;
    protected $descripcion;

    /**
     * Métodos getter
     */
    public function getId(){return $this->id; }
    public function getDescripcion(){return $this->descripcion; }

    /**
     * Constructor
     */
    public function __construct($row){
        $this->id = $row['id'];
        $this->descripcion = $row['descripcion'];
    }
}

?>