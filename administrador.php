<?php

include_once 'functions/funciones.php';

$funciones = new funciones();

$action = isset($_GET['action']) ? $_GET['action'] : "";



switch ($action) {
    case 'nuevoUsuario':

        $nombre = $_POST['nombre'];
        $categoria = $_POST['type'];
        $password = $_POST['pasw'];
        $clidist = $_POST['CliDist'];
        echo $funciones->nuevoUsuario($nombre, $categoria, $password,$clidist);
        break;
    case 'nuevoCliente':
        $nombre = $_POST['nombre'];
        $desc = $_POST['desc'];
        $cod = $_POST['cod'];
        echo $funciones->nuevoCliente($nombre, $desc, $cod);
        break;
    case 'nuevoDescuento':
        $nombre = $_POST['nombre'];
        $desc = $_POST['desc'];
        
        echo $funciones->nuevoDescuento($nombre, $desc);
        break;
    case 'modProd':

        $id = $_POST['id'];
        $estado = $funciones->getEstadoProducto($id);
        echo json_encode($estado);
        break;
    case 'cambiarEstado':

        $id = $_POST['id'];
        $estado = $funciones->cambiarEstadoProducto($id);
        echo json_encode($estado);
        break;

    case 'cambiarCliente':

        $id = $_POST['id'];
        $_SESSION['lista'] = $_POST['lista'];
        $estado = $funciones->cambiarClientePedido($id);
        echo json_encode($estado);
        break;
    
    case 'modificoUsuario':
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $categoria = $_POST['type'];
        $password = $_POST['pasw'];
        $email = $_POST['email'];
        $cliDist = $_POST['cliDist'];
        
        echo $funciones->modificoUsuario($id,$nombre, $categoria, $password,$email,$cliDist);
        break;
    case 'cambiarEstadoUsuario':

        $id = $_POST['id'];
        $estado = $funciones->cambiarEstadoUsuario($id);
        echo json_encode($estado);
        break;
    case 'modificoCliente':
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $desc = $_POST['desc'];
        
        echo $funciones->modificoCliente($id,$nombre, $desc);
        break;
    case 'modificoDescuento':
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $desc = $_POST['desc'];
        
        echo $funciones->modificoDescuento($id,$nombre, $desc);
        break;
    case 'cambiarEstadoCliente':

        $id = $_POST['id'];
        $estado = $funciones->cambiarEstadoCliente($id);
        echo json_encode($estado);
        break;
    case 'cambiarEstadoDescuento':

        $id = $_POST['id'];
        $estado = $funciones->cambiarEstadoDescuento($id);
        echo json_encode($estado);
        break;
     case 'nuevoProducto':

        $nombre = $_POST['nombre'];
        $desc = $_POST['desc'];
        $cod = $_POST['cod'];
        echo $funciones->nuevoProducto($nombre, $desc, $cod);
        break;
}


