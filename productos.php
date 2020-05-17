<?php
session_start();
if ($_SESSION['id_usuario'] == "") {
    header("Location: http://www.pedidosandina.com.ar/login.php");
    die();
}
if ($_SESSION['id_categoria'] == "2") {
    header("Location: http://www.pedidosandina.com.ar/admin.php");
    die();
}

include_once 'functions/funciones.php';


//echo  "sesion: ";
//var_dump($_SESSION);
// page headers
$page_title = "Lista de productos para el usuario " . $_SESSION['usuario'];
include 'head.php';

// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : "1";
$name = isset($_GET['name']) ? $_GET['name'] : "";
$cantidad = isset($_GET['cantidad']) ? $_GET['cantidad'] : "0";

//echo "cantidad:" . $cantidad;
// show message
if ($action == 'added') {
//    echo "<div class='alert alert-info'>";
//    echo "<strong>{$name}</strong> ¡agregado a tu pedido!";
//    echo "</div>";
} else if ($action == 'failed') {
    echo "<div class='alert alert-info'>";
    echo "<strong>{$name}</strong> No se pudo agregar a su pedido!";
    echo "</div>";
} else if ($action == 'nuevoCliente') {
    $_SESSION['cliente'] = $_GET['name'];
    $_SESSION['id_cliente'] = $_GET['nc'];

    if ($_SESSION['lista'] == '') {
        $_SESSION['lista'] = $_GET['lista'];
    }
} else if ($action == 'cerrarCliente') {
    $_SESSION['cliente'] = "";
    $_SESSION['id_cliente'] = "";
} else if ($action == 'pedidoconfirmado') {
    echo "<div class='alert alert-info'>";
    echo "PEDIDO CONFIRMADO";
    echo "</div>";
    $_SESSION['cliente'] = "";
    $_SESSION['id_cliente'] = "";
    $_SESSION['lista'] = "";
} else if ($action == "ErrorIdPedido") {
    echo "<div class='alert alert-info'>";
    echo "SE PERDIO LA CONEXION";
    echo "</div>";
    $_SESSION['cliente'] = "";
    $_SESSION['id_cliente'] = "";
    $_SESSION['lista'] = "";
} else if ($action == "maximoProductos") {
    echo "<div class='alert alert-info'>";
    echo "LIMITE DE PRODUCTOS - CONFIRMAR PEDIDO";
    echo "</div>";
}

$funciones = new funciones();
$listaProductos = $funciones->getProductlist();
$listaClientes = $funciones->getClientList();
$product_order = $funciones->getProductOrder();
$lista_desc = $funciones->getAllListaDescAct();


//SI ES DISTRIBUIDOR VOY A BUSCAR LOS DATOS DEL DISTRIBUIDOR
//echo $_SESSION['id_distribuidor'];
if (($_SESSION['id_distribuidor'] > 0) && ($_SESSION['id_categoria'] ==3)){
    $cliente = $funciones->getCliDist($_SESSION['id_distribuidor']);
    $_SESSION['id_cliente'] = $cliente['id'];
    $_SESSION['cliente'] = $cliente['nombre'];
}

//LISTA DE CLIENTES
if ($_SESSION['id_cliente'] == "") {
    //CONSULTA PARA LOS CLIENTES
    if (count($listaClientes) > '0') {
        //        echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<table class='table table-hover table-responsive table-bordered' name=productosGrid>";
        // our table heading
        echo "<tr><td style='max-width: 150px';>";
        echo "Cliente: <select name='clientes' id='clientes' class = 'select-1 form-control select2-hidden-accessible' style = 'width:100%;' tabindex = '-1' aria-hidden = 'true'>";
        echo "<option value=0>Seleccione un cliente</option>";
        foreach ($listaClientes as $cliente) {
            echo "<option value=" . $cliente['id'] . ">" . $cliente['id'] . " - " . $cliente['nombre'] . "</option>";
        }
        echo "</select>";
        echo "</td>";
        echo "<td style='width: 150px;'>";
        echo "Lista: <select name=lista id=lista  class='form-control'>";
        //        echo "<option value=1>Lista Tarima 218</option>";
        //        echo "<option value=2>Lista 218 -50%</option>";
        //        echo "<option value=3>Lista Tarima 418</option>";
        //        echo "<option value=4>Lista 218 -50% -5%</option>";
        //        echo "<option value=5>Lista 218 -50% -10%</option>";
        foreach ($lista_desc as $ld) {
            echo "<option value=" . $ld['id'] . ">" . $ld['id'] . " - " . $ld['nombre'] . "</option>";
        }
        echo "</select>";
        echo "</td>";
        echo "<td>";
        echo "<button class='btn btn-primary aceptarCliente'  style='margin-top:20px'>";
        echo "<span class='glyphicon glyphicon-shopping-cart'></span> Agregar";
        echo "</button>";
        echo "</td>";
        echo "</tr>";
    } else {
        die("NO ENCONTRO CLIENTE");
    }

    //            $this->log(var_export($encuestas, 1));
} else {
    echo "<table class='table table-hover table-responsive table-bordered alert alert-info''>";
    //    echo "<div >";
    echo "<tr><td style='max-width: 180px' >";
    echo "CLIENTE:<strong>" . $_SESSION['cliente'] . '  ' . "</strong> ";
    echo "</td >";
    echo "<td style='max-width: 150px' >";
    if ($_SESSION['id_distribuidor'] == 0) {

        echo "<button class='btn btn-primary-modal' data-toggle='modal' data-target='.bs-example-modal-sm'>";

        echo "<span class='glyphicon glyphicon-shopping-cart'></span> Cambiar";
        echo "</button>";
    }
    echo "</td>";
    echo "</tr>";
    //    echo "</div>";
    echo "</table>";
}

