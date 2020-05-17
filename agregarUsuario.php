<?php

session_start();
if ($_SESSION['id_usuario'] == "") {
    header("Location: http://www.pedidosandina.com.ar/login.php");
    die();
}


include_once 'functions/funciones.php';
$page_title = "Agregar Usuario.";
include 'head.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";



if ($action == 'added') {
    echo "<div class='alert alert-info'>";
    echo "Usuario Agregado Correctamente!";
    echo "</div>";
} else if ($action == 'failed') {
    echo "<div class='alert alert-info'>";
    echo "No se pudo agregar el usuario, intente nuevamente.";
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
echo "Password: <input type='password' id='password' name='password' value='' class='form-control' />";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Tipo de usuario<select name='tipoUsuario' id='tipoUsuario' class = 'select-1 form-control select2-hidden-accessible' style = 'width:100%;' tabindex = '-1' aria-hidden = 'true'>";
echo "<option value=1>Vendedor</option>";
echo "<option value=2>Administrador</option>";
echo "<option value=3>Distribuidor</option>";
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "*Ingrese un ID de CLIENTE solo para Distribuidores: <input type='number' id='clienteDist' name='clienteDist' value='' class='form-control' />";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "<button class='btn btn-success agregarUsuario'>";
echo "<span class='glyphicon glyphicon-shopping-cart'></span>Agregar Usuario";
echo "</button>";
echo "</td>";
echo "</tr>";

echo "</table>";



include 'footer.php';
