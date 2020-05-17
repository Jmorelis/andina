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
// page headers

if ($_SESSION['id_cliente'] > 0) {
    $page_title = "Orden de Pedido " . $_SESSION['cliente'];
} else {
    $page_title = "Orden de Pedido NO HAY CLIENTE!!";
}

include 'head.php';

// parameters
$action = isset($_GET['action']) ? $_GET['action'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";

//// display a message
if ($action == 'removed') {
    echo "<div class='alert alert-info'>";
    echo "<strong>{$name}</strong> fue eliminado del pedido!";
    echo "</div>";
} else if ($action == 'quantity_updated') {
    echo "<div class='alert alert-info'>";
    echo "<strong>{$name}</strong> la cantidad ha sido actualizada!";
    echo "</div>";
} else if ($action == 'failed') {
    echo "<div class='alert alert-info'>";
    echo "<strong>{$name}</strong> no se pudo actualizar la cantidad!";
    echo "</div>";
} else if ($action == 'invalid_value') {
    echo "<div class='alert alert-info'>";
    echo "<strong>{$name}</strong> cantidad es inválida!";
    echo "</div>";
} else if ($action == 'pedidoconfirmado') {
    echo "<div class='alert alert-info'>";
    echo "PEDIDO CONFIRMADO";
    echo "</div>";
//    die();
}

// select products in the cart
$query = "SELECT p.id_producto as id, p.nombre as name,ci.cantidad as quantity
            FROM Detalle_pedido ci  
                LEFT JOIN Productos p 
                    ON ci.id_producto = p.id_producto
                    WHERE ci.confirmado <> 1
                    AND ci.id_usuario = ?
                    AND ci.id_cliente = ?
                    AND ci.id_pedido = ?";

$stmt = $mysqli->prepare($query);
$stmt->bind_param("iii", $_SESSION['id_usuario'], $_SESSION['id_cliente'],$_SESSION['id_pedido']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $name, $quantity);
// count number of rows returned
$num = $mysqli->affected_rows;

if ($num > 0) {

    //start table
    echo "<table class='table table-hover table-responsive table-bordered'>";

    // our table heading
    echo "<tr>";
    echo "<th class='textAlignLeft'>Producto</th>";
    echo "<th style='width:5em;'>Cantidad</th>";
    echo "<th>Acciones</th>";
    echo "</tr>";



    while ($stmt->fetch()) {

        echo "<tr>";
        echo "<td style='border-top: 1px solid #dddddd'>";
        echo "<div class='product-id' style='display:none;'>{$id}</div>";
        echo "<div class='product-name'>{$name}</div>";
        echo "</td>";

        echo "<td style='border-top: 1px solid #dddddd'>";
        echo "<div class='input-group'>";
        echo "<input type='number' name='quantity' value='{$quantity}' class='form-control'>";


        echo "</div>";
        echo "</td>";
        echo "<td style='border-top: 1px solid #dddddd'>";
        echo "<a href='eliminar.php?id_producto={$id}&name={$name}'";
//        echo "<span class='btn btn-danger'>Borrar</span>";
        echo "<span class='input-group-btn'>";
        echo "<button class='btn btn-danger' type='button'>Quitar</button>";
            echo "</span>";
        echo "</a>";
        echo "<span class='input-group-btn'>";
        echo "<button class='button button-mini update-quantity' type='button'>Actualizar</button>";
        echo "</span>";
        echo "</td>";
        echo "</tr>";
    }

    echo "<tr>";
    echo "<td colspan='3' style='border-top: 1px solid #dddddd'>";
    echo "<button class='btn btn-success confirmarPedido'>";
    echo "<span class='glyphicon glyphicon-shopping-cart'>CONFIRMAR PEDIDO</span>";
    echo "</button>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
} else {
    if ($action <> 'pedidoconfirmado'){
        echo "<div class='alert alert-danger'>";
        echo "<strong>No se han encontrado productos</strong> en tu orden de pedido!";
        echo "</div>";
    }
}


include 'footer.php';
?>