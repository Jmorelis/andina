<!-- navbar -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    
    <div class="container">
        <?php if ($_SESSION['id_categoria'] == '1'){ ?>  
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="productos.php">Pedidos Andina</a>
        </div>
          
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php echo $page_title=="Products" ? "class='active'" : ""; ?> >
                    <a href="productos.php">Productos</a>
                </li>
<!--                <li <?php echo $page_title=="preorden" ? "class='active'" : ""; ?> >
                    <a href="preorden.php">Pedido</a>
                </li>-->
<!--                <li>
                    <a href="#"><span class='active cerrarCliente'>Cambiar Cliente</span></a>
                </li>-->
                <li>
                    <a href="#"><span class='active cerrarUsuario'>Cerrar Usuario</span></a>
                </li>
<!--                <li > <span class="badge" id="comparison-count"><?php echo "Hola " . $_SESSION['usuario']; ?></span>-->
                </li>
            </ul>
        </div><!--/.nav-collapse -->
        <?php }else if ($_SESSION['id_categoria'] == '2'){ ?> 
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
        <a class="navbar-brand" href="admin.php">Pedidos Andina</a>    
        </div>
          
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#"><span class='active exportarPedidos'>Exportar Pedidos</span></a>
                </li>
<!--                <li>
                    <a href="#"><span class='active admPedidos'>Admin. Pedidos</span></a>
                </li>-->
                 <li>
                     <a href="/administradorUsuario.php"><span class='active admUsuarios'>Admin. Usuarios</span></a>
                </li>
                <li>
                    <a href="/administradorProductos.php"><span class='active admProductos'>Admin. Productos</span></a>
                </li>
                <li>
                    <a href="/administradorClientes.php"><span class='active admPedidos'>Admin. Clientes</span></a>
                </li>
                <li>
                    <a href="#"><span class='active cerrarUsuario'>Cerrar Usuario</span></a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
        <?php } ?>
    </div>
</div>
<!-- /navbar -->