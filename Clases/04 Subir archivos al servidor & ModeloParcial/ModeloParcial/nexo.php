<?php

require_once ("entidades/alumno.php");
require_once ("entidades/archivo.php");
//var_dump($_POST);
//var_dump($_POST);
//var_dump($_FILES);



$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$queHago = isset($_GET['queHago']) ? $_GET['queHago'] : NULL;
}


switch($queHago){


	case "subir":
		
		$legajo = isset($_POST['legajo']) ? $_POST['legajo'] : NULL;
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;

		// SETEO EL NOMBRE DE LA FOTO: NOMBRE+LEGAJO. EXTENSION (PEPITO102525.JPG)
		$NombreDeFoto = $nombre.$legajo;
		$respuestaDeSubir = Archivo::Subir($NombreDeFoto);

		if(!$respuestaDeSubir["Exito"]){
			echo "error " .$respuestaDeSubir["Mensaje"];
			break;
		}

		$archivo = $respuestaDeSubir["PathTemporal"];


		$p = new alumno($nombre, $legajo,$archivo);
		var_dump($p);
		echo "Bien " ;
		
		// SUBIR
	
		if(!alumno::Guardar($p)){
			echo "Error al generar archivo";
			break;
		}	
	
		break;


	case 'modificar':
		$legajo = isset($_POST['legajo']) ? $_POST['legajo'] : NULL;
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;

		// SETEO EL NOMBRE DE LA FOTO: NOMBRE+LEGAJO. EXTENSION (PEPITO102525.JPG)
		$NombreDeFoto = $nombre.$legajo;
		$respuestaDeSubir = Archivo::Subir($NombreDeFoto);

		if(!$respuestaDeSubir["Exito"]){
			echo "error " .$respuestaDeSubir["Mensaje"];
			break;
		}

		$archivo = $respuestaDeSubir["PathTemporal"];


		$p = new alumno($nombre, $legajo,$archivo);
		var_dump($p);
		echo "Bien " ;
	
		if (alumno::Modificar($p)) {
			echo "El archivo ha sido modificado";
		}else {
			echo "Ocurrio un error el archivo no se modifico";
		}
		
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

	// MOSTRAR TABLA
	case 'listar':
		
		// OBTENGO TODOS EL ARRAY DE ALUMNOS.
		$Alumnos = alumno::TraerTodosLosProductos();

		//echo $Alumnos[0]->GetFoto();

		// CREO LA TABLA CON SUS CON LOS HEADERS NOMBRE LEGAJO Y FOTO.
		$tabla = '<table class="table">
					<thead style="background:rgb(14, 26, 112);color:#fff;">
						<tr>
							<th>  LEGAJO </th>
							<th>  NOMBRE     </th>
							<th>  FOTO       </th>
						</tr>  
					</thead>';   	
		
		// RECORRO EL LISTADO DE ALUMNOS Y LOS MUESTRO EN UN TD
		foreach ($Alumnos as $alumno){
		
			$tabla .= "<tr>
				<td>".$alumno->GetLegajo()."</td>
				<td>".$alumno->GetNombre()."</td>
				<td><img src='archivos/fotos/".$alumno->GetFoto()."' width='100px' height='100px'/></td>
			</tr>"; 
		}

		// ETIQUETA DE CIERRE DE LA TABLA.
		$tabla .= '</table>';		
		
		echo $tabla;
		break;
		
	default:
		echo ":(";
}

?>