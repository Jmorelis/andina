<?php

session_start();

if (isset($_SESSION['id_cliente']) && ($_SESSION['id_cliente']>'0')){
    $id_cliente = $_SESSION['id_cliente'];
    $id_usuario = $_SESSION['id_usuario'];
}

// connect to database
include_once 'includes/conect.php';
$db = Database::getInstance();
$mysqli = $db->getConnection();
 
// product details

$id = isset($_GET['id']) ?  $_GET['id'] : die;
$cantidad  =  isset($_GET['cantidad']) ?  $_GET['cantidad'] : die;
$comentario = isset($_GET['comentario']) ?  $_GET['comentario'] : die;


//VALIDAR FECHAS
// delete query
$query = "UPDATE Detalle_pedido SET cantidad=? WHERE id_producto=? AND id_usuario=?";
 
// prepare query
$stmt = $mysqli->prepare($query);
 $stmt->bind_param("iii", $cantidad,$id, $id_usuario); 
 
// execute query
if($stmt->execute()){
    // redirect and tell the user product was removed
    header('Location: productos.php?action=quantity_updated&id=' . $id . '&name=' . $name);
}
 
// if remove failed
else{
    // redirect and tell the user it failed
    header('Location: productos.php?action=failed&id=' . $id . '&name=' . $name);
}
?>