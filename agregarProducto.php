<?php

session_start();
if ($_SESSION['id_usuario'] == "") {
    header("Location: http://www.pedidosandina.com.ar/login.php");
    die();
}


include_once 'functions/funciones.php';
$page_title = "Agregar Producto.";
include 'head.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";



if ($action == 'added') {
    echo "<div class='alert alert-info'>";
    echo "Producto Agregado Correctamente!";
    echo "</div>";
} else if ($action == 'failed') {
    echo "<div class='alert alert-info'>";
    echo "No se pudo agregar el producto, intente nuevamente.";
    echo "</div>";
}

echo "<table class='table table-hover table-responsive table-bordered'>";
echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Nombre: <input type='text' id='nombreNew' name='nombreNew' value='' class='form-control' />";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Descripcion: <input type='desc' id='desc' name='desc' value='' class='form-control' />";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Código Fabrica: <input type='text' id='cod' name='cod' value='' class='form-control' />";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "<button class='btn btn-success agregarProducto'>";
echo "<span class='glyphicon glyphicon-shopping-cart'></span>Agregar Producto";
echo "</button>";
echo "</td>";
echo "</tr>";

echo "</table>";



include 'footer.php';
