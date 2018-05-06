<?php

require_once "entidades/clases/comentario.php";
require_once "entidades/clases/usuario.php";

// puede recibir datos del comentario como el:
// el usuario o titulo o nada para hacer una busqueda
// y retornara una tabla con: (la imagen del comentario, 
// el titulo, la edad del usuario y el nombre)

// GET

// USUARIO
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : NULL;
$email = isset($_GET['email']) ? $_GET['email'] : NULL;
$perfil = isset($_GET['perfil']) ? $_GET['perfil'] : NULL;
$edad  = isset($_GET['edad']) ? $_GET['edad'] : NULL;
$clave = isset($_GET['clave']) ? $_GET['clave'] : NULL;
// TITULO
$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : NULL;


// CREO UN OBJETO USUARIO.
$usuario = new Usuario($nombre,$email,$perfil,$edad,$clave);
// NADA PARA HACER UNA BUSQUEDA.
Comentario::MostrarTabla();

?>