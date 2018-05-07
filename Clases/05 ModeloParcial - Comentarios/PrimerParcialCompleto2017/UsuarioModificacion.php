<?php

// $_POST

require_once "entidades/clases/usuario.php";
require_once "entidades/clases/archivo.php";

// INGRESAR TODOS LOS VALORES NECESARIOS INCLUIDO IMAGEN
// PARA REALIZAR CUALQUIER CAMBIO EN LOS DATOS 
// DE CUALQUIER USUARIO.

// MODIFICAR USUARIO.

// AQUÍ INPUTS...

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$perfil = isset($_POST['perfil']) ? $_POST['perfil'] : NULL;
$edad  = isset($_POST['edad']) ? $_POST['edad'] : NULL;
$clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;
//$archivo = $email.".".pathinfo($_FILES["archivo"]["name"] , PATHINFO_EXTENSION);

/*if (!file_exists("archivos/ImagenesDeUsuario/")) {
    mkdir("archivos/ImagenesDeUsuario");
}
$rutaArchivo = "archivos/ImagenesDeUsuario/".$archivo;
*/
		// SETEO EL NOMBRE DE LA FOTO: NOMBRE+LEGAJO. EXTENSION (PEPITO102525.JPG)
		
$respuestaDeSubir = Archivo::SubirImagenUsuario($email);
if(!$respuestaDeSubir["Exito"]){
    echo "error " .$respuestaDeSubir["Mensaje"];

}
$archivo = $respuestaDeSubir["PathTemporal"];


$usuario = new Usuario($nombre,$email,$perfil,$edad,$clave,$archivo);

// AQUÍ LLAMADA A MODIFICAR USUARIO.
if(Usuario::Modificar($usuario))
{
    /*if(move_uploaded_file($_FILES["archivo"]["tmp_name"] , $rutaArchivo))
    {
        echo "Se subio la foto";
    }else {
        echo "No se pudo subir la foto";
    }*/
    echo "Modificación Exitosa";
}else {
    echo "No se pudo modificar";
}


?>