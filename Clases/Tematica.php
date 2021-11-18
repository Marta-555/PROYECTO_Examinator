<?php
class Tematica{

    /**
     * Atributos de clase
     */
    protected $id;
    protected $tema;

    /**
     * Métodos getter
     */
    public function getId(){return $this->id; }
    public function getTema(){return $this->tema; }

    /**
     * Constructor
     */
    public function __construct($row){
        $this->id = $row['id'];
        $this->tema = $row['tema'];
    }
}

?>