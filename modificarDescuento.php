<?php

session_start();
if ($_SESSION['id_usuario'] == "") {
    header("Location: http://www.pedidosandina.com.ar/login.php");
    die();
}


include_once 'functions/funciones.php';
$page_title = "Lista de Clientes.";
include 'head.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";

$idDescuento = $_GET['id_descuento'];

$funciones = new funciones();
$cliente = $funciones->getDescuentoXID($idDescuento);


echo "<table class='table table-hover table-responsive table-bordered'>";
//echo "<div class='usuario-id' id='usuario-id' value='{$idUsuario}' >{$idUsuario}</div>";//style='display:none;'
echo "<input type='text' id='usuario-id' name='usuario-id' value='{$idDescuento}' style='display:none;' class='form-control' />";
echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Razon Social: <input type='text' id='nombreNew' name='nombreNew' value='{$cliente['nombre']}' class='form-control' />";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Descripci&oacute;n: <input type='text' id='desc' name='desc' value='{$cliente['descripcion']}' class='form-control' />";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<button class='btn btn-success modificarDescuento'>";
echo "<span class='glyphicon glyphicon-shopping-cart'></span>Modificar Descuento";
echo "</button>";
echo "</td>";
echo "</tr>";

echo "</table>";

include 'footer.php';

