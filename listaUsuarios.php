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

$funciones = new funciones();
$listaUsuarios = $funciones->getAllUsuario();

echo "<table class='table table-hover table-responsive table-bordered'>";
echo "<tr>";
echo "<th class='textAlignLeft'>Nombre</th>";
echo "<th style='width:5em;'>Categoria</th>";
echo "<th style='width:5em;'>Estado</th>";
echo "<th style='width:5em;'>Acciones</th>";
echo "</tr>";

foreach ($listaUsuarios as $usuario) {
    echo "<tr>";
    echo "<td style='border-top: 1px solid #dddddd'>";
    echo "<div class='usuario-id' style='display:none;'>{$usuario['id']}</div>";
    echo "<div class='usuario-name'>" . $usuario['nombre'] . "</div>";
    echo "</td>";
    echo "<td style='border-top: 1px solid #dddddd'>";
    echo "<div class='usuario-cat'>" . $usuario['categoria'] . "</div>";
    echo "</td>";
    echo "<td style='border-top: 1px solid #dddddd'>";
    echo "<div class='usuario-estado'>" . $usuario['estado'] . "</div>";
    echo "</td>";
    echo "<td style='border-top: 1px solid #dddddd'>";
    echo "<span class='input-group-btn'>";
    echo "<button class='button button-mini modUsuario' type='button'>Modificar Datos</button>";
    echo "<button class='btn btn-danger cambiarEstadoUsuario' type='button'>Cambiar Estado</button></a>";
    echo "</span>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

include 'footer.php';
