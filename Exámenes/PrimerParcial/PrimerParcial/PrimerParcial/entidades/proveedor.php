<?php
    class proveedor
    {
        
        //--------------------------------------------------------------------------------//
    //--ATRIBUTOS
        private $_nombre;
        private $_id;
        private $_email;
        private $_foto;
    //--------------------------------------------------------------------------------//
    //--------------------------------------------------------------------------------//
    //--GETTERS Y SETTERS
    public function GetNombre()
    {
        return $this->_nombre;
    }
    public function GetId()
    {
        return $this->_id;
    }
    public function GetFoto()
    {
        return $this->_foto;
    }
    public function SetNombre($valor)
    {
        $this->_nombre = $valor;
    }
    public function Setid($valor)
    {
        $this->_id = $valor;
    }
    public function SetFoto($valor)
    {
        $this->_foto = $valor;
    }
    //--------------------------------------------------------------------------------//
    //--CONSTRUCTOR
    public function __construct($id=NULL, $nombre=NULL, $email=NULL, $foto=NULL)
    {
        if($nombre !== NULL && $id !== NULL){
            $this->_nombre = $nombre;
            $this->_id = $id;
            $this->_email = $email;
            $this->_foto = $foto;
        }
    }
    //--------------------------------------------------------------------------------//
    //--TOSTRING	
    public function ToString()
    {
            return $this->_id." - ".$this->_nombre." - ".$this->_email." - " . $this->_foto;
    }
    //--------------------------------------------------------------------------------//
    //--------------------------------------------------------------------------------//
    //--METODOS DE CLASE
    public static function Guardar($obj)
    {
        $resultado = FALSE;
        
        //ABRO EL ARCHIVO
        $ar = fopen("archivos/proveedores.txt", "a");
        
        //ESCRIBO EN EL ARCHIVO
        $cant = fwrite($ar, $obj->ToString(). PHP_EOL);
        
        if($cant > 0)
        {
            $resultado = TRUE;			
        }
        //CIERRO EL ARCHIVO
        fclose($ar);
        
        return $resultado;
    }
    public static function TraerTodosLosProveedores()
    {
        $ListaDeproveedoresLeidos = array();
        //leo todos los proveedores del archivo
        $archivo=fopen("archivos/proveedores.txt", "r");
        
        while(!feof($archivo))
        {
            $archAux = fgets($archivo);
            $proveedores = explode(" - ", $archAux);
            //http://www.w3schools.com/php/func_string_explode.asp
            $proveedores[0] = trim($proveedores[0]);
            if($proveedores[0] != ""){
                $ListaDeproveedoresLeidos[] = new proveedor($proveedores[0], $proveedores[1], $proveedores[2], $proveedores[3]);
            }
        }
        fclose($archivo);
        
        return $ListaDeproveedoresLeidos;
        
    }
    public static function Modificar($obj)
    {
        $resultado = TRUE;
        
        $ListaDeproveedoresLeidos = proveedor::TraerTodosLosProveedores();
        $ListaDeproveedores = array();
        $imagenParaBorrar = NULL;
        
        for($i=0; $i<count($ListaDeproveedoresLeidos); $i++){
            if($ListaDeproveedoresLeidos[$i]->_id == $obj->_id){//encontre el modificado, lo excluyo
                $imagenParaBorrar = trim($ListaDeproveedoresLeidos[$i]->_foto);
                proveedor::GuardarImagenModificada($ListaDeproveedoresLeidos[$i]);
                $ListaDeproveedoresLeidos[$i] = $obj;
                //continue;
            }
            //$ListaDeproveedores[$i] = $ListaDeproveedoresLeidos[$i];
        }
        //array_push($ListaDeproveedores, $obj);//agrego el producto modificado
        
        //BORRO LA IMAGEN ANTERIOR
        unlink("archivos/fotos/".$imagenParaBorrar);
        
        //ABRO EL ARCHIVO
        $ar = fopen("archivos/proveedores.txt", "w");
        
        //ESCRIBO EN EL ARCHIVO
        foreach($ListaDeproveedoresLeidos AS $item){
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
    public static function Eliminar($id)
    {
        if($id === NULL)
            return FALSE;
            
        $resultado = TRUE;
        
        $ListaDeproveedoresLeidos = proveedor::TraerTodosLosProveedores();
        $ListaDeproveedores = array();
        $imagenParaBorrar = NULL;
        
        for($i=0; $i<count($ListaDeproveedoresLeidos); $i++){
            if($ListaDeproveedoresLeidos[$i]->_id == $id){//encontre el borrado, lo excluyo
                $imagenParaBorrar = trim($ListaDeproveedoresLeidos[$i]->_foto);
                proveedor::GuardarImagenBorrada($ListaDeproveedoresLeidos[$i]);
                continue;
            }
            $ListaDeproveedores[$i] = $ListaDeproveedoresLeidos[$i];
        }
        //BORRO LA IMAGEN ANTERIOR
        unlink("archivos/fotos/".$imagenParaBorrar);
        
        //ABRO EL ARCHIVO
        $ar = fopen("archivos/proveedores.txt", "w");
        
        //ESCRIBO EN EL ARCHIVO
        foreach($ListaDeproveedores AS $item){
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
            $ListaDeproveedoresLeidos = proveedor::TraerTodosLosProveedores();
            $imagenParaBorrar = NULL;
            // SI LA CARPETA NO EXISTE LA CREO.
            if (!file_exists("archivos/proveedoresborrados/")) {
                mkdir("archivos/proveedoresborrados/");
            }
            
            if (!file_exists("archivos/fotos/proveedoresborrados/")) {
                mkdir("archivos/fotos/proveedoresborrados/");
            }
            // ABRO EL ARCHIVO
            $ar = fopen("archivos/proveedoresborrados/proveedoresborrados.txt","a");
            //ESCRIBO EN EL ARCHIVO
            $cant = fwrite($ar, $obj->ToString());
            
            if($cant > 0)
            {
                $RESULTADO = TRUE;			
            }
            //CIERRO EL ARCHIVO
            fclose($ar);
            
            for ($i=0; $i < count($ListaDeproveedoresLeidos); $i++) { 
                if ($ListaDeproveedoresLeidos[$i]->_id == $obj->_id) {
                    $imagenParaBorrar = trim($ListaDeproveedoresLeidos[$i]->_foto);				
                    break;
                }
            }
            $fotoInfo = pathinfo("archivos/fotos/".$imagenParaBorrar,PATHINFO_FILENAME);
            $extension = pathinfo("archivos/fotos/".$imagenParaBorrar,PATHINFO_EXTENSION);
            echo $fotoInfo . ".". $extension;
            if (!file_exists("archivos/fotos/$imagenParaBorrar")) {
                echo "NO existe la foto";
            }else {
                copy("archivos/fotos/".$imagenParaBorrar, "archivos/fotos/proveedoresborrados/".$fotoInfo.date("Ymd_His").".".$extension);
                echo "La foto pasará a la carpeta archivos/fotos/proveedoresborrados/ (NombreFoto + Fecha de borrado).Extension";
            }
            
            return $RESULTADO;
        }
        public static function GuardarImagenModificada($obj)
        {
            $ListaDeproveedoresLeidos = proveedor::TraerTodosLosProveedores();
            $imagenParaBorrar = NULL;
            // SI LA CARPETA NO EXISTE LA CREO.
            if (!file_exists("archivos/proveedoresmodificados/")) {
                mkdir("archivos/proveedoresmodificados/");
            }
            
            if (!file_exists("archivos/fotos/proveedoresmodificados/")) {
                mkdir("archivos/fotos/proveedoresmodificados/");
            }
            // ABRO EL ARCHIVO
            $ar = fopen("archivos/proveedoresmodificados/proveedoresmodificados.txt","a");
            //ESCRIBO EN EL ARCHIVO
            $cant = fwrite($ar, $obj->ToString());
            
            if($cant > 0)
            {
                $RESULTADO = TRUE;			
            }
            //CIERRO EL ARCHIVO
            fclose($ar);
            
            for ($i=0; $i < count($ListaDeproveedoresLeidos); $i++) { 
                if ($ListaDeproveedoresLeidos[$i]->_id == $obj->_id) {
                    $imagenParaBorrar = trim($ListaDeproveedoresLeidos[$i]->_foto);				
                    break;
                }
            }
            $fotoInfo = pathinfo("archivos/fotos/".$imagenParaBorrar,PATHINFO_FILENAME);
            $extension = pathinfo("archivos/fotos/".$imagenParaBorrar,PATHINFO_EXTENSION);
            copy("archivos/fotos/".$imagenParaBorrar,"archivos/fotos/proveedoresmodificados/".$fotoInfo.date("Ymd_His").".".$extension);
            return $RESULTADO;
        }

        public static function ExisteProveedor($nombre)
        {
            $ListaDeproveedoresLeidos = proveedor::TraerTodosLosProveedores();

            foreach ($ListaDeproveedoresLeidos as $pro) {
                if ($pro->_nombre == $nombre) {
                    return TRUE;
                }
            }

            return FALSE;
        }

        public static function MostrarProveedores(){

            $ListaDeproveedoresLeidos = proveedor::TraerTodosLosProveedores();

            foreach ($ListaDeproveedoresLeidos as $pro) {
                
                echo $pro->ToString() . "<br>";
            }

        }

        public static function ExisteIdProveedor($id)
        {
            $ListaDeproveedoresLeidos = proveedor::TraerTodosLosProveedores();

            foreach ($ListaDeproveedoresLeidos as $pro) {
                if ($pro->_id == $id) {
                    return TRUE;
                }
            }

            return FALSE;
        }
    //--------------------------------------------------------------------------------//
    }
?>