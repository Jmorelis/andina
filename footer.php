</div>

<!-- Footer
        ============================================= -->
<footer id="footer" class="dark">
    <div class="container">
        <i class="icon-envelope2"></i> ventas@pinturasandina.com <span class="middot">&middot;</span> <i class="icon-headphones"></i> 4716-1111 (int 114) <span class="middot">&middot;</span> <i class="icon-wei-plain icon-globe"></i><a href="http://www.pinturasandina.com"> www.pinturasandina.com </a> </div><!-- #copyrights end -->
</footer><!-- #footer end -->

<!-- /container -->

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- bootstrap JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="js/holder.js"></script>
<script src="js/components/select-boxes.js"></script>
<script src="js/components/selectsplitter.js"></script>
<!--<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/components/bs-switches.js"></script>
<script type="text/javascript" src="js/functions.js"></script>-->
<!--<script>
    jQuery(".bt-switch").bootstrapSwitch();
</script>-->
<script>
    $(document).ready(function () {
        $('.add-to-cart').click(function () {
            var id = document.getElementById("productos").value;
            var quantity = document.getElementById("cant").value;
            window.location.href = "agregar.php?id=" + id + "&cantidad=" + quantity + "&comentario=";
        });
        $('.aceptarCliente').click(function () {
            var id = document.getElementById("clientes").value;
            var cmblista = document.getElementById("lista");
            var lista = cmblista.options[cmblista.selectedIndex].text;
//            document.getElementById("obs").value = lista;
            var combo = document.getElementById("clientes");
            var name = combo.options[combo.selectedIndex].text;
            window.location.href = "productos.php?action=nuevoCliente&nc=" + id + "&name=" + name + "&lista=" + lista;
        });
        $('.update-quantity').click(function () {
            var id = $(this).closest('tr').find('.product-id').text();
//            var id = $(this).getElementById("product-id-pre").value;
            var quantity = $(this).closest('tr').find('input').val();
            console.log(id + '--' + quantity);
            window.location.href = "actualizar.php?id=" + id + "&cantidad=" + quantity + "&comentario=NO";
        });
        $('.confirmarPedido').click(function () {
            var comentario = document.getElementById("obs").value;
            window.location.href = "confirmarPedido.php?obs=" + comentario;
        });
        $('.cerrarCliente').click(function () {
            window.location.href = "productos.php?action=cerrarCliente";
        });
        $('.cerrarUsuario').click(function () {
            window.location.href = "login.php?action=cerrarUsuario";
        });
        $('.exportarPedidos').click(function () {
            window.location.href = "exportarPedidos.php";
        });
        $('.generarPedido').click(function () {
            document.getElementById("btnexp").disabled;
            document.getElementById("txtExp").value = "No hay más pedidos para exportar";
            window.location.href = "generarPedido.php";
        });
        $('.agregarUsuario').click(function () {

            var combo = document.getElementById("tipoUsuario");
            var cat = combo.options[combo.selectedIndex].value;
            var nombre = document.getElementById("nombreNew").value;
            var password = document.getElementById("password").value;
            var clienteDist = document.getElementById("clienteDist").value;
            var parametros = {
                "nombre": nombre,
                "type": cat,
                "pasw": password,
                "CliDist": clienteDist
            };
//            console.log('pasw:' + password);
            $.ajax({
                data: parametros,
                url: "administrador.php?action=nuevoUsuario",
                type: "post"

            }).done(function (respuesta) {
                console.log(respuesta);
                if (respuesta === "1") {
                    window.location.replace("http://www.pedidosandina.com.ar/agregarUsuario.php?action=added");
                } else {
                    window.location.replace("http://www.pedidosandina.com.ar/agregarUsuario.php?action=failed");
                }
            });
        });
        $('.agregarCliente').click(function () {

            var desc = document.getElementById("descripcionCli").value;
            var nombre = document.getElementById("nombreCliente").value;
            var cod = document.getElementById("cod").value;
            var parametros = {
                "nombre": nombre,
                "desc": desc,
                "cod": cod
            };
//            console.log('pasw:' + password);
            $.ajax({
                data: parametros,
                url: "administrador.php?action=nuevoCliente",
                type: "post"

            }).done(function (respuesta) {
//                console.log(respuesta);
                if (respuesta === "1") {
                    window.location.replace("http://www.pedidosandina.com.ar/agregarCliente.php?action=added");
                } else {
                    window.location.replace("http://www.pedidosandina.com.ar/agregarCliente.php?action=failed");
                }
            });
        });
        
        $('.agregarDescuento').click(function () {

            var desc = document.getElementById("descripcionDesc").value;
            var nombre = document.getElementById("nombreDescuento").value;
            
            var parametros = {
                "nombre": nombre,
                "desc": desc
                
            };
//            console.log('pasw:' + password);
            $.ajax({
                data: parametros,
                url: "administrador.php?action=nuevoDescuento",
                type: "post"

            }).done(function (respuesta) {
//                console.log(respuesta);
                if (respuesta === "1") {
                    window.location.replace("http://www.pedidosandina.com.ar/agregarDescuento.php?action=added");
                } else {
                    window.location.replace("http://www.pedidosandina.com.ar/agregarDescuento.php?action=failed");
                }
            });
        });
        
        // Multiple Select
        $(".select-1").select2({
            placeholder: "Select Multiple Values"
        });
        // Loading array data
        var data = [{id: 0, text: 'enhancement'}, {id: 1, text: 'bug'}, {id: 2, text: 'duplicate'}, {id: 3, text: 'invalid'}, {id: 4, text: 'wontfix'}];
        $(".select-data-array").select2({
            data: data
        })
        $(".select-data-array-selected").select2({
            data: data
        });
        // Enabled/Disabled
        $(".select-disabled").select2();
        $(".select-enable").on("click", function () {
            $(".select-disabled").prop("disabled", false);
            $(".select-disabled-multi").prop("disabled", false);
        });
        $(".select-disable").on("click", function () {
            $(".select-disabled").prop("disabled", true);
            $(".select-disabled-multi").prop("disabled", true);
        });
        // Without Search
        $(".select-hide").select2({
            minimumResultsForSearch: Infinity
        });
        // select Tags
        $(".select-tags").select2({
            tags: true
        });
        // Select Splitter
        $('.selectsplitter').selectsplitter();
        $('.modificarProducto').change(function () {
            var id = document.getElementById("modificarProducto").value;
//            console.log("id: " + id);
            var parametros = {
                "id": id
            };
//            console.log('pasw:' + password);

            $.ajax({
                data: parametros,
                url: "administrador.php?action=modProd",
                type: "post",
                dataType: "json",
            }).done(function (respuesta) {

                console.log(respuesta['id']);
                if (respuesta['estado'] == 1) {
                    $("#resultado").html('Estado actual del producto: ACTIVO');
                } else {
                    $("#resultado").html('Estado actual del producto: INACTIVO');
                }
                document.getElementById("estadoActual").value = respuesta['estado'];
                $('#btnCambiarEstado').attr("disabled", false);
            });
        });
        $('.cambiarEstado').click(function () {

            console.log('cambiarestado');
            var ids = '';
            $("input:checkbox:checked").each(function () {
                if (ids === '') {
                    ids = $(this).val();
                } else {
                    ids = ids + ',' + $(this).val();
                }

            });
            console.log(ids);
//            var id = document.getElementById("modificarProducto").value;
//            var estadoActual = document.getElementById("estadoActual").value;
//            console.log("estadoActual: " + estadoActual);
            var parametros = {
                "id": ids
            };
////            console.log('pasw:' + password);
//
            $.ajax({
                data: parametros,
                url: "administrador.php?action=cambiarEstado",
                type: "post",
                dataType: "json",
            }).done(function (respuesta) {

                console.log(respuesta['respuesta']);
                window.location.href = "modificarProductos.php";
//                if (respuesta['estado'] == 1) {
//                    $("#resultado").html('Estado actual del producto: ACTIVO');
//                } else {
//                    $("#resultado").html('Estado actual del producto: INACTIVO');
//                }
//                document.getElementById("estadoActual").value = respuesta['estado'];
//                $('#btnCambiarEstado').attr("disabled", false);
            });
        });
        $('.buscar-prod').click(function () {

            console.log('buscarproducto');
            var textoProd = document.getElementById("buscarProducto").value;
            var parametros = {
                "txt-buscar": textoProd
            };
            console.log('texto:' + parametros['txt-buscar']);
            if (document.getElementById("buscar-codigo").checked) {
                window.location.href = "modificarProductos.php?txt=" + parametros['txt-buscar'] + "&cod=true";
            } else {
                window.location.href = "modificarProductos.php?txt=" + parametros['txt-buscar'];
            }
        });
        
        $('.buscar-cliente').click(function () {

            console.log('buscarcliente');
            var textoProd = document.getElementById("buscarCliente").value;
            var parametros = {
                "txt-buscar": textoProd
            };
            console.log('texto:' + parametros['txt-buscar']);
            if (document.getElementById("buscar-codigo-cliente").checked) {
                window.location.href = "listaClientes.php?txt=" + parametros['txt-buscar'] + "&cod=true";
            } else {
                window.location.href = "listaClientes.php?txt=" + parametros['txt-buscar'];
            }
        });
        
        $('.cambiarCliente').click(function () {
            var id = document.getElementById("clienteNuevo").value;
            var cmblistaNew = document.getElementById("listaNew");
            var lista = cmblistaNew.options[cmblistaNew.selectedIndex].text;
            var parametros = {
                "id": id,
                "lista": lista

            };
            console.log('id nuevo:' + id);
            $.ajax({
                data: parametros,
                url: "administrador.php?action=cambiarCliente",
                type: "post",
                dataType: "json",
            }).done(function (respuesta) {
                console.log(respuesta);
                window.location.href = "productos.php?action=nuevoCliente&nc=" + respuesta['id'] + "&name=" + respuesta['nombre'];
            });
        });
        $('.modUsuario').click(function () {
            var id = $(this).closest('tr').find('.usuario-id').text();
            window.location.href = "modificarUsuario.php?id_Usuario=" + id;
        });
        
        $('.modificarUsuario').click(function () {
            var id = document.getElementById("usuario-id").value;
            var combo = document.getElementById("tipoUsuario");
            var cat = combo.options[combo.selectedIndex].value;
            var nombre = document.getElementById("nombreNew").value;
            var password = document.getElementById("password").value;
            var email = document.getElementById("email").value;
            var distribuidor = document.getElementById("cliDist").value;
            var parametros = {
                "id": id,
                "nombre": nombre,
                "type": cat,
                "pasw": password,
                "email": email,
                "cliDist": distribuidor
            };
            
            console.log(parametros['id'] + '-' +  parametros['nombre'] +'-' + parametros['type']+'-' + parametros['pasw']+ '-' + parametros['cliDist']);
            $.ajax({
                data: parametros,
                url: "administrador.php?action=modificoUsuario",
                type: "post"

            }).done(function (respuesta) {
                console.log(respuesta);
                window.location.replace("http://www.pedidosandina.com.ar/listaUsuarios.php");
            });
        });
        
        $('.cambiarEstadoUsuario').click(function () {
            var id = $(this).closest('tr').find('.usuario-id').text();
            
            var parametros = {
                "id": id
            };
            console.log(parametros['id'] + '-' +  parametros['nombre'] +'-' + parametros['type']+'-' + parametros['pasw']);
            $.ajax({
                data: parametros,
                url: "administrador.php?action=cambiarEstadoUsuario",
                type: "post"

            }).done(function (respuesta) {
                console.log(respuesta);
                window.location.replace("http://www.pedidosandina.com.ar/listaUsuarios.php");
            });
        });
        $('.modCliente').click(function () {
            var id = $(this).closest('tr').find('.usuario-id').text();
            window.location.href = "modificarCliente.php?id_Cliente=" + id;
        });
        $('.modDescuento').click(function () {
            var id = $(this).closest('tr').find('.usuario-id').text();
            window.location.href = "modificarDescuento.php?id_descuento=" + id;
        });
        $('.modificarCliente').click(function () {
            var id = document.getElementById("usuario-id").value;
            var nombre = document.getElementById("nombreNew").value;
            var desc = document.getElementById("desc").value;
            var parametros = {
                "id": id,
                "nombre": nombre,
                "desc": desc
            };
            console.log(parametros['id'] + '-' +  parametros['nombre'] +'-' + parametros['type']+'-' + parametros['pasw']);
            $.ajax({
                data: parametros,
                url: "administrador.php?action=modificoCliente",
                type: "post"

            }).done(function (respuesta) {
                console.log(respuesta);
                window.location.replace("http://www.pedidosandina.com.ar/listaClientes.php");
            });
        });
        $('.modificarDescuento').click(function () {
            var id = document.getElementById("usuario-id").value;
            var nombre = document.getElementById("nombreNew").value;
            var desc = document.getElementById("desc").value;
            var parametros = {
                "id": id,
                "nombre": nombre,
                "desc": desc
            };
            console.log(parametros['id'] + '-' +  parametros['nombre'] +'-' + parametros['type']+'-' + parametros['pasw']);
            $.ajax({
                data: parametros,
                url: "administrador.php?action=modificoDescuento",
                type: "post"

            }).done(function (respuesta) {
                console.log(respuesta);
                window.location.replace("http://www.pedidosandina.com.ar/listaDescuentos.php");
            });
        });
        $('.cambiarEstadoCliente').click(function () {
            var id = $(this).closest('tr').find('.usuario-id').text();
            
            var parametros = {
                "id": id
            };
            console.log(parametros['id'] + '-' +  parametros['nombre'] +'-' + parametros['type']+'-' + parametros['pasw']);
            $.ajax({
                data: parametros,
                url: "administrador.php?action=cambiarEstadoCliente",
                type: "post"

            }).done(function (respuesta) {
                console.log(respuesta);
                window.location.replace("http://www.pedidosandina.com.ar/listaClientes.php");
            });
        });
        
        $('.cambiarEstadoDescuento').click(function () {
            var id = $(this).closest('tr').find('.usuario-id').text();
            
            var parametros = {
                "id": id
            };
            console.log(parametros['id'] + '-' +  parametros['nombre'] +'-' + parametros['type']+'-' + parametros['pasw']);
            $.ajax({
                data: parametros,
                url: "administrador.php?action=cambiarEstadoDescuento",
                type: "post"

            }).done(function (respuesta) {
                console.log(respuesta);
                window.location.replace("http://www.pedidosandina.com.ar/listaDescuentos.php");
            });
        });
        
        
        $('.agregarProducto').click(function () {

            var desc = document.getElementById("desc").value;
            var nombre = document.getElementById("nombreNew").value;
            var cod = document.getElementById("cod").value;
            var parametros = {
                "nombre": nombre,
                "desc": desc,
                "cod": cod
            };
//            console.log('pasw:' + password);
            $.ajax({
                data: parametros,
                url: "administrador.php?action=nuevoProducto",
                type: "post"

            }).done(function (respuesta) {
//                console.log(respuesta);
                if (respuesta === "1") {
                    window.location.replace("http://www.pedidosandina.com.ar/agregarProducto.php?action=added");
                } else {
                    window.location.replace("http://www.pedidosandina.com.ar/agregarProducto.php?action=failed");
                }
            });
        });

    });
</script>

</body>
</html>