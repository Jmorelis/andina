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
$page_title = "Lista de pedidos para exportar.";
include 'head.php';

// parameters
$action = isset($_GET['action']) ? $_GET['action'] : "";
$name = isset($_GET['name']) ? $_GET['name'] : "";

// select products in the cart
$query = "SELECT COUNT(DISTINCT(id_pedido)) cant FROM Pedidos
	WHERE exportado = 0";

$stmt = $mysqli->prepare($query);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($cant);
$stmt->fetch();
// count number of rows returned
//$num = $mysqli->affected_rows;
//echo "cantidad" . $cant;
if ($cant > 0) {

    //start table
    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<td>";
    echo "<div id='txtExp'>Hay {$cant} pedidos para ser exportados.</div>";
    echo "</td>";

    echo "<tr>";
    echo "<td >";
    echo "<button class='btn btn-success generarPedido' id='btnexp'>";
    echo "<span class='glyphicon glyphicon-shopping-cart'></span>Exportar Pedidos";
    echo "</button>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
} else {
    echo "<div class='alert alert-danger'>";
    echo "<strong>No hay pedidos para exportar</strong>";
    echo "</div>";
}



include 'footer.php';
?>

