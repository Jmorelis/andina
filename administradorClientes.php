<?php
session_start();

if ($_SESSION['id_usuario'] == "") {
    header("Location: http://www.pedidosandina.com.ar/login.php");
    die();
} else if ($_SESSION['id_categoria'] == 1) {
    header("Location: http://www.pedidosandina.com.ar/productos.php");
    die();
}
//echo "sesion del usuario:" . $_SESSION['usuario'];
// connect to database

include_once 'includes/conect.php';
$db = Database::getInstance();
$mysqli = $db->getConnection();
// page headers
$page_title = "Administrador de Clientes";
include 'head.php';


// show message
if ($action == 'added') {
    echo "<div class='alert alert-info'>";
    echo "<strong>{$name}</strong> ¡agregado a tu pedido!";
    echo "</div>";
} else if ($action == 'failed') {
    echo "<div class='alert alert-info'>";
    echo "<strong>{$name}</strong> No se pudo agregar a su pedido!";
    echo "</div>";
} else if ($action == 'nuevoCliente') {
    $_SESSION['cliente'] = $_GET['name'];
    $_SESSION['id_cliente'] = $_GET['nc'];
} else if ($action == 'cerrarCliente') {
    $_SESSION['cliente'] = "";
    $_SESSION['id_cliente'] = "";
} else if ($action == 'cerrarUsuario') {
    $_SESSION['usuario'] = "";
    $_SESSION['id_usuario'] = "";
    $_SESSION['cliente'] = "";
    $_SESSION['id_cliente'] = "";
    $_SESSION['id_pedido'] = "";
    header("Location: http://www.pedidosandina.com.ar/login.php");
    die();
}

?>
<div class="content-wrap">
    <div class="container clearfix">
<!--<table class='table  table-hover table-responsive ' name=productosGrid>-->
        <div class="col_one_third">
            <div class="feature-box fbox-center fbox-effect">
                <div class="fbox-icon ">
                    <a href="agregarCliente.php"><i class="icon-file-add i-alt "></i></a>
                </div>
                <h3>Agregar Cliente</h3>
                <p>Agregar nuevo Cliente a la base de datos.</p>
            </div>
        </div>
        <div class="col_one_third">
            <div class="feature-box fbox-center fbox-effect">
                <div class="fbox-icon ">
                    <a href="listaClientes.php"><i class="icon-tasks i-alt "></i></a>
                </div>
                <h3>Modificar o Quitar Cliente</h3>
                <p>Modifica o Elimina clientes de la base de datos.</p>
            </div>
        </div>
        <div class="col_one_third">
            <div class="feature-box fbox-center fbox-effect">
                <div class="fbox-icon ">
                    <a href="agregarDescuento.php"><i class="icon-tasks i-alt "></i></a>
                </div>
                <h3>Agregar Lista de Descuentos</h3>
                <p>Agrega una nueva lista de descuentos.</p>
            </div>
        </div>
        <div class="col_one_third">
            <div class="feature-box fbox-center fbox-effect">
                <div class="fbox-icon ">
                    <a href="listaDescuentos.php"><i class="icon-tasks i-alt "></i></a>
                </div>
                <h3>Modificar Lista de Descuentos</h3>
                <p>Modifica la lista utilizada para descuentos.</p>
            </div>
        </div>
        <!--</table>-->
    </div>
</div>

<?php
echo "<div>";
include 'footer.php';
?>

