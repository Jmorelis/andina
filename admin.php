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
$page_title = "Panel Administrador";
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




//echo "<table class='table  table-hover table-responsive ' name=productosGrid>";
//// our table heading
//echo "<tr><td style='max-width: 200px';>";
//echo "<a href = '#'><span class = 'form-control active exportarPedidos'>Exportar Pedidos</span></a>";
//echo "</td>";
//echo "<td>";
//echo "<a href = '#'><span class = 'form-control active admUsuarios'>Admin. Usuarios</span></a>";
//echo "</td>";
//echo "</tr>";
//echo "<tr><td style='max-width: 200px';>";
//echo "<a href = '#'><span class = ' form-control active admProductos'>Admin. Productos</span></a>";
//echo "</td>";
//echo "<td>";
//echo "<a href = '#'><span class = 'form-control active admPedidos'>Admin. Pedidos</span></a>";
//echo "</td>";
//echo "</tr>";
//echo "</table>";
?>

<div class="content-wrap">
    <div class="container clearfix">

        <div class="col_one_third">
            <div class="feature-box fbox-center fbox-effect">
                <div class="fbox-icon">
                    <a href="/administradorPedidos.php"><i class="icon-stackexchange i-alt "></i></a>
                </div>
                <h3>Administrador de Pedidos</h3>
                <p>Modificar o Exportar los pedidos confirmados por los vendedores.</p>
            </div>
        </div>
        <div class="col_one_third">
            <div class="feature-box fbox-center fbox-effect">
                <div class="fbox-icon ">
                    <a href="/administradorUsuario.php"><i class="icon-group i-alt "></i></a>
                </div>
                <h3>Administrador de Usuarios</h3>
                <p>Agregar, quitar o modificar datos de usuarios.</p>
            </div>
        </div>
    </div>
</div>   
<div class="content-wrap">
    <div class="container clearfix">   

        <div class="col_one_third">
            <div class="feature-box fbox-center fbox-effect">
                <div class="fbox-icon ">
                    <a href="/administradorClientes.php"><i class="icon-vcard i-alt "></i></a>
                </div>
                <h3>Administrador de Clientes</h3>
                <p>Agregar, quitar o modificar datos de clientes.</p>
            </div>
        </div>
        <div class="col_one_third">
            <div class="feature-box fbox-center fbox-effect">
                <div class="fbox-icon ">
                    <a href="/administradorProductos.php"><i class="icon-cube i-alt "></i></a>
                </div>
                <h3>Administrador de Productos</h3>
                <p><p>Agregar, quitar o modificar datos de productos.</p></p>
            </div>
        </div>

    </div>
</div>
</table>
<?php
echo "<div>";
include 'footer.php';
?>