<?php
require "clases/vehiculo.php";

$patente=$_POST['patente'];
$accion=$_POST['estacionar'];

//CREAR UN VEHICULO.
$v1 = new vehiculo($patente, date("Y-m-d H:i:s"));


if($accion=="ingreso")
{
	//GUARDAR VEHICULO.
	$v1->estacionar();
	//estacionamiento::Guardar( $patente);
}
else
{
	$v1->sacar();

		//var_dump($datos);
}

header("location:index.php");
?>
