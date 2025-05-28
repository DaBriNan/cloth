
<?php

use function PHPSTORM_META\type;

function uidExists($conexion, $usr) {
    $sql = "SELECT * FROM usuarios WHERE correo = ?"; // Solo busca por correo
    $stmt = mysqli_stmt_init($conexion);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $usr);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result); // Devuelve el array o NULL si no existe
}


function isEmptyInput(&$array){

    foreach($array as $v){
        if(empty($v)) return true;
    }
    return false;
}

//////////adaptarlo para que haga un insert en ventas
function crearProducto($conexion, $producto, $descripcion, $precio, $talla,$categoria) {
    $sql = "INSERT INTO catalogo (producto, descripcion, precio, talla_id,categoria_id) 
            VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conexion);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return -1;
    }

    mysqli_stmt_bind_param($stmt, "ssdii", $producto, $descripcion, $precio, $talla, $categoria);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return mysqli_insert_id($conexion);
}


//creacion de usuario
function crearUsuario($conexion, $usr, $pwd, $name, $edo, $ciu, $dir, $cod) {
    $sql = "INSERT INTO usuarios (correo, contra, nombre, estado, ciudad, direccion, cp) 
            VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conexion);
    //echo $stmt;
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return -1;
    }

    mysqli_stmt_bind_param($stmt, "sssssss", $usr, $pwd, $name, $edo, $ciu, $dir, $cod);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return mysqli_insert_id($conexion);
}
