<?php

require "usuario.php";

class comentario
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
    private $_titulo;
    private $_emailUsuario;
    private $_comentario;
    private $_pathFoto;
//--------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
    public function __construct($titulo = NULL, $email_user = NULL, $comentario = NULL, $foto = NULL)
    {
        if ($titulo !== NULL && $email_user !== NULL && $comentario !== NULL) {
            $this->_titulo = $titulo;
            $this->_emailUsuario = $email_user;
            $this->_comentario = $comentario;
        }
        
        $this->_pathFoto = $foto;

    }
//--------------------------------------------------------------------------------//
//--TOSTRING
    public function ToString()
    {
        return $this->_titulo." - ".$this->_emailUsuario." - ".$this->_comentario. " - ". $this->_pathFoto."\r\n";
    }
//--------------------------------------------------------------------------------//    
//--------------------------------------------------------------------------------//
//--METODOS DE CLASE  
    public static function Guardar($obj)
    {
        $resultado = FALSE;

        //ABRO EL ARCHIVO
        $ar = fopen("archivos/comentario.txt", "a");

        //ESCRIBO EN EL ARCHIVO
        $cant = fwrite($ar, $obj->ToString());

        if($cant > 0)
        {
            $resultado = TRUE;
        }
        //CIERRO EL ARCHIVO
        fclose($ar);

        return $resultado;
    }

    public static function AltaComentario($obj)
    {
        $ListaDeUsuariosLeidos = Usuario::TraerTodosLosUsuarios();
        $ExisteUsuario = FALSE;

        // verifico si el email existe en el archivo usuarios.txt.
        for ($i=0; $i < count($ListaDeUsuariosLeidos); $i++) {
          if ($ListaDeUsuariosLeidos[$i]->GetEmail() == $obj->_emailUsuario) {
            $ExisteUsuario = TRUE;
            break;
          }
        }

        if ($ExisteUsuario) {
          // Escribo en el archivo comentario.txt
          // y guardo el titulo, mail y comentario
          echo "existe usuario <br>";
          Comentario::Guardar($obj);
          return $ExisteUsuario;
        }else {
          // no existe el usuario!
          echo "No existe el usuario <br>";
        }

        return $ExisteUsuario;

    }

    public static function TraerTodosLosComentarios()
    {
        $ListaDeComentariosLeidos = array();
       //leo todos los comentarios del archivo
       $archivo=fopen("archivos/comentario.txt", "r");

       while(!feof($archivo))
       {
           $archAux = fgets($archivo);
           $comentarios = explode(" - ", $archAux);
           //http://www.w3schools.com/php/func_string_explode.asp
           $comentarios[0] = trim($comentarios[0]);
           if($comentarios[0] != ""){
               $ListaDeComentariosLeidos[] = new comentario($comentarios[0], $comentarios[1],$comentarios[2], trim($comentarios[3]));
           }
       }
       fclose($archivo);

       return $ListaDeComentariosLeidos;

    }


    public static function MostrarTabla()
    {
        $ListaDeUsuariosLeidos = Usuario::TraerTodosLosUsuarios();
        $ListaDeComentariosLeidos = Comentario::TraerTodosLosComentarios();

		// CREO LA TABLA CON SUS CON LOS HEADERS NOMBRE LEGAJO Y FOTO.
		$tabla = '<table class="table">
					<thead style="background:rgb(14, 26, 112);color:#fff;">
						<tr>
							<th>  FOTO </th>
							<th>  TITULO     </th>
                            <th>  EDAD       </th>
                            <th>  NOMBRE    </th>
						</tr>  
					</thead>';   	
		
		// RECORRO EL LISTADO DE COMENTARIOS Y LOS MUESTRO EN UN TD
        foreach ($ListaDeComentariosLeidos as $comentario) {
            $tabla .= "<tr>";

            // SI CONTIENE UNA IMÁGEN, LO MUESTRO O SINO MUESTRO MENSAJE QUE NO HAY FOTO.
            if ($comentario->_pathFoto == 'sin imagen') {
                $tabla .= "<td>" . $comentario->_pathFoto . "</td>";
            } else {
                $tabla .= "<td><img src='archivos/ImagenesDeComentario/".$comentario->_pathFoto."' width='100px' height='100px'/></td>";
            }
            
            $tabla .= "<td>". $comentario->_titulo . "</td>";
            foreach ($ListaDeUsuariosLeidos as $usuario) {
                if ($comentario->_emailUsuario === $usuario->GetEmail()) {
                    $tabla .= "<td>". $usuario->GetEdad()."</td>";
                    $tabla .= "<td>". $usuario->GetNombre()."</td>";
                }
            } 
        }

        // ETIQUETA DE CIERRE DE LA TABLA.
		$tabla .= '</table>';		
		
        echo $tabla;

    }


}



//--------------------------------------------------------------------------------//





?>
