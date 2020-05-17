<?php

session_start();
if ($_SESSION['id_usuario'] == "") {
    header("Location: http://www.pedidosandina.com.ar/login.php");
    die();
}


include_once 'functions/funciones.php';
$page_title = "Nueva lista de descuento.";
include 'head.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";
if ($action == 'added') {
    echo "<div class='alert alert-info'>";
    echo "Descuento agregado correctamente";
    echo "</div>";
} else if ($action == 'failed') {
    echo "<div class='alert alert-info'>";
    echo "No se pudo agregar el Descuento";
    echo "</div>";
}

$funciones = new funciones();


echo "<table class='table table-hover table-responsive table-bordered'>";
echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Nombre de la lista: <input type='text' id='nombreDescuento' name='nombreDescuento' value='' class='form-control' />";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Descripción: <input type='text' id='descripcionDesc' name='descripcionDesc' value='' class='form-control' />";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "<button class='btn btn-success agregarDescuento'>";
echo "<span class='glyphicon glyphicon-shopping-cart'></span>Agregar Descuento";
echo "</button>";
echo "</td>";
echo "</tr>";

echo "</table>";



include 'footer.php';

