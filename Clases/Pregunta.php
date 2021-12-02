<?php
class Pregunta implements JsonSerializable{

    /**
     * Atributos de clase
     */
    public $id;
    public $enunciado;
    public $respCorrecta;
    public $recurso;
    public $tematica;

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

    public function jsonSerialize(){
        return [
            'id' => $this->id,
            'enunciado' => $this->enunciado,
            'respCorrecta' => $this->respCorrecta,
            'recurso' => $this->recurso,
            'tematica' => $this->tematica
        ];
    }
}

?>