//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";
//LISTA DE PRODUCTOS
if (count($listaProductos) > 0) {
//start table
    echo "<table class='table table-hover table-responsive table-bordered' name=productosGrid>";
    echo "<tr><td style='max-width: 150px';>";
    echo "<div class = 'bottommargin-sm'>";
    echo "Producto: <select name='productos' id='productos' class = 'select-1 form-control select2-hidden-accessible' style = 'width:100%;' tabindex = '-1' aria-hidden = 'true'>";
    foreach ($listaProductos as $producto) {
        echo "<option value=" . $producto['cod'] . ">" . $producto['codigo_fabrica'] . " - " . $producto['nombre'] . "</option>";
    }
    echo "</select>";
    echo "</div>";
    echo "</td>";
    echo "<td style='width: 150px;'>";
    echo "Cantidad: <input type='number' id='cant' name='quantity' value='' class='form-control' />";
    echo "</td>";
    echo "<td >";
    echo "<button class='btn btn-primary add-to-cart' style='margin-top:20px'>";
    echo "<span class='glyphicon glyphicon-shopping-cart'></span> Agregar";
    echo "</button>";
    echo "</td>";
    echo "</tr>";

    if (count($product_order) > '0') {
        echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
        echo "<th class='textAlignLeft'>Producto</th>";
        echo "<th style='width:5em;'>Cantidad</th>";
        echo "</tr>";
        foreach ($product_order as $prodOrder) {
            echo "<tr>";
            echo "<td style='border-top: 1px solid #dddddd'>";
            echo "<div class='product-id' style='display:none;'>{$prodOrder['id']}</div>";
            echo "<div class='product-name'>" . $prodOrder['nombre'] . "</div>";
            echo "</td>";

            echo "<td style='border-top: 1px solid #dddddd'>";
            echo "<div >";
            echo "<input type='number' id='cantN' name='quantity' value='" . $prodOrder['cantidad'] . "' class='form-control'>";
            echo "</div>";
            echo "</td>";
            echo "<td style='border-top: 1px solid #dddddd'>";
            echo "<span class='input-group-btn'>";
            echo "<button class='button button-mini update-quantity' type='button'>Cambiar</button>";
            echo "<a href='eliminar.php?id={$prodOrder['id']}&name={$prodOrder['nombre']}'";
            echo "<button class='btn btn-danger' type='button'>Quitar</button></a>";
            echo "</span>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

//texto de observaciones
    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<td  style='border-top: 1px solid #dddddd'>";
    echo "<div class='col_full'>";
    echo "<label for='template-contactform-message'>Observaciones: <small></small></label>";
    echo "<textarea class='required sm-form-control' id='obs' name='template-contactform-message' rows='6' cols='30' aria-required='true'>" . $_SESSION['lista'] . "</textarea>";
    echo "</div>";
    echo "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>";
    echo "<button class='btn btn-success confirmarPedido'>";
    echo "<span class='glyphicon glyphicon-shopping-cart'></span>CONFIRMAR PEDIDO";
    echo "</button>";
    echo "</td>";
    echo "</tr>";

    echo "</table>";
} else {
    echo "No hay productos encontrados.";
}
include 'footer.php';
?>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" 
     aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Seleccionar Nuevo Cliente</h4>
                </div>
                <div class="modal-body">
<?php
echo "<tr><td>";
echo "Cliente: <select name='clienteNuevo' id='clienteNuevo' class = 'select-1 form-control select2-hidden-accessible' style = 'width:100%;' tabindex = '-1' aria-hidden = 'true'>";
echo "<option value=0>Seleccione un cliente</option>";
foreach ($listaClientes as $cliente) {
    echo "<option value=" . $cliente['id'] . ">" . $cliente['id'] . " - " . $cliente['nombre'] . "</option>";
}
echo "</select>";
echo "</tr></td>";
echo "<tr><td>";
echo "Lista: <select name=listaNew id=listaNew  class='form-control'>";
//                    echo "<option value=1> selected>Lista Tarima 218</option>";
//                    echo "<option value=2>Lista 218 -50%</option>";
//                    echo "<option value=3>Lista Tarima 418</option>";
//                    echo "<option value=4>Lista 218 -50% -5%</option>";
//                    echo "<option value=5>Lista 218 -50% -10%</option>";
foreach ($lista_desc as $ld) {
    echo "<option value=" . $ld['id'] . ">" . $ld['id'] . " - " . $ld['nombre'] . "</option>";
}
echo "</select>";
echo "</tr></td>";
echo "<tr><td>";
echo "<button class='btn btn-success cambiarCliente'>";
echo "<span class='glyphicon glyphicon-shopping-cart'></span>Cambiar Cliente";
echo "</button>";
echo "</tr></td>";
?>
                </div>
            </div>
        </div>
    </div>
</div>
