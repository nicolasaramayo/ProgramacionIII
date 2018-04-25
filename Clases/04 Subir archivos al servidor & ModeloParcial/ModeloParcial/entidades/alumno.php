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
   public function GetLegajo()
   {
       return $this->_nombre;
   }
   public function GetFoto()
   {
       return $this->_foto;
   }

   public function SetNombre($valor)
   {
       $this->_nombre = $valor;
   }
   public function SetLegajo($valor)
   {
       $this->_legajo = $valor;
   }
   public function SetFoto($valor)
   {
       $this->_foto = $valor;
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

       $ListaDeAlumnosLeidos = array();

       //leo todos los productos del archivo
       $archivo=fopen("archivos/alumnos.txt", "r");
       
       while(!feof($archivo))
       {
           $archAux = fgets($archivo);
           $productos = explode(" - ", $archAux);
           //http://www.w3schools.com/php/func_string_explode.asp
           $productos[0] = trim($productos[0]);
           if($productos[0] != ""){
               $ListaDeAlumnosLeidos[] = new alumno($productos[0], $productos[1],$productos[2]);
           }
       }
       fclose($archivo);
       
       return $ListaDeAlumnosLeidos;
       
   }
   public static function Modificar($obj)
   {
       $resultado = TRUE;
       
       $ListaDeAlumnosLeidos = alumno::TraerTodosLosProductos();
       $ListaDeProductos = array();
       $imagenParaBorrar = NULL;
       
       for($i=0; $i<count($ListaDeAlumnosLeidos); $i++){
           if($ListaDeAlumnosLeidos[$i]->_legajo == $obj->_legajo){//encontre el modificado, lo excluyo
               $imagenParaBorrar = trim($ListaDeAlumnosLeidos[$i]->_foto);
               alumno::GuardarImagenModificada($ListaDeAlumnosLeidos[$i]);

               $ListaDeAlumnosLeidos[$i] = $obj;
               //continue;
           }
           //$ListaDeProductos[$i] = $ListaDeAlumnosLeidos[$i];
       }

       //array_push($ListaDeProductos, $obj);//agrego el producto modificado
       
       //BORRO LA IMAGEN ANTERIOR
       unlink("archivos/fotos/".$imagenParaBorrar);
       
       //ABRO EL ARCHIVO
       $ar = fopen("archivos/alumnos.txt", "w");
       
       //ESCRIBO EN EL ARCHIVO
       foreach($ListaDeAlumnosLeidos AS $item){
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
       
       $ListaDeAlumnosLeidos = alumno::TraerTodosLosProductos();
       $ListaDeProductos = array();
       $imagenParaBorrar = NULL;
       
       for($i=0; $i<count($ListaDeAlumnosLeidos); $i++){
           if($ListaDeAlumnosLeidos[$i]->_legajo == $legajo){//encontre el borrado, lo excluyo
               $imagenParaBorrar = trim($ListaDeAlumnosLeidos[$i]->_foto);
			   alumno::GuardarImagenBorrada($ListaDeAlumnosLeidos[$i]);
               continue;
           }
           $ListaDeProductos[$i] = $ListaDeAlumnosLeidos[$i];
       }


       //BORRO LA IMAGEN ANTERIOR
       unlink("archivos/fotos/".$imagenParaBorrar);
       
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

   public static function GuardarImagenBorrada($obj)
	{
		$ListaDeAlumnosLeidos = alumno::TraerTodosLosProductos();
		$imagenParaBorrar = NULL;

		// SI LA CARPETA NO EXISTE LA CREO.
		if (!file_exists("archivos/alumnosborrados/")) {
			mkdir("archivos/alumnosborrados/");
		}
		
		if (!file_exists("archivos/fotos/alumnosborrados/")) {
			mkdir("archivos/fotos/alumnosborrados/");
		}

		// ABRO EL ARCHIVO
		$ar = fopen("archivos/alumnosborrados/alumnosborrados.txt","a");

		//ESCRIBO EN EL ARCHIVO
		$cant = fwrite($ar, $obj->ToString());
		
		if($cant > 0)
		{
			$RESULTADO = TRUE;			
		}
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		for ($i=0; $i < count($ListaDeAlumnosLeidos); $i++) { 
			if ($ListaDeAlumnosLeidos[$i]->_legajo == $obj->_legajo) {
				$imagenParaBorrar = trim($ListaDeAlumnosLeidos[$i]->_foto);				
				break;
			}
		}
		$fotoInfo = pathinfo("archivos/fotos/".$imagenParaBorrar,PATHINFO_FILENAME);
		$extension = pathinfo("archivos/fotos/".$imagenParaBorrar,PATHINFO_EXTENSION);


		echo $fotoInfo . ".". $extension;

		if (!file_exists("archivos/fotos/$imagenParaBorrar")) {
			echo "NO existe la foto";
		}else {
            copy("archivos/fotos/".$imagenParaBorrar, "archivos/fotos/alumnosborrados/".$fotoInfo.date("Ymd_His").".".$extension);
			echo "La foto pasará a la carpeta archivos/fotos/alumnosborrados/ (NombreFoto + Fecha de borrado).Extension";
		}

		
		return $RESULTADO;
	}

	public static function GuardarImagenModificada($obj)
	{
		$ListaDeAlumnosLeidos = alumno::TraerTodosLosProductos();
		$imagenParaBorrar = NULL;

		// SI LA CARPETA NO EXISTE LA CREO.
		if (!file_exists("archivos/alumnosmodificados/")) {
			mkdir("archivos/alumnosmodificados/");
		}
		
		if (!file_exists("archivos/fotos/alumnosmodificados/")) {
			mkdir("archivos/fotos/alumnosmodificados/");
		}

		// ABRO EL ARCHIVO
		$ar = fopen("archivos/alumnosmodificados/alumnosmodificados.txt","a");

		//ESCRIBO EN EL ARCHIVO
		$cant = fwrite($ar, $obj->ToString());
		
		if($cant > 0)
		{
			$RESULTADO = TRUE;			
		}
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		for ($i=0; $i < count($ListaDeAlumnosLeidos); $i++) { 
			if ($ListaDeAlumnosLeidos[$i]->_legajo == $obj->_legajo) {
				$imagenParaBorrar = trim($ListaDeAlumnosLeidos[$i]->_foto);				
				break;
			}
		}

		$fotoInfo = pathinfo("archivos/fotos/".$imagenParaBorrar,PATHINFO_FILENAME);
		$extension = pathinfo("archivos/fotos/".$imagenParaBorrar,PATHINFO_EXTENSION);


		copy("archivos/fotos/".$imagenParaBorrar,"archivos/fotos/alumnosmodificados/".$fotoInfo.date("Ymd_His").".".$extension);

		return $RESULTADO;
	}
//--------------------------------------------------------------------------------//



}


?>