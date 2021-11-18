<?php
class ExamenRealizado{

    /**
     * Atributos de clase
     */
    protected $id;
    protected $id_alumno;
    protected $id_examen;
    protected $fecha;
    protected $calificacion;
    protected $ejecucion;

    /**
     * Métodos getter
     */
    public function getId(){return $this->id; }
    public function getId_alumno(){return $this->id_alumno; }
    public function getId_examen(){return $this->id_examen; }
    public function getFecha(){return $this->fecha; }
    public function getCalificacion(){return $this->calificacion; }
    public function getEjecucion(){return $this->ejecucion; }

    /**
     * Constructor
     */
    public function __construct($row){
        $this->id = $row['id'];
        $this->id_alumno = $row['id_alumno'];
        $this->id_examen = $row['id_examen'];
        $this->fecha = $row['fecha'];
        $this->calificacion = $row['calificacion'];
        $this->ejecucion = $row['ejecucion'];
    }

?>



}