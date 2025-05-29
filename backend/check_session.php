<?php
session_start();
header('Content-Type: application/json');

// Verificar si el usuario está logueado
if(isset($_SESSION["Id"]) && isset($_SESSION["Nom"])) {
    // Usuario logueado - devolver información
    echo json_encode([
        'loggedIn' => true,
        'user' => [
            'id' => $_SESSION["Id"],
            'name' => $_SESSION["Nom"],
            'direccion' => isset($_SESSION["Dir"]) ? $_SESSION["Dir"] : '',
            'ciudad' => isset($_SESSION["Ciu"]) ? $_SESSION["Ciu"] : '',
            'estado' => isset($_SESSION["Edo"]) ? $_SESSION["Edo"] : '',
            'cp' => isset($_SESSION["Cp"]) ? $_SESSION["Cp"] : ''
        ]
    ]);
} else {
    // Usuario no logueado
    echo json_encode([
        'loggedIn' => false,
        'user' => null
    ]);
}
?>