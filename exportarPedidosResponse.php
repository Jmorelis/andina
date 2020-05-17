<?php

session_start();

if ($_SESSION['id_usuario'] == "") {
    header("Location: http://www.pedidosandina.com.ar/login.php");
    die();
}
$action = isset($_GET['action']) ? $_GET['action'] : "";
if ($action == 'exportadoOK') {

    $page_title = "Exportación de Pedidos";
    include 'head.php';

// parameters

    $name = isset($_GET['name']) ? $_GET['name'] : "";



    echo "<div class='alert alert-info'>";
    echo "Exportación OK";
    echo "</div>";
    header("Location: http://www.pedidosandina.com.ar/exportarPedidoOK.php?action=exportadoOK");
}
include 'footer.php';

?>

