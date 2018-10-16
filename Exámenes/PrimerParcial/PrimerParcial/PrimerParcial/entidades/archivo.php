<?php
    class Archivo{
        //--------------------------------------------------------------------------------//	
        //--ATRIBUTOS
            private $_nombreFoto = NULL;
        //--------------------------------------------------------------------------------//
        //--------------------------------------------------------------------------------//
        //--METODOS DE CLASE
        public static function Subir($nombreDeLaFoto)
        {
            $retorno["Exito"] = TRUE;
            var_dump($_FILES["archivo"]["name"]);
            //INDICO CUAL SERA EL DESTINO DEL ARCHIVO SUBIDO
            //$archivoTmp = date("Ymd_His") . ".jpg";
            $archivoTmp = $nombreDeLaFoto . ".jpg";
            // SI LA CARPETA NO EXISTE LO CREO.
            if (!file_exists("archivos/")) {
                mkdir("archivos/");
            }

            if (!file_exists("archivos/fotos")) {
                mkdir("archivos/fotos/");
            }
            $destino = "archivos/fotos/" . $archivoTmp;
            $tipoArchivo = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
            //VERIFICO EL TAMAÑO MAXIMO QUE PERMITO SUBIR
            if ($_FILES["archivo"]["size"] > 50000000000) {
                $retorno["Exito"] = FALSE;
                $retorno["Mensaje"] = "El archivo es demasiado grande. Verifique!!!";
                return $retorno;
            }
            //OBTIENE EL TAMAÑO DE UNA IMAGEN, SI EL ARCHIVO NO ES UNA
            //IMAGEN, RETORNA FALSE
            $esImagen = getimagesize($_FILES["archivo"]["tmp_name"]);
            if($esImagen === FALSE) {//NO ES UNA IMAGEN
                $retorno["Exito"] = FALSE;
                $retorno["Mensaje"] = "S&oacute;lo son permitidas IMAGENES.";
                return $retorno;
            }
            else {// ES UNA IMAGEN
                //SOLO PERMITO CIERTAS EXTENSIONES
                if($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif"
                    && $tipoArchivo != "png") {
                    $retorno["Exito"] = FALSE;
                    $retorno["Mensaje"] = "S&oacute;lo son permitidas imagenes con extensi&oacute;n JPG, JPEG, PNG o GIF.";
                    return $retorno;
                }
            }
            
            if (!move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino)) {
                $retorno["Exito"] = FALSE;
                $retorno["Mensaje"] = "Ocurrio un error al subir el archivo. No pudo guardarse.";
                return $retorno;
            }
            else{
                $retorno["Mensaje"] = "Archivo subido exitosamente!!!"; 
                $retorno["PathTemporal"] = $archivoTmp;
                
                return $retorno;
            }
        }
        public static function Borrar($path)
        {
            return unlink($path);
        }
        public static function Mover($pathOrigen, $pathDestino)
        {
            return copy($pathOrigen, $pathDestino);
        }
    }
?>