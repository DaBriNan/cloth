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
        <a href="../index.html">
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
        
    </header>

     <!-- Formulario de Registro -->
        <div id="registerSection" class="registerSection">
              <div class="registerFormContainer">
        <span class="cerrar" id="cerrarRegistro">&times;</span>
            <h2>Registro</h2>
            <form id="registerForm" action="../backend/registro.php" method="post">
                <input type="email" name="email" class="auth-input" placeholder="Correo electrónico" required>
                <input type="password" name="contra" class="auth-input" placeholder="Contraseña" required>
                <input type="password" name="confirm_contra" class="auth-input" placeholder="Confirmar contraseña" required>
                <input type="text" name="nombre" class="auth-input" placeholder="Nombre completo" required>
                <input type="text" name="direccion" class="auth-input" placeholder="Direccion">
                <input type="text" name="estado" class="auth-input" placeholder="Estado">
                <input type="text" name="ciudad" class="auth-input" placeholder="Ciudad">
                <input type="text" name="cp" class="auth-input" placeholder="Cp">
                <button type="submit" class="auth-btn" name = "submit">Registrarse</button>
                <p id="errorRegister" class="error-message"></p>
            </form>
            <p class="auth-switch">¿Ya tienes cuenta? <a href="logIn.php" id="showLogin">Inicia sesión aquí</a></p>
        </div>
        
    </div>

    <!-- <script src="../assets/js/log.js"></script> -->

<script>
   /*       
    const loginModal = document.getElementById("modalLogin");
    const registerForm = document.getElementById("registerSection");
    // const showRegister = document.getElementById("showRegister");
    const showLogin = document.getElementById("showLogin");

    // showRegister.addEventListener("click", function(e) {
    //     e.preventDefault();
    //     loginModal.style.display = "none";
    //     registerForm.style.display = "block";
    // });

    showLogin.addEventListener("click", function(e) {
        e.preventDefault();
        registerForm.style.display = "none";
        loginModal.style.display = "block";
    });

    const cerrarRegistro = document.getElementById("cerrarRegistro");

cerrarRegistro.addEventListener("click", function() {
    registerForm.style.display = "none";
});

*/
</script>



</body>
</html>