<?php
session_start();
//echo "sesion del usuario:" . $_SESSION['usuario'];

$action = isset($_GET['action']) ? $_GET['action'] : "";
if ($action == 'cerrarUsuario') {
    $_SESSION['usuario'] = "";
    $_SESSION['id_usuario'] = "";
    $_SESSION['cliente'] = "";
    $_SESSION['id_cliente'] = "";
    $_SESSION['id_pedido'] = "";

}
?>

<html dir="ltr" lang="en-US">
    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="author" content="SemiColonWeb" />

        <!-- Stylesheets
        ============================================= -->
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="style.css" type="text/css" />
        <link rel="stylesheet" href="css/dark.css" type="text/css" />
        <link rel="stylesheet" href="css/font-icons.css" type="text/css" />
        <link rel="stylesheet" href="css/animate.css" type="text/css" />
        <link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

        <link rel="stylesheet" href="css/responsive.css" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Document Title
        ============================================= -->
        <title>Login</title>

    </head>

    <body class="stretched">

        <div id="header-wrap">

            <div class="container clearfix">

                <!-- Logo
 ============================================= -->
                <div id="logo" class="hidden-lg hidden-md">
                    <a href="index.php" class="standard-logo" data-dark-logo="imagenes/pinturasandina.png"><img src="imagenes/pinturasandina.png" alt="Pinturerias Andino"></a>
                    <a href="index.php" class="retina-logo" data-dark-logo="imagenes/pinturasandina.png"><img src="imagenes/pinturasandina.png" alt="Pinturerias Andino"></a>

                </div><!-- #logo end -->


            </div>

        </div>

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div class="tabs divcenter nobottommargin clearfix" id="tab-login-register" style="max-width: 500px;">

                        <ul class="tab-nav tab-nav2 center clearfix">
                            <li class="inline-block"><a href="#tab-login">Login</a></li>
                            <!--<li class="inline-block"><a href="#tab-register">Register</a></li>-->
                        </ul>

                        <div class="tab-container">
                            <div id="mensaje" style="border:1px solid #CCC; padding:10px;"></div>
                            <div class="tab-content clearfix" id="tab-login">
                                <div class="panel panel-default nobottommargin">
                                    <div class="panel-body" style="padding: 40px;">
                                        <form id="acceso" name="login-form" class="nobottommargin" action="#" method="post">

                                            <h3>Ingrese sus datos</h3>

                                            <div class="col_full">
                                                <label for="login-form-username">Usuario:</label>
                                                <input type="text" id="usuario" name="usuario" value="" class="form-control" />
                                            </div>

                                            <div class="col_full">
                                                <label for="login-form-password">Contraseña:</label>
                                                <input type="password" id="password" name="password" value="" class="form-control" />
                                            </div>
                                            <div class="col_full nobottommargin">
                                                <button class="button button-3d button-black nomargin" id="login-form-submit" name="login-form-submit" value="login">Ingresar</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                        </div>

                    </div>

                </div>

            </div>

        </section><!-- #content end -->

        <!-- Footer
        ============================================= -->
        <footer id="footer" class="dark">
            <div class="container">
                <i class="icon-envelope2"></i> pedidosandina.com.ar <span class="middot">&middot;</span> <i class="icon-headphones"></i> +91-11-6541-6369 <span class="middot">&middot;</span> <i class="icon-skype2"></i> VendedoresWeb
            </div><!-- #copyrights end -->
        </footer><!-- #footer end -->

    </div><!-- #wrapper end -->

    <!-- Go To Top
    ============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>

    <!-- External JavaScripts
    ============================================= -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>

    <!-- Footer Scripts
    ============================================= -->
    <script type="text/javascript" src="js/functions.js"></script>
    <script >

        //Guardamos el controlador del div con ID mensaje en una variable
        var mensaje = $("#mensaje");
//Ocultamos el contenedor
        mensaje.hide();

        //Cuando el formulario con ID acceso se envíe...
        $("#acceso").on("submit", function (e) {
            //Evitamos que se envíe por defecto
            e.preventDefault();
            //Creamos un FormData con los datos del mismo formulario
            var formData = new FormData(document.getElementById("acceso"));
            //Llamamos a la función AJAX de jQuery
            $.ajax({
                //Definimos la URL del archivo al cual vamos a enviar los datos
                url: "acceder.php",
                //Definimos el tipo de método de envío
                type: "POST",
                //Definimos el tipo de datos que vamos a enviar y recibir
                dataType: "HTML",
                //Definimos la información que vamos a enviar
                data: formData,
                //Deshabilitamos el caché
                cache: false,
                //No especificamos el contentType
                contentType: false,
                //No permitimos que los datos pasen como un objeto
                processData: false
            }).done(function (respuesta) {
                console.log(respuesta);
                if (respuesta.id_categoria === "2") {
                    window.location.replace("http://www.pedidosandina.com.ar/admin.php");
                } else {
                    window.location.replace("http://www.pedidosandina.com.ar/productos.php");
                }
            });

        }
        );
    </script>
</body>
</html>
