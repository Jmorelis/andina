<?php
session_start();
//echo "sesion del usuario:" . $_SESSION['usuario'] . " ID: " . $_SESSION['id_usuario'];

include_once 'includes/conect.php';
include_once 'includes/envia_mail.php';

$db = Database::getInstance();
$mysqli = $db->getConnection();

$usuario = $_SESSION['usuario'];
$id_usuario = $_SESSION['id_usuario'];
$id_cliente = $_SESSION['id_cliente'];

$id_Ultimo_Pedido = "";
$id_Ultimo_Pedido = $_SESSION['id_pedido'];
if ($id_Ultimo_Pedido == '0' || $id_Ultimo_Pedido == ""){
    $mesaje = "usuario:" . $id_usuario . " cliente:" . $id_cliente . " fecha:" . date(); 
    mail("jmorelis@hotmail.com", "problema andina id pedido", $id_usuario);
    header('Location: productos.php?action=ErrorIdPedido');
    die('error id confirmar pedido');
}
$comentario = $_GET['obs'];
$query = "INSERT INTO Pedidos (id_pedido,id_usuario,id_cliente,fechaAlta,comentario) VALUES (?,?,?,NOW(),?)";

$stmt = $mysqli->prepare($query);
$stmt->bind_param("iiis", $id_Ultimo_Pedido, $id_usuario, $id_cliente, $comentario);
$stmt->execute();


//Actualizo los datos del detalle de pedido
$queryUpdate = "UPDATE Detalle_pedido SET confirmado = 1
WHERE id_usuario = ?
	AND id_cliente = ?
	AND confirmado <> 1";

$stmt = $mysqli->prepare($queryUpdate);
$stmt->bind_param("ii", $id_usuario, $id_cliente);
//$stmt->execute();

if ($stmt->execute()) {
    $_SESSION['id_pedido'] = '';
    //ENVIO MAIL AL USUARIO CON EL PEDIDO
    $envioMail = new enviamail();
    $envioMail->envio($id_usuario, $id_Ultimo_Pedido);
    header('Location: productos.php?action=pedidoconfirmado');
} else {
    // redirect and tell the user it failed
    header('Location: preorden.php?action=pedidoDetallefailed');
}

