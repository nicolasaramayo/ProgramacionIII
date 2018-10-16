<?php

class pedido
{
    


    //--------------------------------------------------------------------------------//
        //--ATRIBUTOS
        private $_producto;
        private $_id;
        private $_cantidad;
        //private $_foto;
    //--------------------------------------------------------------------------------//
    //--------------------------------------------------------------------------------//
    //--GETTERS Y SETTERS
    public function GetProducto()
    {
        return $this->_producto;
    }
    public function GetId()
    {
        return $this->_id;
    }
    /*public function GetFoto()
    {
        return $this->_foto;
    }*/
    public function Setproducto($valor)
    {
        $this->_producto = $valor;
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
    public function __construct($id=NULL, $producto=NULL, $cantidad=NULL)
    {
        if($producto !== NULL && $id !== NULL){
            $this->_producto = $producto;
            $this->_id = $id;
            $this->_cantidad = $cantidad;
            //$this->_foto = $foto;
        }
    }
    //--------------------------------------------------------------------------------//
    //--TOSTRING	
    public function ToString()
    {
            return $this->_id." - ".$this->_producto." - ".$this->_cantidad;
    }
    //--------------------------------------------------------------------------------//
    //--------------------------------------------------------------------------------//
    //--METODOS DE CLASE
    public static function Guardar($obj)
    {
        $resultado = FALSE;
        
        //ABRO EL ARCHIVO
        $ar = fopen("archivos/pedidos.txt", "a");
        
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
    public static function TraerTodosLospedidos()
    {
        $ListaDepedidosLeidos = array();
        //leo todos los pedidos del archivo
        $archivo=fopen("archivos/pedidos.txt", "r");
        
        while(!feof($archivo))
        {
            $archAux = fgets($archivo);
            $pedidos = explode(" - ", $archAux);
            //http://www.w3schools.com/php/func_string_explode.asp
            $pedidos[0] = trim($pedidos[0]);
            if($pedidos[0] != ""){
                $ListaDepedidosLeidos[] = new pedido($pedidos[0], $pedidos[1], $pedidos[2]);
            }
        }
        fclose($archivo);
        
        return $ListaDepedidosLeidos;
        
    }

    public static function ListarPedidos()
    {
        $ListaDepedidosLeidos = pedido::TraerTodosLospedidos();

        $ListaDeproveedoresLeidos = proveedor::TraerTodosLosProveedores();

        foreach ($ListaDepedidosLeidos as $pedido) {
            echo "Pedido"."<br>";
            echo "=================" . "<br>";
            echo $pedido->ToString() . "<br>";
            echo "Proveedor"."<br>";
            echo "================="."<br>";
            foreach ($ListaDeproveedoresLeidos as $pro) {
                if ($pedido->_id === $pro->GetId()) {
                    echo $pro->ToString()."<br>";
                }
            }
        }
    }

    public static function ListarPedidoProveedor($idPro)
    {
        $ListaDepedidosLeidos = pedido::TraerTodosLospedidos();
        
        $ListaDeproveedoresLeidos = proveedor::TraerTodosLosProveedores();

        foreach ($ListaDeproveedoresLeidos as $pro) {
            echo "Proveedor"."<br>";
            echo "=================" . "<br>";
            echo $pro->ToString() . "<br>";
            echo "Pedidos"."<br>";
            echo "================="."<br>";
            foreach ($ListaDepedidosLeidos as $pedido) {
                if ($pedido->_id === $pro->GetId()) {
                    echo $pedido->ToString()."<br>";
                }
            }
        }

    }
        

}



?>