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
// get the product id
$id = isset($_GET['id']) ? $_GET['id'] : die;

$name = isset($_GET['name']) ? $_GET['name'] : "";

//VALIDAR FECHAS
// delete query
$query = "DELETE FROM Detalle_pedido WHERE id_producto=? AND id_usuario=? AND id_cliente=? AND confirmado <> 1";

// prepare query
$stmt = $mysqli->prepare($query);

$stmt->bind_param("iii", $id, $id_usuario, $id_cliente);

// execute query
if ($stmt->execute()) {
    // redirect and tell the user product was removed
    header('Location: productos.php?action=removed&id=' . $id . '&name=' . $name);
}

// if remove failed
else {
    // redirect and tell the user it failed
    header('Location: productos.php?action=failed&id=' . $id . '&name=' . $name);
}
?>