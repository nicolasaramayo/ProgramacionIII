<?php

require_once "./Entidades/Persona.php";
require_once "./Entidades/Localidad.php";
require_once "./Entidades/Direccion.php";
require_once "./Entidades/Alumno.php";
require_once "./Entidades/Profesor.php";


// MATERIAS
$materiasUno = array("ProgramaciónIII","ProgramacionII","Arq. de Sistemas Operativos");
$materiasDos = array("LaboratorioIII","Practica Supervisada");
$materiasTres = array("LaboratorioIII","Algoritmos");

// DIAS
$diasUno = array("Lunes","Martes","Miercoles");
$diasDos = array("Martes","Jueves");
$diasTres = array("Viernes","Jueves");

// LANUS
$localidadLanus = new Localidad("1900","Lanus");
$direccionDos = new Direccion("Av. Belgrano","3000",$localidadLanus);

// AVELLANEDA
$localidad = new Localidad("1877","Avellaneda");
$direccion = new Direccion("Av. Mitre","2000",$localidad);

// QUILMES
$localidadQuilmes = new Localidad("1900","Quilmes");
$direccionTres = new Direccion("Av. Calchaquí","1500",$localidadQuilmes);


// PROFESOR UNO
$profesorUno = new Profesor("Octavio","Villegas",29000000,$direccionDos,$materiasUno,$diasUno);

// ALUMNO UNO
$alumnoUno = new Alumno("Alfredo","Leuco",40000000,$direccion,"1201",strtotime("4/26/2017"));

// PROFESOR DOS
$profesorDos = new Profesor("Maxi", "Neiner", 5000000, $direccionTres, $materiasDos,$diasDos);

// ALUMNO DOS
$alumnoDos = new Alumno("Julian","Reynoso",38000000,$direccionDos,"1220",strtotime("2/26/2017"));

// PROFESOR TRES
$profesorTres = new Profesor("Christian", "Bauss", 28000000, $direccion, $materiasTres,$diasTres);

// ALUMNO TRES
$alumnoDos = new Alumno("Ana","Barbera",37000000,$direccionTres,"1205",strtotime("1/26/2017"));


// OBJETO PERSONA
$per = new Persona("roberto","dimitri",222222,$direccion);

var_dump($localidad);
echo "<br>";
var_dump($direccion);
echo "<br>";
var_dump($per);
echo "<br>";

// MUESTRO EL PRIMER PROFESOR
//$profesorUno->mostrarHTML();

// ARRAY DE PROFESORES.
$profesores = array($profesorUno, $profesorDos, $profesorTres);

foreach ($profesores as $profesor)
{
    $profesor->mostrarHTML();
}



//$alumno->mostrarHTML();
// TEST
//$per->mostrarHTML();



?>
