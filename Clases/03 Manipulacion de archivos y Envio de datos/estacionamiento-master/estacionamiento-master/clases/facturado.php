<?php

class Facturado
{
    private $_vehiculos;
    private $_horaSalida;
    private $_importe;

    public function __constructor($vehiculo,$horaSalida)
    {
        $this->_vehiculo = $vehiculo;
        $this->_horaSalida = $horaSalida;
    }

    // retorna un listado de facturados
    public function traerTodos()
    {
        $ListaDefacturados=   array();
		$archivo=fopen("archivos/facturacion.txt", "r");//escribe y mantiene la informacion existente

			
		while(!feof($archivo))
		{
			$renglon=fgets($archivo);
			//http://www.w3schools.com/php/func_filesystem_fgets.asp
			$factura=explode("=>", $renglon);
			//http://www.w3schools.com/php/func_string_explode.asp
			$factura[1]=trim($factura[1]);
			if($factura[1]!="")
				$ListaDefacturados[]=$factura;
		}

		fclose($archivo);
		return $ListaDefacturados;
    }

    // retorna TRUE y recive un listado de facturados.
    public function guardarTodos($listado)
    {
        $archivo=fopen("archivos/facturados.txt", "w"); 	

		foreach ($listado as $facturado) 
		{
	 		  if($facturado[0]!=""){
	 		  		$dato=$facturado[0] ."=>".$facturado[1]."\n" ;
					fwrite($archivo, $dato);
	 		  }	 	
		}
		fclose($archivo);

    }

}


?>