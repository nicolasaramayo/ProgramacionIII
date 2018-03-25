<?php

include_once "alumno.php";

$arraytest = array(10,8,30);
$arraytest[] = 1000;
$arraytest["apellido"]="lopez";
$arraytest["alumno"]= new Alumno();
$arraytest[]= new Alumno();
$arraytest[]="A";
$arraytest[33]="Z";
$arraytest[10]="B";

sort($arraytest); // array(3) { [0]=> int(8) [1]=> int(10) [2]=> int(30) }
var_dump($arraytest);

echo "rsort======================<br>";

rsort($arraytest); // array(3) { [0]=> int(30) [1]=> int(10) [2]=> int(8) }
var_dump($arraytest);

echo "asort======================<br>";

asort($arraytest);
var_dump($arraytest);

echo "ksort======================<br>";

ksort($arraytest);
var_dump($arraytest);

echo "arsort======================<br>";

arsort($arraytest);
var_dump($arraytest);

echo "krsort======================<br>";

krsort($arraytest);
var_dump($arraytest);

echo "<br>";



?>