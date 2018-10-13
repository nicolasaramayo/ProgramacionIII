<?php

require_once "./PDOEjemplo/clases/cd.php";

$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$queHago = isset($_GET['queHago']) ? $_GET['queHago'] : NULL;
}


switch ($queHago) {
    case 'TraerTodos':
        
        $lista = cd::TraerTodoLosCdsToJson();
        //var_dump($obj);

        echo $lista;

        break;

    case 'Guardar':
        
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : NULL;
        $año = isset($_POST['anio']) ? $_POST['anio'] : NULL;
        $cantante = isset($_POST['cantante']) ? $_POST['cantante'] : NULL;

        $unCd =new cd();
        $unCd->titulo= $titulo;
        $unCd->año= $año;
        $unCd->cantante= $cantante;
        $UltimoId=$unCd->InsertarElCd();

        print("Ultimo ID Guardado: $UltimoId ");

        break;

    case 'Modificar':
        
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : NULL;
        $año = isset($_POST['anio']) ? $_POST['anio'] : NULL;
        $cantante = isset($_POST['cantante']) ? $_POST['cantante'] : NULL;


        //utilización del método estático
        $unCd =cd::TraerUnCd($id);
        $unCd->titulo=$titulo;
        $unCd->año=$año;
        $unCd->cantante=$cantante;
        $cantidadDeAfectadas=$unCd->ModificarCd();
        print("filas afectadas :$cantidadDeAfectadas");


        break;

    case 'Borrar':
        
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;

        //utilización del método estático
        $unCd =cd::TraerUnCd($id);
        $cantidadDeAfectadas=$unCd->BorrarCd();
        print("Se borro! filas afectadas :$cantidadDeAfectadas");

        break;
    

    case 'TraerId':
        
        $id = isset($_GET['id']) ? $_GET['id'] : NULL;

        $obj = cd::TraerUnCd($id);

        echo cd::ToJson($obj);

        break;

    default:
        # code...
        break;
}



/*

nexo.php

caso
|------TraerTodos
|
|------Guardar
|
|------Modificar
|
|------Borrar
|
|------TraerId



TP - COMANDA
------------

ese pedido el candybar 

*/


?>