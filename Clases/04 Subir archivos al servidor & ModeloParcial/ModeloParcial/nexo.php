<?php

require_once ("entidades/alumno.php");
require_once ("entidades/archivo.php");
//var_dump($_POST);
var_dump($_POST);
var_dump($_FILES);



$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

switch($queHago){


	case "Subir":

		

		$respuestaDeSubir = Archivo::Subir();

		if(!$respuestaDeSubir["Exito"]){
			echo "error " .$respuestaDeSubir["Mensaje"];
			break;
		}

		$legajo = isset($_POST['legajo']) ? $_POST['legajo'] : NULL;
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
		$archivo = $respuestaDeSubir["PathTemporal"];

		$p = new alumno($nombre, $legajo,$archivo);

		echo "Bien " ;
		/*
		$codBarra = isset($_POST['codBarra']) ? $_POST['codBarra'] : NULL;
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
		$archivo = $res["PathTemporal"];
*/
	//	$p = new Producto($codBarra, $nombre, $archivo);

	

		if(!alumno::Guardar($p)){
			echo "Error al generar archivo";
			break;
		}
	
		// MODIFICAR
		/*if ($queHago == "Modificar") {
			if (!alumno::Modificar($p)) {
				echo "Error no se pudo modificar el archivo";
				break;
			}
		}*/
		
	
		
		break;
		
	case "eliminar":
		$legajo = isset($_POST['legajo']) ? $_POST['legajo'] : NULL;
	
		if(!alumno::Eliminar($legajo)){
			$mensaje = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		}
		else{
			$mensaje = "El archivo fue escrito correctamente. Alumno eliminado CORRECTAMENTE!!!";
		}
	
		echo $mensaje;
		
		break;
		
	default:
		echo ":(";
}

?>