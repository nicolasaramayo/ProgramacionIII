<?php


require_once "entidades/clases/usuario.php";
require_once "entidades/clases/comentario.php";



$email = isset($_POST['email']) ? $_POST['email'] : NULL;
$perfil = isset($_POST['perfil']) ? $_POST['perfil'] : NULL;
$clave = isset($_POST['clave']) ? $_POST['clave'] : NULL;
$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : NULL;

$ListaDeUsuariosLeidos = Usuario::TraerTodosLosUsuarios();
$ListaDeComentariosLeidos = Comentario::TraerTodosLosComentarios();

// DE SER TODOS LOS DATOS CORRECTOS ADMIN Y TITULO
// borrar el comentario y mover la foto a la carpeta backUpFotos
// colocarle la fecha de hoy.
if ($perfil == "admin") {
    /* CODIGO */
    foreach ($ListaDeUsuariosLeidos as $usuario) {
        // SI LOS DATOS SON CORRECTOS ENTRA AL IF.
        if ($usuario->GetPerfil() == $perfil && $usuario->GetEmail() == $email && $usuario->GetClave() == $clave) {
            //BUSCA EN LA LISTA DE COMENTARIOS EL EMAIL Y LO BORRA.
            foreach ($ListaDeComentariosLeidos as $comentario) {
                if ($usuario->GetEmail() == $comentario->GetEmailUsuario()) {
                    //BORRAR COMENTARIO.
                    //BORRAR IMAGEN. Y COPIARLO EN BACKUPFOTOS.
                }
            }
        }
    }
}else {
    echo "el perfil del usuario no es admin";
}

?>