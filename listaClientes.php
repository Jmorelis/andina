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

$funciones = new funciones();

if (isset($_GET['txt']) && ($_GET['txt'] <> '') && $_GET['cod'] == 'true') {
    $listaClientes = $funciones->buscarClientesXCod($_GET['txt']);
} else if (isset($_GET['txt']) && ($_GET['txt'] <> '')) {
    $listaClientes = $funciones->buscarClienteTxt($_GET['txt']);
} else {
   $listaClientes = $funciones->getAllClientList();
   
}

?>
<input class="form-control-search " type="buscarCliente"  id="buscarCliente" placeholder="Buscar Cliente" aria-label="Buscar">
<input type='checkbox' id='buscar-codigo-cliente' value='buscarCodigoCliente'>
<label >Buscar por Código.</label>
</br>
<button class="btn btn-outline-success my-2 my-sm-0 buscar-cliente" id="buscar-cliente" type="">Buscar</button>
</br>
</br>
<?php

echo "<table class='table table-hover table-responsive table-bordered'>";
echo "<tr>";
echo "<th class='textAlignLeft'>Razon Social</th>";
echo "<th style='width:30em;'>Descripcion</th>";
echo "<th style='width:5em;'>Estado</th>";
echo "<th style='width:5em;'>Acciones</th>";
echo "</tr>";

foreach ($listaClientes as $usuario) {
    echo "<tr>";
    echo "<td style='border-top: 1px solid #dddddd'>";
    echo "<div class='usuario-id' style='display:none;'>{$usuario['id']}</div>";
    echo "<div class='usuario-name'>" . $usuario['nombre'] . "</div>";
    echo "</td>";
    echo "<td style='border-top: 1px solid #dddddd'>";
    echo "<div class='usuario-name'>" . $usuario['descripcion'] . "</div>";
    echo "</td>";
    echo "<td style='border-top: 1px solid #dddddd'>";
    echo "<div class='usuario-estado'>" . $usuario['estado'] . "</div>";
    echo "</td>";
    echo "<td style='border-top: 1px solid #dddddd'>";
    echo "<span class='input-group-btn'>";
    echo "<button class='button button-mini modCliente' type='button'>Modificar Datos</button>";
    echo "<button class='btn btn-danger cambiarEstadoCliente' type='button'>Cambiar Estado</button></a>";
    echo "</span>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

include 'footer.php';
