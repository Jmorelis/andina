<?php

session_start();
if ($_SESSION['id_usuario'] == "") {
    header("Location: http://www.pedidosandina.com.ar/login.php");
    die();
}


include_once 'functions/funciones.php';
$page_title = "Lista de Usuarios.";
include 'head.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";

$idUsuario = $_GET['id_Usuario'];

$funciones = new funciones();
$usuario = $funciones->getUsuario($idUsuario);

echo "<table class='table table-hover table-responsive table-bordered'>";
//echo "<div class='usuario-id' id='usuario-id' value='{$idUsuario}' >{$idUsuario}</div>";//style='display:none;'
echo "<input type='text' id='usuario-id' name='usuario-id' value='{$idUsuario}' style='display:none;' class='form-control' />";
echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Nombre: <input type='text' id='nombreNew' name='nombreNew' value='{$usuario['nombre']}' class='form-control' />";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Password: <input type='password' id='password' name='password' value='{$usuario['password']}' class='form-control' />";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Email: <input type='text' id='email' name='email' value='{$usuario['email']}' class='form-control' />";
echo "</td>";
echo "</tr>";

if ($usuario['categoria']==3){
   echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Dist. - Cliente: <input type='number' id='cliDist' name='cliDist' value='{$usuario['distribuidor']}' class='form-control' />";
echo "</td>";
echo "</tr>"; 
} else {
     echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Dist. - Cliente: <input  style=display:none type='number' id='cliDist' name='cliDist' value='{$usuario['distribuidor']}' class='form-control' />";
echo "</td>";
echo "</tr>"; 
}
    


echo "<tr>";
echo "<td style='max-width: 100px'>";
echo "Tipo de usuario<select name='tipoUsuario' id='tipoUsuario' class = 'select-1 form-control select2-hidden-accessible' style = 'width:100%;' tabindex = '-1' aria-hidden = 'true'>";
if ($usuario['categoria'] == 1) {
    echo "<option value=1 selected>Vendedor</option>";
    echo "<option value=2>Administrador</option>";
    echo "<option value=3>Distribuidor</option>";
} else if ($usuario['categoria'] == 2) {
    echo "<option value=1>Vendedor</option>";
    echo "<option value=2 selected>Administrador</option>";
    echo "<option value=3>Distribuidor</option>";
} else if ($usuario['categoria'] == 3) {
    echo "<option value=1>Vendedor</option>";
    echo "<option value=2>Administrador</option>";
    echo "<option value=3 selected>Distribuidor</option>";
}
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "<button class='btn btn-success modificarUsuario'>";
echo "<span class='glyphicon glyphicon-shopping-cart'></span>Modificar Usuario";
echo "</button>";
echo "</td>";
echo "</tr>";

echo "</table>";

include 'footer.php';
