<?php

session_start();
if ($_SESSION['id_usuario'] == "") {
    header("Location: http://www.pedidosandina.com.ar/login.php");
    die();
}
include_once 'functions/funciones.php';
$page_title = "Modificar Estado de Productos";

include 'head.php';
echo "<script type= 'text/javascript' src='functions/ajax.js'></script>";
?>
<!--<form class="form-inline nomargin">-->
<input class="form-control-search " type="buscarProducto"  id="buscarProducto" placeholder="Buscar Producto" aria-label="Buscar">
<input type='checkbox' id='buscar-codigo' value='buscarCodigo'>
<label >Buscar por Código.</label>
</br>
<button class="btn btn-outline-success my-2 my-sm-0 buscar-prod" id="buscar-prod" type="">Buscar</button>

<!--</form>-->
<div id="contenido">
    <?php include('paginador.php') ?>
</div>
<div style="text-align: left;">
    <button class="btn btn-outline-success my-2 my-sm-0 cambiarEstado" id="cambiarEstado" >Cambiar Estados</button>
</div>
<?php
include 'footer.php';
