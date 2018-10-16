<?php

require "alumno.php";
require_once "alumno.php";

$contador = 1000;

for ($i=0; $i < 5; $i++)
{ 
    include "repetidor.php";
    // include_once    solo lo va a mostrar una vez sola.
}

$contador = 2;
echo $contador;

include 'repetidor.php';

// SALIDA:
// HOLA JOSE 2.

//////////////////////////////////////////////////////////
/*
$nombre = "pedro";
$bool = TRUE;
$int = 1;
$float = 4.4;

echo "Hola Mundo PHP $nombre <br/>" ;

$sueldo = 10333;
printf("sueldo: %f <br/>", $sueldo);
printf("nombre $nombre");
echo "<br/>";

// LOS OBJ EN PHP SON ARRAYS 

//ARRAY.

$miarray = array(1,2,3);
//explora el array
var_dump($miarray);

echo "<br>";
//mata el array.
$segundoarray[33] = "hola";
$segundoarray["nombre"] = "chau";
//$segundoarray[34] = "2018";
//$segundoarray[35] = "2019";
var_dump($segundoarray);

//ARRAY ASOCIATIVO.
echo "<br>";
$arrayasociativo = array('legajo' => 19, 'nombre' => "pepito" );
var_dump($arrayasociativo);

*/

// CLASE.

/*class Alumno
{
    public $nombre;

}*/

$elalumno = new Alumno();
$elalumno->nombre = "pepe";

//agrego legajo y mail dinamicamente. 
// si llamo al obj elalumno le agrega atributos.

$elalumno->legajo = 666; // si no tengo el atributo legajo, agrega un indice legajo 
$elalumno->mail = "no tengo";

// RESULTADO:
// object(Alumno)#1 (3) { ["nombre"]=> string(4) "pepe" ["legajo"]=> int(666) ["mail"]=> string(8) "no tengo" }

$otro = $elalumno;
$otro->nombre = "juan";


//var_dump($otro);


echo "<br>";
var_dump($elalumno);

// SALIDA:
// object(Alumno)#1 (3) { ["nombre"]=> string(4) "juan" ["legajo"]=> int(666) ["mail"]=> string(8) "no tengo" } 
// object(Alumno)#1 (3) { ["nombre"]=> string(4) "juan" ["legajo"]=> int(666) ["mail"]=> string(8) "no tengo" }

?>