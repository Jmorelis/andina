<?php

session_start();

if ($_SESSION['id_usuario'] == "") {
    header("Location: http://www.pedidosandina.com.ar/login.php");
    die();
}
// connect to database
include_once 'includes/conect.php';

$db = Database::getInstance();
$mysqli = $db->getConnection();
$mysqli2 = $db->getConnection();

// page headers
// select products in the cart

$query = "SELECT dt.id_usuario, dt.id_producto, pd.id_producto as codigoFabrica ,dt.id_cliente ,dt.id_pedido, p.comentario,dt.cantidad,dt.fechaAlta fecha, u.nombre nombre
	FROM Pedidos p
	INNER JOIN Detalle_pedido dt ON p.id_pedido = dt.id_pedido
        INNER JOIN Productos pd ON pd.id = dt.id_producto
        INNER JOIN Usuarios u ON u.id = dt.id_usuario
	WHERE p.exportado <> 1
	ORDER BY dt.id_pedido ASC";
     

$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id_usuario, $id_producto, $codigoFabrica, $id_cliente, $id_pedido, $comentario, $cantidad, $fechaAlta, $nombre);

$id_pedidoAux = "";
$fecha = date('d') . '/' . date('m') . '/' . date('Y');

$archivoD = "/var/www/html/pedidosWeb/pedidos.dat";
$ultimoComentario = "";
$archivo = fopen($archivoD, 'a');
$separador = 0;
while ($stmt->fetch()) {
    if ($id_pedidoAux == "") {
        $id_pedidoAux = $id_pedido;
        $fechaAltaF = date("d/m/Y", strtotime($fechaAlta));
        $contenido .= $id_pedido . "@" . $id_cliente . "@" . trim($nombre) . "@" . $fechaAltaF . "@" . $codigoFabrica . "@" . $cantidad;
        $separador = 5;
//        echo "1-";
    } else if ($id_pedidoAux == $id_pedido) {
        $contenido .= "@" . $codigoFabrica . "@" . $cantidad;
        $separador = $separador + 2;
        $ultimoComentario = $comentario;
//        echo "2-";
    } else {
        $arroba = 40 - $separador;
        for ($i = 0; $i < $arroba; ++$i) {
            $contenido .= "@";
        }
        $contenido .= $ultimoComentario . chr(13);
        $contenido .= $id_pedido . "@" . $id_cliente . "@" . trim($nombre) . "@" . $fechaAltaF . "@" . $codigoFabrica . "@" . $cantidad;
        $separador = 5;
        $id_pedidoAux = $id_pedido;
//        echo "3-";
    }
}
$arroba = 40 - $separador;
for ($i = 0; $i < $arroba; ++$i) {
    $contenido .= "@";
}
$contenido .= $comentario . chr(13);
//$contenido .= "@@@@@@@@@@@@@@@@@" . $comentario;
fputs($archivo, $contenido);
fclose($archivo);

// page headers
// select products in the cart
$query2 = "UPDATE Pedidos SET exportado = 1
	WHERE exportado <> 1
	ORDER BY id_pedido DESC";

$stmt2 = $mysqli2->prepare($query2);
$stmt2->execute();



header("Location: http://www.pedidosandina.com.ar/exportarPedidosResponse.php?action=exportadoOK");
//die();
?>
