<?php

class Localidad 
{
    private $_codigoPostal;
    private $_nombre;
    
    public function getCodigoPostal()
    {
        return $this->_codigoPostal;
    }

    public function getNombre()
    {
        return $this->_nombre;
    }

    public function setCodigoPostal($codigoPostal)
    {
        $this->_codigoPostal = $codigoPostal;
    }

    public function setNombre($nombre)
    {
        $this->_nombre = $nombre;
    }

    public function Localidad($codigoPostal,$nombre)
    {
        $this->setCodigoPostal($codigoPostal);
        $this->setNombre($nombre );
    }

    
    public function mostrarHTML()
    {
        echo "<h2> Localidad </h2>";
        echo "<p>codigoPostal: " . $this->getcodigoPostal() . "</p>";
        echo "<p>Nombre: " . $this->getNombre() . "</p>";
    }

}


?>