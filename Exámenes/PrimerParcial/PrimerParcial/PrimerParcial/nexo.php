<?php

require_once "entidades/proveedor.php";
require_once "entidades/archivo.php";
require_once "entidades/pedido.php";


$caso = isset($_POST['caso']) ? $_POST['caso'] : NULL;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$caso = isset($_GET['caso']) ? $_GET['caso'] : NULL;
}

switch ($caso) {
    case 'cargarProveedor':
        
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
        $email = isset($_POST['email']) ? $_POST['email'] : NULL;
        //$foto = isset($_POST['foto']) ? $_POST['foto'] : NULL;

        // SETEO EL NOMBRE DE LA FOTO: NOMBRE+LEGAJO. EXTENSION (PEPITO102525.JPG)
        $NombreDeFoto = $id;
        $respuestaDeSubir = Archivo::Subir($NombreDeFoto);

        if(!$respuestaDeSubir["Exito"]){
            echo "error " .$respuestaDeSubir["Mensaje"];
            break;
        }

        $archivo = $respuestaDeSubir["PathTemporal"];
        $p = new proveedor($id, $nombre, $email, $archivo);
        //var_dump($p);
        echo "Bien Carga" ;
        
        // SUBIR

        if(!Proveedor::Guardar($p)){
            echo "Error al generar archivo";
            break;
        }	

        break;


    case 'consultarProveedor':
    
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : NULL;

        //var_dump(proveedor::TraerTodosLosProveedores());

        if (proveedor::ExisteProveedor($nombre)) {
            echo "Existe el proveedor";
        }else {
            echo "No existe proveedor $nombre";
        }

        break;

    case 'proveedores':

        //var_dump(proveedor::TraerTodosLosProveedores());
        proveedor::MostrarProveedores();

        break;

    case 'hacerPedido':

        $id_proveedor = isset($_POST['id']) ? $_POST['id'] : NULL;
        $producto = isset($_POST['producto']) ? $_POST['producto'] : NULL;
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : NULL;
        
        $pedido = new pedido($id_proveedor,$producto, $cantidad);

        // SUBIDA ARCHIVO
        if (proveedor::ExisteIdProveedor($id_proveedor)) {
            if(!pedido::Guardar($pedido)){
                echo "Error al generar archivo";
                break;
            }	
        }else {
            echo "No Existe el id del proveedor";
            break;
        }
        

        echo "pedido cargado";


        break;

    case 'listarPedido':

    pedido::ListarPedidos();

    break;

    case 'listarPedidoProveedor':

        $idProveedor = isset($_POST['id']) ? $_POST['id'] : NULL; 
    
        pedido::ListarPedidoProveedor($idProveedor);
    
        break;

}



?>