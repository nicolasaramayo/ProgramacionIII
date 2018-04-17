<?php

//var_dump($_POST);
//var_dump($_FILES);

$destino = "archivos/".$_FILES['archivo']['name'];

echo $destino;
// sirve para mover los archivos 
// mover del temporal dentro de esa ruta a la ruta destino
//1er parametro el tmp_name el otro el destino
// retorna algo, sino tira un error.
//if si no muestra error ejemplo
// sino teiene la carpeta archivos no lo crea.

if(file_exists("./archivos" . $_FILES['archivo']['name']))
{
    echo "error";
}else {
    move_uploaded_file($_FILES['archivo']['tmp_name'],$destino);
}

//destino trae el archivo/
$arraynombre = explode(".",$destino);
//var_dump($arraynombre);
//$extesion = end($arraynombre);
//var_dump($extesion);
$tipodearchivo = pathinfo($_FILES['archivo']['name'],PATHINFO_EXTENSION);
var_dump($tipodearchivo);




?>