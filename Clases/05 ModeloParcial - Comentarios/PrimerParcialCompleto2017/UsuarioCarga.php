<?php

require "entidades/clases/usuario.php";

$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : NULL;
$email = isset($_GET['email']) ? $_GET['email'] : NULL;
$perfil = isset($_GET['perfil']) ? $_GET['perfil'] : NULL;
$edad  = isset($_GET['edad']) ? $_GET['edad'] : NULL;
$clave = isset($_GET['clave']) ? $_GET['clave'] : NULL;

// SI EL USUARIO NO ES ADMIN O USER.
if ($perfil !== 'admin' && $perfil !== 'user') {
    echo "ERROR! el perfil del usuario debe ser admin o user";
}else {// SI NO

    // CREO EL USUARIO.
    $user = new Usuario($nombre,$email,$perfil,$edad,$clave);

    //GUARDO EL ARCHIVO CON EMAIL COMO IDENTIFICADOR.
    if(Usuario::Guardar($user))
    {
        echo "Se guardo el usuario";
    }else {
        echo "no se pudo guardar el usuario";
    }    
}








?>