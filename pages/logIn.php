<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/img/logoFinal.png">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="../assets/estilos/login.css">
    <link rel="stylesheet"  href="clotheS.css" >
    <title>Log In</title>
</head>
<body>
    <header class="barra-menu">
        <a href="./index.html">
            <img src="../assets/img/logoFinal.png" class="imgMenu" alt="Inicio">
        </a>
        <div class="container">
      
            <form action="" class="search-form">
              <input type="text" placeholder="Buscar..." class="search-input" />
      
              <div class="search-button">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <i class="fa-solid fa-xmark search-close"></i>
              </div>
            </form>
        </div>
       <a href="../pages/venderPrueba.php" class="vender"><span class="texto">Vender</span></a>
        <a href="../pages/produPrueba.php" class="comprar"><span class="textoc">Comprar</span></a>
        <a href="../pages/paraTiP.php" class="paraTi"><span class="textop">Para ti</span></a>

         <a href="../pages/meGusta.php" class="meGusta">
            <img src="../assets/img/Heart.png" alt="meGusta" class="imagen">
        </a>
       
        <a href="../pages/logIn.php" class="user">
            <img src="../assets/img/user.png" alt="login" class="imagen">
        </a>
         <?php
        session_start();
        if(isset($_SESSION["Id"])){
            echo $_SESSION["Nom"];
        }
     ?>
    </header>

    <!-- Modal de Login -->
    <div id="modalLogin" class="modal">
        <div class="modal-contenido">
            <span class="cerrar">&times;</span>
            <h2>Iniciar Sesión</h2>
            <form id="loginForm"  action="../backend/login.php" method="post">
                <input type="text" name="usuario"  id="usuario" class="login-input" placeholder="Usuario" required>
                <input type="password" name="contra" id="contra" class="login-input" placeholder="Contraseña" required>
                <button type="submit"  class="login-btn" name="submit"> <a href="index.html"></a>  Iniciar Sesión</button>
                <p id="errorLogin"></p>
            </form>
            <p class="auth-switch">¿No tienes cuenta? <a href="logIn2.php" id="showRegister">Regístrate aquí</a></p>
        </div>
    </div>

    <!-- <script src="../assets/js/log.js"></script> -->
</body>
</html>