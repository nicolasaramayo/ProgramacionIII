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
   public function __construct($nombre=NULL, $email=NULL, $perfil=NULL, $edad=NULL, $clave=NULL)
   {
       if($nombre !== NULL && $email !== NULL && $clave !== NULL && $edad !== NULL && $perfil !== NULL){
            $this->_nombre = $nombre;
            $this->_email = $email;
            $this->_perfil = $perfil;
            $this->_edad = $edad;
            $this->_clave = $clave;
       }
   }
//--------------------------------------------------------------------------------//
//--TOSTRING
     public function ToString()
   {
         return $this->_nombre." - ".$this->_email." - ".$this->_perfil." - ".$this->_edad." - ". $this->_clave."\r\n";
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
               $ListaDeUsuariosLeidos[] = new usuario($usuarios[0], $usuarios[1],$usuarios[2],$usuarios[3],trim($usuarios[4]));
           }
       }
       fclose($archivo);

       return $ListaDeUsuariosLeidos;

   }
   public static function Modificar($obj)
   {
       $resultado = TRUE;

       $ListaDeUsuariosLeidos = usuario::TraerTodosLosUsuarios();
       $ListaDeUsuarios = array();
       $imagenParaBorrar = NULL;

       for($i=0; $i<count($ListaDeUsuariosLeidos); $i++){
           if($ListaDeUsuariosLeidos[$i]->_legajo == $obj->_legajo){//encontre el modificado, lo excluyo
               $imagenParaBorrar = trim($ListaDeUsuariosLeidos[$i]->_foto);
               $ListaDeUsuariosLeidos[$i] = $obj;
               //continue;
           }
           //$ListaDeUsuarios[$i] = $ListaDeUsuariosLeidos[$i];
       }
       //array_push($ListaDeUsuarios, $obj);//agrego el producto modificado

       //BORRO LA IMAGEN ANTERIOR
       unlink("archivos/".$imagenParaBorrar);

       //ABRO EL ARCHIVO
       $ar = fopen("archivos/usuarios.txt", "w");

       //ESCRIBO EN EL ARCHIVO
       foreach($ListaDeUsuariosLeidos AS $item){
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
       $ExisteUsuario = FALSE;

       var_dump($ListaDeUsuariosLeidos);
       for($i=0; $i<count($ListaDeUsuariosLeidos); $i++){
           if($ListaDeUsuariosLeidos[$i]->_email == $email){//encontre el borrado, lo excluyo
               $ExisteUsuario = TRUE;
               break;
           }
       }

       if ($ExisteUsuario) {

           if($ListaDeUsuariosLeidos[$i]->_clave == $clave)
           {
               $ExisteUsuario['mensaje'] = "Bienvenido";
               return TRUE;
           }else {
               $ExisteUsuario['mensaje'] = "Error de clave";
               return FALSE;
           }
       }

       $ExisteUsuario['mensaje'] = "No existe el usuario";
       return FALSE;
   }

//--------------------------------------------------------------------------------//




}




?>
