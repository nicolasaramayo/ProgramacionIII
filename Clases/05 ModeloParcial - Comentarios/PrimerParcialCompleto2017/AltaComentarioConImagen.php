<?php

// $_POST

require_once "entidades/clases/comentario.php";
require_once "entidades/clases/archivo.php";

$email_user = isset($_POST['email']) ? $_POST['email'] : NULL;
$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : NULL;
$comentario = isset($_POST['comentario']) ? $_POST['comentario'] : NULL;




$c1 = new Comentario($titulo,$email_user,$comentario,$archivo);

// DA DE ALTA EL COMENTARIO Y MUESTRA SI HUBO UN ERRROR
if(!Comentario::AltaComentario($c1)){
    echo "No se puedo guardar el comentario.";
}	


 ?>
