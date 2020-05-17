<?php

session_start();
if ($_SESSION['id_usuario'] == "") {
    header("Location: http://www.pedidosandina.com.ar/login.php");
    die();
}


include_once 'functions/funciones.php';
$page_title = "Agregar Cliente.";
include 'head.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";
if ($action == 'added') {
    echo "<div class='alert alert-info'>";
    echo "Cliente agregado correctamente";
    echo "</div>";
} else if ($action == 'failed') {
    echo "<div class='alert alert-info'>";
    echo "No se pudo agregar el cliente";
    echo "</div>";
}

$funciones = new funciones();


echo "<table class='table table-hover table-responsive table-bordered'>";
echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Razon Social: <input type='text' id='nombreCliente' name='nombreCliente' value='' class='form-control' />";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Descripción: <input type='text' id='descripcionCli' name='descripcionCli' value='' class='form-control' />";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Código Anterior: <input type='text' id='cod' name='cod' value='' class='form-control' />";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<button class='btn btn-success agregarCliente'>";
echo "<span class='glyphicon glyphicon-shopping-cart'></span>Agregar Cliente";
echo "</button>";
echo "</td>";
echo "</tr>";

echo "</table>";



include 'footer.php';

