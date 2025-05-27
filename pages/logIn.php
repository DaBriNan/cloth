<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/assets/img/logoFinal.png">
    <link rel="stylesheet" href="/assets/estilos/login.css">
    <title>Log In</title>
</head>
<body>
    <header class="barra-menu">
        <a href="/index.html">
            <img src="/assets/img/logoFinal.png" class="imgMenu" alt="Inicio">
        </a>
        <div class="barra">
            <form class="search-bar" action="/buscar" method="get">
                <input type="text" placeholder="Buscar..." name="q">
                <button type="submit">Buscar</button>
            </form>
        </div>
        <a href="/pages/vender.html" class="vender"><span class="texto">Vender</span></a>
        <a href="/pages/compras.html" class="comprar"><span class="textoc">Comprar</span></a>
        <a href="/pages/paraTi.html" class="paraTi"><span class="textop">Para ti</span></a>
        <div class="meGusta">
            <img src="/assets/img/Heart.png" alt="meGusta" class="imagen">
        </div>
        <a href="#" id="btnAbrirModal" class="user">
            <img src="/assets/img/user.png" alt="login" class="imagen">
        </a>
    </header>

    <!-- Modal de Login -->
    <div id="modalLogin" class="modal">
        <div class="modal-contenido">
            <span class="cerrar">&times;</span>
            <h2>Iniciar Sesión</h2>
            <form id="loginForm"  action="../backend/login.php" method="post">
                <input type="text" name="usuario"  id="usuario" class="login-input" placeholder="Usuario" required>
                <input type="password" name="contra" id="password" class="login-input" placeholder="Contraseña" required>
                <button type="submit"  class="login-btn" name="submit">Iniciar Sesión</button>
                <p id="errorLogin"></p>
            </form>
        </div>
    </div>

    <script src="/assets/js/log.js"></script>
</body>
</html>