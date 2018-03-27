<?php

require_once "/Persona.php";

class Profesor extends Persona implements IMostrable
{
    private $_materias = array();

    public function getMaterias()
    {
        return $this->_materias;
    }

    public function setMaterias($materia)
    {
        $this->_materias = $materia;
    }

    private $_dias = array();

    public function getDias()
    {
        return $this->_dias;
    }

    public function setDias($dias)
    {
        $this->_dias = $dias;
    }

    public function Profesor($nombre,$apellido,$dni,$direccion,$materias, $dias)
    {
        parent::Persona($nombre,$apellido,$dni,$direccion);
        $this->setMaterias($materias);
        $this->setDias($dias);
    }

    public function mostrarHTML()
    {
        echo "<h1> PROFESOR </h1>";
        //echo "<p>Materias: " . $this->getMaterias() . "</p>";
        echo "<p>Días:</p>";

        foreach ($this->getDias() as $dias) {
            echo "<li>" . $dias . "</li>";
        }
        
        echo "<p>Materias:</p>";

        foreach ($this->getMaterias() as $materias) {
            echo "<li>" . $materias . "</li>";
        }

        parent::mostrarHTML();
    }

}


?>