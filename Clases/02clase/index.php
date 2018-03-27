<?php

require_once "./Entidades/Persona.php";
require_once "./Entidades/Localidad.php";
require_once "./Entidades/Direccion.php";
require_once "./Entidades/Alumno.php";
require_once "./Entidades/Profesor.php";

// AVELLANEDA
$localidad = new Localidad("1877","Avellaneda");
$direccion = new Direccion("Av. Mitre","2000",$localidad);

// OBJETO PERSONA
$per = new Persona("roberto","dimitri",222222,$direccion);


// MATERIAS
$materias = array("lengua","historia");

$materiasDos = array();
$diasDos = array();

// DIAS
$dias = array("lunes","martes"); 

// LANUS
$localidadLanus = new Localidad("1900","Lanus");
$direccionDos = new Direccion("Av. Belgrano","3000",$localidadLanus);

// QUILMES
$localidadQuilmes = new Localidad("1900","Quilmes");
$direccionTres = new Direccion("Av. Calchaquí","1500",$localidadQuilmes);


// PROFESOR UNO
$profesorUno = new Profesor("profesorcito","apellido del profe",40000000,$direccionDos,$materias,$dias);
$alumno = new Alumno("alumnito","apellido alumnnito",33333,$direccion,"1200",strtotime("3/26/2017"));

// PROFESOR DOS
$profesorDos = new Profesor("Maxi", "Neiner", 5000000, $direccionTres, $materiasDos,$diasDos);

// PROFESOR TRES



var_dump($localidad);
echo "<br>";
var_dump($direccion);
echo "<br>";
var_dump($per);
echo "<br>";

// MUESTRO EL PRIMER PROFESOR
$profesorUno->mostrarHTML();



//$alumno->mostrarHTML();
// TEST
//$per->mostrarHTML();



?>
