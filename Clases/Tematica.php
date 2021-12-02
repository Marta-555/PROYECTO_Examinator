<?php
class Tematica implements JsonSerializable{

    /**
     * Atributos de clase
     */
    public $id;
    public $descripcion;

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

    public function jsonSerialize(){
        return [
            'id' => $this->id,
            'descripcion' => $this->descripcion
        ];
    }
}

?>