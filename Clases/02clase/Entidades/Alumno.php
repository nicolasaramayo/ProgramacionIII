<?php

require_once "/Persona.php";

class Alumno extends Persona implements IMostrable
{
    private $_legajo;

    public function getLegajo()
    {
        return $this->_legajo;
    }

    public function setLegajo($legajo)
    {
        $this->_legajo = $legajo;
    }

    private $_fechaInscripcion;

    public function getFechaInscripcion()
    {
        return $this->_fechaInscripcion;
    }

    public function setFechaInscripcion($fechaInscripcion)
    {
        $this->_fechaInscripcion = $fechaInscripcion;
    }


    public function Alumno($nombre,$apellido,$dni,$direccion,$legajo,$fechaInscripcion)
    {
        parent::Persona($nombre,$apellido,$dni,$direccion);
        $this->setLegajo($legajo);
        $this->setFechaInscripcion($fechaInscripcion);
    }

    public function mostrarHTML()
    {
        echo "<h1> ALUMNO </h1>";
        echo "<p>Legajo: " . $this->getLegajo() . "</p>";
        echo "<p>Fecha de Inscripcion: " . date("Y-m-d", $this->getFechaInscripcion()) . "</p>";
        parent::mostrarHTML();
    }

}


?>