<?php
// if(isset($_POST["submit"])){

//     $usr = $_POST["usuario"];
//     $pwd = $_POST["contra"];

//     require_once '.conexion.php';
//     require_once 'funciones.php';

//     $array = array($usr, $pwd);
//     if(isEmptyInput($array)===false){
//         echo "entró";
//         header("location: ../../src/login/login.html?error=emptyinput");
//         exit();
//     }

//     $uidExists = uidExists($conexion, $usr);

//     if($uidExists === false){
//         header("location: ../../src/login/login.html?error=wronglogin");
//          exit();
//     }

//     $pwdHasehed = $uidExists["contra"];
//     $checkPwd = password_verify($pwd, $pwdHasehed);

//     if($checkPwd === false){
//         header("location: ../../src/login/login.html?error=wronglogin");exit();
//     }

//     session_start();
//     $_SESSION["Id"] =  $uidExists["usu_id"];
//     $_SESSION["Nom"] =  $uidExists["nombre"];
    
//     header("location: ../../src/home/main.php");
//     exit();

// }
if(isset($_POST["submit"])) {
    $usr = $_POST["usuario"];
    $pwd = $_POST["contra"];
    
    require_once 'conexion.php';
    require_once 'funciones.php';
    
    // Validar campos vacíos
    $array = array($usr, $pwd);
    if(isEmptyInput($array) == true) {
        header("location: ../../cloth/pages/login.php");
        exit();
    }

    // Buscar usuario
    $uidExists = uidExists($conexion, $usr);
    if(!$uidExists) {
        header("location: ../../cloth/pages/login.php");
        exit();
    }

    // Comparar contraseña (texto plano)
    if($pwd !== $uidExists["contra"]) {
        header("location: ../../cloth/pages/login.php");
        exit();
    }
    
    // Iniciar sesión
    session_start();
    $_SESSION["Id"] = $uidExists["usu_id"];
    $_SESSION["Nom"] = $uidExists["nombre"];
    header("location: ../../cloth/pages/produPrueba.php");
    exit();
}