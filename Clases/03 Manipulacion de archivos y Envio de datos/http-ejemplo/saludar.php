<?php



echo "hola http";
echo "<br>";
var_dump($_REQUEST);
echo "<br>";
var_dump($_GET);
echo "<br>";
var_dump($_POST);

$nom = $_GET['nombre'];
$apellido = $_GET['apellido'];
echo "<br>";
echo "hola $nom $apellido";
?>