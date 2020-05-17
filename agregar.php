<?php

session_start();
//VALIDAR SI NO TIENE CLIENTE
if (isset($_SESSION['id_cliente']) && ($_SESSION['id_cliente'] > '0')) {
    $id_cliente = $_SESSION['id_cliente'];
    $id_usuario = $_SESSION['id_usuario'];
}

// connect to database
include_once 'includes/conect.php';
$db = Database::getInstance();
$mysqli = $db->getConnection();
$mysqliP = $db->getConnection();

$id = isset($_GET['id']) ? $_GET['id'] : die;
$cantidad = isset($_GET['cantidad']) ? $_GET['cantidad'] : die;
$comentario = isset($_GET['comentario']) ? $_GET['comentario'] : die;

$created = date('Y-m-d H:i:s');


//SI NO TENGO ID DE PEDIDO CREO UNO
if (isset($_SESSION['id_pedido']) && ($_SESSION['id_pedido'] > '0')) {
    $id_pedido = $_SESSION['id_pedido'];
} else {
    $queryP = "SELECT  MAX(id_pedido) id_pedidoMax 
    FROM Detalle_pedido
    ";

    $stmtP = $mysqliP->prepare($queryP);
    $stmtP->bind_param("ii", $id_usuario, $id_cliente);

    $stmtP->execute();
    $stmtP->store_result();
    $stmtP->bind_result($id_pedidoMax);

    $stmtP->fetch();
    if ($id_pedidoMax > '0') {
        $id_pedidoMax = $id_pedidoMax + 1;
        $id_pedido = $id_pedidoMax;
        $_SESSION['id_pedido'] = $id_pedidoMax;
    } else {
        $id_pedido = "1";
        $_SESSION['id_pedido'] = $id_pedido;
//        die("NO ENCONTRO PEDIDO");
    }
}

// If ($_SESSION['id_usuario'] == '20'){
$query = "select count(*) cantidad FROM Detalle_pedido
            WHERE id_pedido = ? AND id_cliente = ? AND id_usuario = ? ";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("iii", $_SESSION['id_pedido'],  $_SESSION['id_cliente'], $_SESSION['id_usuario']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($cantidad);

            if ($cantidad == '19'){
                 header('Location: productos.php?action=maximoProductos');
                 die('maximo de productos');
            }
        }
        
//}
// insert query
$query = "INSERT INTO Detalle_pedido SET id_pedido=?, id_usuario=?, id_cliente=?, id_producto=?, cantidad=?, comentario=?, fechaAlta=?";

// prepare query
$stmt = $mysqli->prepare($query);
$stmt->bind_param("iiiiiss", $id_pedido, $id_usuario, $id_cliente, $id, $cantidad, $comentario, $created);
if ($stmt->execute()) {
    header('Location: productos.php?action=added&id=' . $id . '&name=' . $name);
}else {
    header('Location: productos.php?action=failed&id=' . $id . '&name=' . $name);
}
 