<?php

include_once 'functions/funciones.php';

$RegistrosAMostrar = 30;

//estos valores los recibo por GET
if (isset($_GET['pag'])) {
    $RegistrosAEmpezar = ($_GET['pag'] - 1) * $RegistrosAMostrar;
    $PagAct = $_GET['pag'];
    //caso contrario los iniciamos
} else {
    $RegistrosAEmpezar = 0;
    $PagAct = 1;
}

$funciones = new funciones();


if (isset($_GET['txt']) && ($_GET['txt'] <> '') && $_GET['cod'] == 'true') {
    $listaProductos = $funciones->buscarProductosXCod($_GET['txt']);
} else if (isset($_GET['txt']) && ($_GET['txt'] <> '')) {
    $listaProductos = $funciones->buscarProductosTxt($_GET['txt'], $RegistrosAEmpezar, $RegistrosAMostrar);
    $listaProductosAll = $funciones->getAllProductListTxt($_GET['txt']);
} else {
    
    $listaProductos = $funciones->getEstadosProductos($RegistrosAEmpezar, $RegistrosAMostrar);
    $listaProductosAll = $funciones->getAllProductList();
    
}


if (!isset($_GET['cod'])) {
//******--------determinar las páginas---------******//
    $NroRegistros = count($listaProductosAll);
    
//echo 'numero registro:' . $NroRegistros;
    $PagAnt = $PagAct - 1;
    $PagSig = $PagAct + 1;
    $PagUlt = $NroRegistros / $RegistrosAMostrar;

//verificamos residuo para ver si llevará decimales
    $Res = $NroRegistros % $RegistrosAMostrar;
// si hay residuo usamos funcion floor para que me
// devuelva la parte entera, SIN REDONDEAR, y le sumamos
// una unidad para obtener la ultima pagina
    echo "<div style='margin-right:50px; text-align: right;'>";
    
    if ($Res > 0)
        $PagUlt = floor($PagUlt) + 1;
//desplazamiento
    
    echo "<a onclick=\"Pagina('1','" . $_GET['txt'] . "')\">Primero</a> ";
    if ($PagAct > 1)
        echo "<a onclick=\"Pagina('$PagAnt','" . $_GET['txt'] . "')\">Anterior</a> ";
        echo "<strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong>";
    //    die('aca cambia2');
    
    if ($PagAct < $PagUlt)
        echo " <a onclick=\"Pagina('$PagSig','" . $_GET['txt'] . "')\">Siguiente</a> ";
        echo "<a onclick=\"Pagina('$PagUlt'," . $_GET['txt'] . ")\">Ultimo</a>";
        echo "</div>";

}

if (count($listaProductos) > '0') {

    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<th class='textAlignLeft'>Seleccione producto/s</th>";
    echo "<th style='width:5em;'>Estado</th>";
    echo "<th style='width:5em;'>Selección</th>";
    echo "</tr>";
    echo "<form id='form-check' method='post' action=''>";
    foreach ($listaProductos as $prodOrder) {

        echo "<tr>";
        echo "<td style='border-top: 1px solid #dddddd'>";
        echo "<div class='product-id' style='display:none;'>{$prodOrder['id']}</div>";
        echo "<div class='product-name'>" . $prodOrder['nombre'] . "</div>";
        echo "</td>";
        echo "<td style='border-top: 1px solid #dddddd'>";
        echo "<div class='product-name'>" . $prodOrder['estado'] . "</div>";
        echo "</td>";
        echo "<td style='border-top: 1px solid #dddddd'>";
        echo "<input type='checkbox' id='{$prodOrder['id']}' value='{$prodOrder['id']}'>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</form>";
    echo "</table>";
} else {
    echo "No hay productos encontrados.";
}

if (!isset($_GET['cod'])) {
//******--------determinar las páginas---------******//
    $NroRegistros = count($listaProductosAll);
    $PagAnt = $PagAct - 1;
    $PagSig = $PagAct + 1;
    $PagUlt = $NroRegistros / $RegistrosAMostrar;

//verificamos residuo para ver si llevará decimales
    $Res = $NroRegistros % $RegistrosAMostrar;
// si hay residuo usamos funcion floor para que me
// devuelva la parte entera, SIN REDONDEAR, y le sumamos
// una unidad para obtener la ultima pagina
    echo "<div style='margin-right:50px; text-align: right;'>";
    if ($Res > 0)
        $PagUlt = floor($PagUlt) + 1;
//desplazamiento
    echo "<a onclick=\"Pagina('1','" . $_GET['txt'] . "')\">Primero</a> ";
    if ($PagAct > 1)
        echo "<a onclick=\"Pagina('$PagAnt','" . $_GET['txt'] . "')\">Anterior</a> ";
    echo "<strong>Pagina " . $PagAct . "/" . $PagUlt . "</strong>";
    if ($PagAct < $PagUlt)
        echo " <a onclick=\"Pagina('$PagSig','" . $_GET['txt'] . "')\">Siguiente</a> ";
    echo "<a onclick=\"Pagina('$PagUlt'," . $_GET['txt'] . ")\">Ultimo</a>";
    echo "</div>";
}
?>