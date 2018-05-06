<?php

// SI CONINCIDE CON ALGUN REGISTRO DE ARCHIVOS DE USUARIOS.TXT
// RETORNA BIENVENIDO. 
// DE LO CONTRARIO INFORMAR SI EL USUARIO EXISTE 
// O SI ES UN ERROR DE CLAVE

require "entidades/clases/usuario.php";

$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;

Usuario::VerificarUsuario($email,$clave);

?>