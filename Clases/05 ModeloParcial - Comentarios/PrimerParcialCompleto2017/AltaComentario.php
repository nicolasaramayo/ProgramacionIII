<?php

// POR POST

require "entidades/clases/comentario.php";

$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : NULL;
$comentario = isset($_POST['comentario']) ? $_POST['comentario'] : NULL;


$c = new Comentario($titulo,$email,$comentario,'sin imagen');


if (Comentario::AltaComentario($c)) {
    echo "Se guardo el comentario.";
}else {
    echo "No se puedo guardar el comentario.";
}

?>
