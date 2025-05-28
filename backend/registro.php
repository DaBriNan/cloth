<?php

if(isset($_POST["submit"])) {
    $usr = $_POST["email"];
    $pwd = $_POST["contra"];
    $name = $_POST["nombre"];
    $edo = $_POST["estado"];
    $ciu = $_POST["ciudad"];
    $dir = $_POST["direccion"];
    $cod = $_POST["cp"];
    
    require_once 'conexion.php';
    require_once 'funciones.php';
    
    // Validar campos vacíos
    $array = array($usr, $pwd);
    if(isEmptyInput($array) == true) {
        header("location: ../../cloth/pages/logIn2.php");
        exit();
    }

    // Buscar existencia de usuario
    $uidExists = uidExists($conexion, $usr);
    if($uidExists) {
        header("location: ../../cloth/pages/logIn2.php");
        exit();
    }

    $uId = crearUsuario($conexion, $usr, $pwd, $name, $edo, $ciu, $dir, $cod);

    // Iniciar sesión
    if($uId>0){
        $uidExists = uidExists($conexion, $usr);
        session_start();
        $_SESSION["Id"] = $uidExists["usu_id"];
        $_SESSION["Nom"] = $uidExists["nombre"];
        $_SESSION["Dir"] = $uidExists["direccion"];
        $_SESSION["Ciu"] = $uidExists["ciudad"];
        $_SESSION["Edo"] = $uidExists["estado"];
        $_SESSION["Cp"] = $uidExists["cp"];
    }
    
    header("location: ../../Clotheasy-copia/pages/produPrueba.php");
    exit();
}