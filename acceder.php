<?php

//Conectamos a la base de datos
require_once 'includes/conect.php';

$db = Database::getInstance();
$mysqli = $db->getConnection();
$mysqli2 = $db->getConnection();

//Obtenemos los datos del formulario de acceso
$userPOST = $_POST["usuario"];
$passPOST = $_POST["password"];



$maxCaracteresUsername = "20";
$maxCaracteresPassword = "60";

//Si los input son de mayor tamaño, se "muere" el resto del código y muestra la respuesta correspondiente
if (strlen($userPOST) > $maxCaracteresUsername) {
    die('El nombre de usuario no puede superar los ' . $maxCaracteresUsername . ' caracteres');
};

if (strlen($passPOST) > $maxCaracteresPassword) {
    die('La contraseña no puede superar los ' . $maxCaracteresPassword . ' caracteres');
};

//Pasamos el input del usuario a minúsculas para compararlo después con
//el campo "usernamelowercase" de la base de datos
$userPOSTMinusculas = strtolower($userPOST);



$query = "SELECT id,nombre,password,categoria,distribuidor FROM `Usuarios` WHERE nombre='" . $userPOSTMinusculas . "' and estado=1";

if ($stmt = $mysqli->prepare($query)) {
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $nombre, $password, $categoria, $distribuidor);
    $stmt->fetch();
//    echo "affected: " . $mysqli->affected_rows;
    if ($mysqli->affected_rows == '1') {
        $userBD = $nombre;
        $passwordBD = $password;
        $id_usuario = $id;
        $id_categoria = $categoria;
        $dist = $distribuidor;
        $datos = array(
            'userBD' => $nombre,
            'id_usuario' => $id,
            'id_categoria' => $categoria,
            'id_distribuidor' => $distribuidor);
    } else {
        die("NO ENCONTRO USUARIO");
    }

//            $this->log(var_export($encuestas, 1));
}


if ($userBD == $userPOSTMinusculas) {

    if ($passPOST == $passwordBD) {
        session_start();
        $_SESSION['usuario'] = $userBD;
        $_SESSION['id_usuario'] = $id;
        $_SESSION['estado'] = 'Autenticado';
        $_SESSION['id_categoria'] = $id_categoria;
        $_SESSION['id_distribuidor'] = $dist;
    
        echo json_encode($datos, JSON_FORCE_OBJECT);
        } else if ($userBD != $userPOSTMinusculas || $userPOST == "" || $passPOST == "" || !password_verify($passPOST, $passwordBD)) {
            die('<script>$(".acceso").val("");</script>
        Los datos de acceso son incorrectos');
        } else {
            die('Error');
        }
    }
?>