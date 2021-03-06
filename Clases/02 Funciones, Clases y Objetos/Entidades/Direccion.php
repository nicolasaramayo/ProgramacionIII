<?php

require_once(realpath(dirname(__FILE__) . "/IMostrable.php"));

// SI NO ANDA CON EL REQUIRE_ONCE DE ARRIBA FIJARSE CON ESTE:
// require_once "/IMostrable.php";

class Direccion implements IMostrable
{
    private $_calle;
    private $_altura;
    private $_localidad;

    // get set
    public function getCalle()
    {
        return $this->_calle;
    }

    public function getAltura()
    {
        return $this->_altura;
    }

    public function getlocalidad()
    {
        return $this->_localidad;
    }

    public function setCalle($calle)
    {
        $this->_calle = $calle;
    }

    public function setAltura($altura)
    {
        $this->_altura = $altura;
    }

    public function setLocalidad($localidad)
    {
        $this->_localidad = $localidad;
    }

    public function Direccion($calle,$altura,$localidad)
    {
        $this->setCalle($calle);
        $this->setAltura($altura);
        $this->setLocalidad($localidad);
    }


    public function mostrarHTML()
    {
        echo "<h2> Direccion </h2>";
        echo "<p>calle: " . $this->getCalle() . "</p>";
        echo "<p>altura: " . $this->getAltura() . "</p>";
        $this->getlocalidad()->mostrarHTML();
    }

}


?>