<?php
class Respuesta{

    /**
     * Atributos de clase
     */
    protected $id;
    protected $enunciado;
    protected $pregunta;

    /**
     * Métodos getter
     */
    public function getId(){return $this->id; }
    public function getEnunciado(){return $this->enunciado; }
    public function getPregunta(){return $this->pregunta; }

    /**
     * Constructor
     */
    public function __construct($row){
        $this->enunciado = $row['enunciado'];
        $this->pregunta = $row['pregunta'];
    }
}

?>