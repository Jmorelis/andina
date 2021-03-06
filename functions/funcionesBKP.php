<?php

session_start();

//echo '<pre>';
//print_r($_SESSION);
//echo '</pre>';
include_once 'includes/conect.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class funciones {

    private $db;
    private $mysqli;
    private $datosSesion;
    private $lista_productos;
    private $lista_clientes;
    private $productOrder;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->mysqli = $this->db->getConnection();

//        $this->datosSesion = $_SESSION;
    }

    private function getProducts() {
        $query = "SELECT p.id_producto as id, p.nombre as name
        FROM Productos p WHERE p.estado=1";
        if ($stmt = $this->mysqli->prepare($query)) {
//            $stmt->bind_param("ii", $_SESSION['id_usuario'], $_SESSION['id_cliente']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $name);

            while ($stmt->fetch()) {
                $listProd[] = array("cod" => $id, "nombre" => $name);
            }
        }
        return $listProd;
    }

    private function getProductosTxt($txt, $RegistrosAEmpezar, $RegistrosAMostrar) {
        $query = "SELECT id_producto as id, nombre, estado FROM Productos WHERE nombre LIKE '%" . $txt . "%' LIMIT ?,? ";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("ii", $RegistrosAEmpezar, $RegistrosAMostrar);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $nombre, $estado);

            while ($stmt->fetch()) {
                if ($estado == 1) {
                    $estadoS = "ACTIVO";
                } else {
                    $estadoS = "INACTIVO";
                }
                $ResultEstado[] = array("id_producto" => $id, "nombre" => $nombre, "estado" => $estadoS);
            }
        }
        return $ResultEstado;
    }
    
    private function getClienteTxt($txt) {
        $query = "SELECT id, nombre,descripcion, estado FROM Clientes WHERE nombre LIKE '%" . $txt . "%' ";

        if ($stmt = $this->mysqli->prepare($query)) {
            
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $nombre,$descripcion, $estado);

            while ($stmt->fetch()) {
                if ($estado == 1) {
                    $estadoS = "ACTIVO";
                } else {
                    $estadoS = "INACTIVO";
                }
                $ResultEstado[] = array("id" => $id, "nombre" => $nombre, "descripcion" => $descripcion,"estado" => $estadoS);
            }
        }
        return $ResultEstado;
    }

    private function getProductosXCod($cod) {
        $query = "SELECT id_producto as id, nombre, estado FROM Productos WHERE id_producto = ?";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("i", $cod);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $nombre, $estado);

            while ($stmt->fetch()) {
                if ($estado == 1) {
                    $estadoS = "ACTIVO";
                } else {
                    $estadoS = "INACTIVO";
                }
                $ResultEstado[] = array("id_producto" => $id, "nombre" => $nombre, "estado" => $estadoS);
            }
        }
        return $ResultEstado;
    }
    
    private function getClientesXCod($cod) {
        $query = "SELECT id, nombre,descripcion, estado FROM Clientes WHERE id = ?";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("i", $cod);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $nombre, $descripcion, $estado);

            while ($stmt->fetch()) {
                if ($estado == 1) {
                    $estadoS = "ACTIVO";
                } else {
                    $estadoS = "INACTIVO";
                }
                $ResultEstado[] = array("id" => $id, "nombre" => $nombre,"descripcion" => $descripcion, "estado" => $estadoS);
            }
        }
        return $ResultEstado;
    }

    private function getAllProducts() {
        $query = "SELECT id_producto as id, nombre as name
        FROM Productos";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $name);

            while ($stmt->fetch()) {
                $listProd[] = array("cod" => $id, "nombre" => $name);
            }
        }

        return $listProd;
    }

    private function getAllProductosTxt($txt) {
        $query = "SELECT id_producto as id, nombre, estado FROM Productos WHERE nombre LIKE '%" . $txt . "%'";

        if ($stmt = $this->mysqli->prepare($query)) {
//            $stmt->bind_param("ii", $RegistrosAEmpezar, $RegistrosAMostrar);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $nombre, $estado);

            while ($stmt->fetch()) {
                if ($estado == 1) {
                    $estadoS = "ACTIVO";
                } else {
                    $estadoS = "INACTIVO";
                }
                $ResultEstado[] = array("id_producto" => $id, "nombre" => $nombre, "estado" => $estadoS);
            }
        }
        return $ResultEstado;
    }

    private function getClientes() {

        $query = "SELECT id_cliente id, nombre FROM Clientes where estado = 1";


        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $name);

            while ($stmt->fetch()) {
                $listcli[] = array("id" => $id, "nombre" => $name);
            }
        }
        return $listcli;
    }
    
    private function getAllClientes() {

        $query = "SELECT id_cliente id, nombre,descripcion, estado FROM Clientes ";


        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $nombre, $descripcion, $estado);

            while ($stmt->fetch()) {
                if ($estado == 1) {
                    $estadoS = "ACTIVO";
                } else {
                    $estadoS = "INACTIVO";
                }

               $ResultClientes[] = array("id" => $id, "nombre" => $nombre, "estado" => $estadoS,"descripcion"=> $descripcion);
            }
        }
        return $ResultClientes;
    }

    private function getCliente($id) {

        $query = "SELECT id_cliente id, nombre FROM Clientes where estado = 1 and id_cliente = ?";


        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $name);

            while ($stmt->fetch()) {
                $listcli = array("id" => $id, "nombre" => $name);
            }
        }
        return $listcli;
    }

    private function getProductsOrder() {


        $query = "SELECT p.id_producto as id, p.nombre as name,ci.cantidad as cantidad
            FROM Detalle_pedido ci  
                LEFT JOIN Productos p 
                    ON ci.id_producto = p.id_producto
                    WHERE ci.confirmado <> 1
                    AND ci.id_usuario = ?
                    AND ci.id_cliente = ?
                    AND ci.id_pedido = ?";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("iii", $_SESSION['id_usuario'], $_SESSION['id_cliente'], $_SESSION['id_pedido']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $name, $cantidad);

            while ($stmt->fetch()) {
                $productOrder[] = array("id_producto" => $id, "nombre" => $name, "cantidad" => $cantidad);
            }
        }

        return $productOrder;
    }

    private function agregarUsuario($nombre, $categoria, $password) {

        $query = "INSERT INTO Usuarios (nombre,categoria,password) VALUE (?,?,?)";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("sis", $nombre, $categoria, $password);
            if ($stmt->execute()) {
                return '1';
            } else {
                return '0';
            }
        }
    }

    private function getEstadoProd($id) {

        $query = "SELECT estado FROM Productos WHERE id_producto = ?";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($estado);

            while ($stmt->fetch()) {
                $estadoActual = array("id_producto" => $id, "estado" => $estado);
            }
        }
        return $estadoActual;
    }

    private function getEstadoAllProd($RegistrosAEmpezar, $RegistrosAMostrar) {

        $query = "SELECT id_producto as id, nombre, estado FROM Productos LIMIT ?,? ";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("ii", $RegistrosAEmpezar, $RegistrosAMostrar);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $nombre, $estado);

            while ($stmt->fetch()) {
                if ($estado == 1) {
                    $estadoS = "ACTIVO";
                } else {
                    $estadoS = "INACTIVO";
                }
                $ResultEstado[] = array("id_producto" => $id, "nombre" => $nombre, "estado" => $estadoS);
            }
        }
        return $ResultEstado;
    }

    private function getUsuarios() {

        $query = "SELECT id, nombre, categoria, estado FROM Usuarios";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $nombre, $categoria, $estado);

            while ($stmt->fetch()) {
                if ($estado == 1) {
                    $estadoS = "ACTIVO";
                } else {
                    $estadoS = "INACTIVO";
                }

                if ($categoria == 1) {
                    $nombreCat = "Vendedor";
                } else {
                    $nombreCat = "Administrador";
                }

                $ResultUsuarios[] = array("id" => $id, "nombre" => $nombre, "estado" => $estadoS, "categoria" => $nombreCat);
            }
        }
        return $ResultUsuarios;
    }

    private function getUsuariosID($id) {

        $query = "SELECT id, nombre, categoria,password FROM Usuarios WHERE id = ?";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $nombre, $categoria, $password);

            if ($stmt->fetch()) {
                $ResultUsuarios = array("id" => $id, "nombre" => $nombre, "categoria" => $categoria, "password" => $password);
            }
        }
        return $ResultUsuarios;
    }
    
    private function getClienteID($id) {

        $query = "SELECT id_cliente id, nombre,descripcion FROM Clientes WHERE id = ?";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id, $nombre, $descripcion);

            if ($stmt->fetch()) {
                $ResultClientes = array("id" => $id, "nombre" => $nombre, "descripcion" => $descripcion);
            }
        }
        return $ResultClientes;
    }

    private function agregarCliente($nombre, $desc, $cod) {

        $query = "INSERT INTO Clientes (id_cliente,nombre,descripcion) VALUE (?,?,?)";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("iss", $cod, $nombre, $desc);
            if ($stmt->execute()) {
                return '1';
            } else {
                return '0';
            }
        }
    }
    private function agregarProducto($nombre, $desc, $cod) {

        $query = "INSERT INTO Productos (id_producto,nombre,descripcion) VALUE (?,?,?)";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("iss", $cod, $nombre, $desc);
            if ($stmt->execute()) {
                return '1';
            } else {
                return '0';
            }
        }
    }

    private function changeEstadoProducto($id) {

        $query = "UPDATE Productos SET estado = (SELECT if (estado = '1','0','1') as estado)
WHERE id_producto IN (" . $id . ")";

        if ($stmt = $this->mysqli->prepare($query)) {
//            $stmt->bind_param("s", $id);
            if ($stmt->execute()) {
                $estadoActual = array("respuesta" => '1');
            } else {
                $estadoActual = array("respuesta" => '0');
            }
        }
        return $estadoActual;
    }
    
    private function changeEstadoUsuario($id) {

        $query = "UPDATE Usuarios SET estado = (SELECT if (estado = '1','0','1') as estado)
WHERE id IN (" . $id . ")";

        if ($stmt = $this->mysqli->prepare($query)) {
            if ($stmt->execute()) {
                $estadoActual = array("respuesta" => '1');
            } else {
                $estadoActual = array("respuesta" => '0');
            }
        }
        return $estadoActual;
    }
    
    private function changeEstadoCliente($id) {

        $query = "UPDATE Clientes SET estado = (SELECT if (estado = '1','0','1') as estado)
WHERE id IN (" . $id . ")";

        if ($stmt = $this->mysqli->prepare($query)) {
            if ($stmt->execute()) {
                $estadoActual = array("respuesta" => '1');
            } else {
                $estadoActual = array("respuesta" => '0');
            }
        }
        return $estadoActual;
    }

    private function modificoUsuarioDatos($id, $nombre, $categoria, $password) {

        $query = "UPDATE Usuarios SET nombre = ?, categoria = ?, password = ? WHERE id = ?";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("sisi", $nombre, $categoria, $password,$id);
            if ($stmt->execute()) {
                $resultado = array("respuesta" => '1');
            } else {
                $resultado = array("respuesta" => '0');
            }
        }
        return $resultado;
    }
    
    private function modificoClienteDatos($id, $nombre, $desc) {

        $query = "UPDATE Clientes SET nombre = ?, descripcion = ? WHERE id = ?";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("ssi", $nombre, $desc,$id);
            if ($stmt->execute()) {
                $resultado = array("respuesta" => '1');
            } else {
                $resultado = array("respuesta" => '0');
            }
        }
        return $resultado;
    }

    private function changeClientePedido($id) {

        $query = "UPDATE Detalle_pedido SET id_cliente = ? WHERE id_pedido = ? and id_usuario = ?";

        if ($stmt = $this->mysqli->prepare($query)) {
            $stmt->bind_param("iii", $id, $_SESSION['id_pedido'], $_SESSION['id_usuario']);
            $stmt->execute();
        }
    }

    public function nuevoUsuario($nombre, $categoria, $password) {
        $nuevoU = $this->agregarUsuario($nombre, $categoria, $password);
        return $nuevoU;
    }

    public function nuevoCliente($nombre, $desc, $cod) {
        $nuevoC = $this->agregarCliente($nombre, $desc, $cod);
        return $nuevoC;
    }
    public function nuevoProducto($nombre, $desc, $cod) {
        $nuevoC = $this->agregarProducto($nombre, $desc, $cod);
        return $nuevoC;
    }

    public function getProductList() {
        $this->lista_productos = $this->getProducts();
        return $this->lista_productos;
    }

    public function getAllProductList() {
        $this->lista_productosAll = $this->getAllProducts();
        return $this->lista_productosAll;
    }

    public function getProductOrder() {
        $this->productOrder = $this->getProductsOrder();
        return $this->productOrder;
    }

    public function getClientList() {
        $this->lista_clientes = $this->getClientes();
        return $this->lista_clientes;
    }
    
    public function getAllClientList() {
        $this->lista_clientes = $this->getAllClientes();
        return $this->lista_clientes;
    }

    public function getOrderToExport() {
        $this->lista_clientes = $this->getOrderExport();
        return $this->lista_clientes;
    }

    public function getEstadoProducto($id) {
        $this->estadoProd = $this->getEstadoProd($id);
        return $this->estadoProd;
    }

    public function getEstadosProductos($RegistrosAEmpezar, $RegistrosAMostrar) {
        $arrayEstados = $this->getEstadoAllProd($RegistrosAEmpezar, $RegistrosAMostrar);
        return $arrayEstados;
    }

    public function cambiarEstadoProducto($id) {

        //recorrer ids y obtener estado actual para cambiar
        $resp = $this->changeEstadoProducto($id);
//        $this->estadoProd = $this->getEstadoProd($id);
        return $resp;
    }

    public function cambiarClientePedido($id) {
        $this->changeClientePedido($id);
        $clienteNuevo = $this->getCliente($id);
        return $clienteNuevo;
    }

    public function buscarProductosTxt($txt, $RegistrosAEmpezar, $RegistrosAMostrar) {
        $productos = $this->getProductosTxt($txt, $RegistrosAEmpezar, $RegistrosAMostrar);
        return $productos;
    }
    public function buscarClienteTxt($txt) {
        $cliente = $this->getClienteTxt($txt);
        return $cliente;
    }

    public function getAllProductListTxt($txt) {
        $this->lista_productosAll = $this->getAllProductosTxt($txt);
        return $this->lista_productosAll;
    }

    public function buscarProductosXCod($cod) {
        $productos = $this->getProductosXCod($cod);
        return $productos;
    }
    public function buscarClientesXCod($cod) {
        $productos = $this->getClientesXCod($cod);
        return $productos;
    }

    public function getAllUsuario() {
        $usuarios = $this->getUsuarios();
        return $usuarios;
    }

    public function getUsuario($id) {
        $usuariosID = $this->getUsuariosID($id);
        return $usuariosID;
    }

    public function modificoUsuario($id, $nombre, $categoria, $password) {
        $usuariosID = $this->modificoUsuarioDatos($id, $nombre, $categoria, $password);
        return $usuariosID;
    }
    
    public function modificoCliente($id, $nombre, $desc) {
        $clienteID = $this->modificoClienteDatos($id, $nombre, $desc);
        return $clienteID;
    }

    public function cambiarEstadoUsuario($id) {
        $resp = $this->changeEstadoUsuario($id);
        return $resp;
    }
    
    public function cambiarEstadoCliente($id) {
        $resp = $this->changeEstadoCliente($id);
        return $resp;
    }
    public function getClienteXID($id) {
        $clienteID = $this->getClienteID($id);
        return $clienteID;
    }
}
