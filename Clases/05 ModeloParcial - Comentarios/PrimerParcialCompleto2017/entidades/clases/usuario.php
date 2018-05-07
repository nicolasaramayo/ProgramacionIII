<?php


class usuario
{

//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $_nombre;
    private $_email;
    private $_perfil;
    private $_edad;
    private $_clave;
    private $_pathFoto;
//--------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
   public function GetNombre()
   {
       return $this->_nombre;
   }
   public function GetEmail()
   {
       return $this->_email;
   }
   public function GetPerfil()
   {
       return $this->_perfil;
   }
   public function GetEdad()
   {
      return $this->_edad;
   }
   public function GetClave()
   {
      return $this->_clave;
   }
   public function GetFoto()
   {
       return $this->_pathFoto;
   }

   public function SetNombre($valor)
   {
       $this->_nombre = $valor;
   }
   public function SetEmail($valor)
   {
       $this->_email = $valor;
   }
   public function SetPerfil($valor)
   {
       $this->_perfil = $valor;
   }
   public function SetEdad($valor)
   {
       $this->_edad = $valor;
   }
   public function SetClave($valor)
   {
       $this->_clave = $valor;
   }
//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
   public function __construct($nombre=NULL, $email=NULL, $perfil=NULL, $edad=NULL, $clave=NULL, $foto=NULL)
   {
       if($nombre !== NULL && $email !== NULL && $clave !== NULL && $edad !== NULL && $perfil !== NULL && $foto!== NULL){
            $this->_nombre = $nombre;
            $this->_email = $email;
            $this->_perfil = $perfil;
            $this->_edad = $edad;
            $this->_clave = $clave;
            $this->_pathFoto = $foto;
       }
   }
//--------------------------------------------------------------------------------//
//--TOSTRING
     public function ToString()
   {
         return $this->_nombre." - ".$this->_email." - ".$this->_perfil." - ".$this->_edad." - ". $this->_clave. " - ".$this->_pathFoto."\r\n";
   }
//--------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------//
//--METODOS DE CLASE
   public static function Guardar($obj)
   {
       $resultado = FALSE;

       //ABRO EL ARCHIVO
       $ar = fopen("archivos/usuarios.txt", "a");

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
   public static function TraerTodosLosUsuarios()
   {
       $ListaDeUsuariosLeidos = array();
       //leo todos los usuarios del archivo
       $archivo=fopen("archivos/usuarios.txt", "r");

       while(!feof($archivo))
       {
           $archAux = fgets($archivo);
           $usuarios = explode(" - ", $archAux);
           //http://www.w3schools.com/php/func_string_explode.asp
           $usuarios[0] = trim($usuarios[0]);
           if($usuarios[0] != ""){
               $ListaDeUsuariosLeidos[] = new usuario($usuarios[0], $usuarios[1],$usuarios[2],$usuarios[3],$usuarios[4],trim($usuarios[5]));
           }
       }
       fclose($archivo);

       return $ListaDeUsuariosLeidos;

   }
   public static function Modificar($obj)
   {
       $resultado = TRUE;

       $ListaDeUsuariosLeidos = usuario::TraerTodosLosUsuarios();
       //$ListaDeUsuarios = array();
       //$imagenParaBorrar = NULL;

       for($i=0; $i<count($ListaDeUsuariosLeidos); $i++){
           if($ListaDeUsuariosLeidos[$i]->_email == $obj->_email && $ListaDeUsuariosLeidos[$i]->_clave == $obj->_clave){//encontre el modificado, lo excluyo
               $imagenParaBorrar = trim($ListaDeUsuariosLeidos[$i]->_pathFoto);
               var_dump($ListaDeUsuariosLeidos);
               var_dump($imagenParaBorrar);
               $ListaDeUsuariosLeidos[$i] = $obj;
               //continue;
           }
           //$ListaDeUsuarios[$i] = $ListaDeUsuariosLeidos[$i];
       }
       //array_push($ListaDeUsuarios, $obj);//agrego el producto modificado

       // CREO LA CARPETA IMAGENESDEUSUARIO.
       if ($imagenParaBorrar == "sin imagen") {
           if (!file_exists("archivos/ImagenesDeUsuario/")) {
               mkdir("archivos/ImagenesDeUsuario/");
           }
       }else {
           //BORRO LA IMAGEN ANTERIOR
           unlink("archivos/ImagenesDeUsuario/".$imagenParaBorrar);
       }

      //var_dump($ListaDeUsuariosLeidos);

       //ABRO EL ARCHIVO
       $ar = fopen("archivos/usuarios.txt", "w");

       //ESCRIBO EN EL ARCHIVO
       foreach($ListaDeUsuariosLeidos as $item){
           $cant = fwrite($ar, $item->ToString());

           if($cant < 1)
           {
               $resultado = FALSE;
               break;
           }
       }

       //CIERRO EL ARCHIVO
       fclose($ar);

       return $resultado;
   }
   public static function Eliminar($legajo)
   {
       if($legajo === NULL)
           return FALSE;

       $resultado = TRUE;

       $ListaDeUsuariosLeidos = usuario::TraerTodosLosUsuarios();
       $ListaDeUsuarios = array();
       $imagenParaBorrar = NULL;

       for($i=0; $i<count($ListaDeUsuariosLeidos); $i++){
           if($ListaDeUsuariosLeidos[$i]->_legajo == $legajo){//encontre el borrado, lo excluyo
               $imagenParaBorrar = trim($ListaDeUsuariosLeidos[$i]->_foto);
               continue;
           }
           $ListaDeUsuarios[$i] = $ListaDeUsuariosLeidos[$i];
       }
       //BORRO LA IMAGEN ANTERIOR
       unlink("archivos/".$imagenParaBorrar);

       //ABRO EL ARCHIVO
       $ar = fopen("archivos/usuarios.txt", "w");

       //ESCRIBO EN EL ARCHIVO
       foreach($ListaDeUsuarios AS $item){
           $cant = fwrite($ar, $item->ToString());

           if($cant < 1)
           {
               $resultado = FALSE;
               break;
           }
       }

       //CIERRO EL ARCHIVO
       fclose($ar);

       return $resultado;
   }



   public static function VerificarUsuario($email,$clave)
   {
       $ListaDeUsuariosLeidos = usuario::TraerTodosLosUsuarios();
       $ListaDeUsuarios = array();
       $ExisteUsuario['Exito'] = FALSE;

       var_dump($ListaDeUsuariosLeidos);
       for($i=0; $i<count($ListaDeUsuariosLeidos); $i++){
           if($ListaDeUsuariosLeidos[$i]->_email == $email){//encontre el borrado, lo excluyo
               $ExisteUsuario['Exito'] = TRUE;
               break;
           }
       }

       if ($ExisteUsuario['Exito']) {

           if($ListaDeUsuariosLeidos[$i]->_clave == $clave)
           {
               $ExisteUsuario['Mensaje'] = "Bienvenido";
               return $ExisteUsuario;
           }else {
               $ExisteUsuario['Mensaje'] = "Error de clave";
               return $ExisteUsuario;
           }
       }

       $ExisteUsuario['Mensaje'] = "No existe el usuario";
       return $ExisteUsuario;
   }

//--------------------------------------------------------------------------------//




}




?>
