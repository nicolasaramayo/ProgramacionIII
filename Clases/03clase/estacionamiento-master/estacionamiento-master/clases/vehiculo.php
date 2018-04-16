<?php

class vehiculo
{
    private $_patente;
    private $_horaIngreso;

    public function __construct($patente, $horaIngreso)
    {
        $this->_patente = $patente;
        $this->_horaIngreso = $horaIngreso;
    }

    //guardar
    public function estacionar()
    {
        $archivo=fopen("archivos/estacionados.txt", "a");//escribe y mantiene la informacion existente		
		$ahora=date("Y-m-d H:i:s"); 
		$renglon=$this->getPatente()."=>".$ahora."\n";
		fwrite($archivo, $renglon); 		 
		return fclose($archivo);
    }

    public function getPatente()
    {
        return $this->_patente;
    }

    public function sacar()
    {
        $listado=Vehiculo::traerTodo();
		$ListadoAdentro=array();
		$estaElVehiculo=false;
		foreach ($listado as $auto) 
		{
			if($auto[0]==$this->getPatente())
			{
				$estaElVehiculo=true;
				$inicio=$auto[1];	
				$ahora=date("Y-m-d H:i:s"); 			 
 				$diferencia = strtotime($ahora)- strtotime($inicio) ;
 				//http://www.w3schools.com/php/func_date_strtotime.asp
 				$importe=$diferencia*15;
				$mensaje= "tiempo transcurrido:".$diferencia." segundos <br> costo $importe ";
				
				$archivo=fopen("archivos/facturacion.txt", "a"); 		  
		 		$dato=$this->getPatente() ."=> $".$importe."\n" ;
		 		fwrite($archivo, $dato);
		 		fclose($archivo);


			}
			else
			{
				$ListadoAdentro[]=$auto;				
			}
		}// fin del foreach

		if(!$estaElVehiculo)
		{
			$mensaje= "no esta esa patente!!!";
		}


		vehiculo::guardarTodo($ListadoAdentro);


		echo $mensaje;
    }

	// leer
    public static function traerTodo()
    {
        $ListaDeAutosLeida=   array();
		$archivo=fopen("archivos/estacionados.txt", "r");//escribe y mantiene la informacion existente

			
		while(!feof($archivo))
		{
			$renglon=fgets($archivo);
			//http://www.w3schools.com/php/func_filesystem_fgets.asp
			$auto=explode("=>", $renglon);
			//http://www.w3schools.com/php/func_string_explode.asp
			$auto[0]=trim($auto[0]);
			if($auto[0]!="")
				$ListaDeAutosLeida[]=$auto;
		}

		fclose($archivo);
		return $ListaDeAutosLeida;
	}

	// GuardarListado($listado)
    public static function guardarTodo($listadoVehiculos)
    {
        $archivo=fopen("archivos/estacionados.txt", "w"); 	

		foreach ($listado as $auto) 
		{
	 		  if($auto[0]!=""){
	 		  		$dato=$auto[0] ."=>".$auto[1]."\n" ;
					fwrite($archivo, $dato);
	 		  }	 	
		}
		return fclose($archivo);
	}
	

	
}


?>