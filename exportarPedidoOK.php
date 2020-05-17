<?php

session_start();

if ($_SESSION['id_usuario'] == "") {
    header("Location: http://www.pedidosandina.com.ar/login.php");
    die();
}
$action = isset($_GET['action']) ? $_GET['action'] : "";
if ($action == 'exportadoOK') {
  
// parameters

    $name = isset($_GET['name']) ? $_GET['name'] : "";
    $fecha = date("Ymd");     
    $basefichero = basename("pedidos.dat");
//    echo $basefichero;
//    chmod("pedidos/pedidosWeb" . $fecha . ".dat", 0777);
//    $nombre_usuario = "root";
//    chown("pedidos/pedidosWeb" . $fecha . ".dat", $nombre_usuario);
//    chgrp("pedidos/pedidosWeb" . $fecha . ".dat", $nombre_usuario);
    
    header("Content-Type: application/octet-stream");

    header("Content-Length: " . filesize($basefichero));

    header("Content-Disposition:attachment;filename=" . $basefichero . "");
    
    readfile($basefichero);
    $bkpPedido = "pedidos.dat" . $fecha;
    copy ("pedidos.dat",$bkpPedido);
    
    $archivo = fopen("pedidos.dat","w");
    fclose($archivo);
}

