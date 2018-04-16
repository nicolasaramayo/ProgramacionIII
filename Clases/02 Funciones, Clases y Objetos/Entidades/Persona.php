<?php

require_once(realpath(dirname(__FILE__) . "/IMostrable.php"));

// SI NO ANDA CON EL REQUIRE_ONCE DE ARRIBA FIJARSE CON ESTE:
// require_once "/IMostrable.php";

class Persona implements IMostrable
{
    //privados.
    private $_nombre;
    private $_apellido;
    private $_dni;
    private $_direccion;

    //get 
    public function getNombre()
    {
        return $this->_nombre;
    }

    public function getApellido()
    {
        return $this->_apellido;
    }

    public function getDNI()
    {
        return $this->_dni;
    }

    public function getDireccion()
    {
        return $this->_direccion;
    }

    // setters

    public function setNombre($nombre)
    {
        $this->_nombre = $nombre;
    }

    public function setApellido($apellido)
    {
        $this->_apellido = $apellido;
    }
    public function setDNI($dni)
    {
        $this->_dni = $dni;
    }

    public function setDireccion($direccion)
    {
        $this->_direccion = $direccion;
    }


    public function Persona($nombre,$apellido,$dni,$direccion)
    {
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setDNI($dni);
        $this->setDireccion($direccion);
    }

    
    public function mostrarHTML()
    {
        echo "<h2> Persona </h2>";
        echo "<p>Nombre: " . $this->getNombre() . "</p>";
        echo "<p>Apellido: " . $this->getApellido() . "</p>";
        echo "<p>D.N.I: " . $this->getDNI() . "</p>";
        $this->getDireccion()->mostrarHTML();
    }


}



?>