<?php
class Pregunta{

    /**
     * Atributos de clase
     */
    protected $id;
    protected $enunciado;
    protected $respCorrecta;
    protected $recurso;
    protected $tematica;

    /**
     * Métodos getter
     */
    public function getId(){return $this->id; }
    public function getEnunciado(){return $this->enunciado; }
    public function getRespCorrecta(){return $this->respCorrecta; }
    public function getRecurso(){return $this->recurso; }
    public function getTematica(){return $this->tematica; }

    /**
     * Constructor
     */
    public function __construct($row){
        $this->id = $row['id'];
        $this->enunciado = $row['enunciado'];
        $this->respCorrecta = $row['respCorrecta'];
        $this->recurso = $row['recurso'];
        $this->tematica = $row['tematica'];
    }

}

?>