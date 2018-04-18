<?php

class alumno
{
    
    //--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $_nombre;
    private $_legajo;
    private $_foto;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
   public function GetNombre()
   {
       return $this->_legajo;
   }
   public function Getlegajo()
   {
       return $this->_nombre;
   }
   public function GetFoto()
   {
       return $this->_foto;
   }

   public function SetNombre($valor)
   {
       $this->SetNombre = $valor;
   }
   public function SetLegajo($valor)
   {
       $this->SetLegajo = $valor;
   }
   public function SetFoto($valor)
   {
       $this->SetFoto = $valor;
   }

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
   public function __construct($nombre=NULL, $legajo=NULL, $foto=NULL)
   {
       if($nombre !== NULL && $legajo !== NULL){
           $this->_nombre = $nombre;
           $this->_legajo = $legajo;
           $this->_foto = $foto;
       }
   }

//--------------------------------------------------------------------------------//
//--TOSTRING	
     public function ToString()
   {
         return $this->_nombre." - ".$this->_legajo." - ".$this->_foto."\r\n";
   }
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE
   public static function Guardar($obj)
   {
       $resultado = FALSE;
       
       //ABRO EL ARCHIVO
       $ar = fopen("archivos/alumnos.txt", "a");
       
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
   public static function TraerTodosLosProductos()
   {

       $ListaDeProductosLeidos = array();

       //leo todos los productos del archivo
       $archivo=fopen("archivos/alumnos.txt", "r");
       
       while(!feof($archivo))
       {
           $archAux = fgets($archivo);
           $productos = explode(" - ", $archAux);
           //http://www.w3schools.com/php/func_string_explode.asp
           $productos[0] = trim($productos[0]);
           if($productos[0] != ""){
               $ListaDeProductosLeidos[] = new alumno($productos[0], $productos[1],$productos[2]);
           }
       }
       fclose($archivo);
       
       return $ListaDeProductosLeidos;
       
   }
   public static function Modificar($obj)
   {
       $resultado = TRUE;
       
       $ListaDeProductosLeidos = alumno::TraerTodosLosProductos();
       $ListaDeProductos = array();
       $imagenParaBorrar = NULL;
       
       for($i=0; $i<count($ListaDeProductosLeidos); $i++){
           if($ListaDeProductosLeidos[$i]->_legajo == $obj->_legajo){//encontre el modificado, lo excluyo
               $imagenParaBorrar = trim($ListaDeProductosLeidos[$i]->_foto);
               $ListaDeProductosLeidos[$i] = $obj;
               //continue;
           }
           //$ListaDeProductos[$i] = $ListaDeProductosLeidos[$i];
       }

       //array_push($ListaDeProductos, $obj);//agrego el producto modificado
       
       //BORRO LA IMAGEN ANTERIOR
       unlink("archivos/".$imagenParaBorrar);
       
       //ABRO EL ARCHIVO
       $ar = fopen("archivos/alumnos.txt", "w");
       
       //ESCRIBO EN EL ARCHIVO
       foreach($ListaDeProductosLeidos AS $item){
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
       
       $ListaDeProductosLeidos = alumno::TraerTodosLosProductos();
       $ListaDeProductos = array();
       $imagenParaBorrar = NULL;
       
       for($i=0; $i<count($ListaDeProductosLeidos); $i++){
           if($ListaDeProductosLeidos[$i]->_legajo == $legajo){//encontre el borrado, lo excluyo
               $imagenParaBorrar = trim($ListaDeProductosLeidos[$i]->_foto);
               continue;
           }
           $ListaDeProductos[$i] = $ListaDeProductosLeidos[$i];
       }

       //BORRO LA IMAGEN ANTERIOR
       unlink("archivos/".$imagenParaBorrar);
       
       //ABRO EL ARCHIVO
       $ar = fopen("archivos/alumnos.txt", "w");
       
       //ESCRIBO EN EL ARCHIVO
       foreach($ListaDeProductos AS $item){
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
//--------------------------------------------------------------------------------//



}


?>