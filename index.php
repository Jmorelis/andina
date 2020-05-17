<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

if ($_SESSION['id_usuario'] == "") {
    include_once 'login.php';
    die();
}
if ($_SESSION['id_categoria'] == "2") {
    include_once 'admin.php';
    die();
}
if ($_SESSION['id_categoria'] == "1") {
    include_once 'productos.php';
    die();
}
