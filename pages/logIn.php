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
    <link rel="stylesheet" href="clotheS.css">
    <title>Log In</title>
</head>
<body>
    <header class="barra-menu">
        <a href="../index.html">
            <img src="../assets/img/logoFinal.png" class="imgMenu" alt="Inicio">
        </a>

        <!-- Botones de navegación -->
        <a href="../pages/venderPrueba.php" class="vender"><span class="texto">Vender</span></a>
        <a href="../pages/produPrueba.php" class="comprar"><span class="textoc">Comprar</span></a>
        <a href="../pages/paraTiP.php" class="paraTi"><span class="textop">Para ti</span></a>

        <a href="../pages/meGusta.php" class="meGusta">
            <img src="../assets/img/Heart.png" alt="meGusta" class="imagen-corazon">
        </a>

        <!-- Botón de usuario que abre el modal -->
        <a href="#" class="user" id="openModal">
            <img src="../assets/img/user.png" alt="login" class="imagen">
        </a>

        <?php
        session_start();
        if(isset($_SESSION["Id"])){
            echo htmlspecialchars($_SESSION["Nom"]);
        }
        ?>
    </header>

    <!-- Modal de Login -->
    <div id="modalLogin" class="modal">
        <div class="modal-contenido">
            <span class="cerrar">&times;</span>
            <h2>Iniciar Sesión</h2>
            <form id="loginForm" action="../backend/login.php" method="post">
                <input type="text" name="usuario" id="usuario" class="login-input" placeholder="Usuario" required>
                <input type="password" name="contra" id="contra" class="login-input" placeholder="Contraseña" required>
                <button type="submit" class="login-btn" name="submit">Iniciar Sesión</button>
                <p id="errorLogin"></p>
            </form>
            <p class="auth-switch">¿No tienes cuenta? <a href="logIn2.php" id="showRegister">Regístrate aquí</a></p>
        </div>
    </div>

    <!-- JavaScript para controlar el modal -->
     <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Página de login cargada');
            
            // Obtener elementos del modal
            const modal = document.getElementById('modalLogin');
            const closeModalBtn = document.getElementById('cerrarLogin');
            const showRegisterLink = document.getElementById('showRegister');

            // ⚡ AUTO-ABRIR MODAL SIEMPRE
            if (modal) {
                console.log('Abriendo modal automáticamente...');
                modal.style.display = 'block';
                modal.classList.add('show');
                
                // Focus en el primer input
                setTimeout(() => {
                    const firstInput = document.getElementById('usuario');
                    if (firstInput) firstInput.focus();
                }, 300);
            } else {
                console.error('Modal con ID "modalLogin" no encontrado');
            }

            // Función para cerrar modal y redirigir
            function closeModalAndRedirect() {
                if (modal) {
                    modal.style.display = 'none';
                    modal.classList.remove('show');
                }
                setTimeout(() => {
                    window.location.href = '../index.html';
                }, 200);
            }

            // Event listeners para cerrar modal
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', closeModalAndRedirect);
            }

            // Cerrar con clic fuera del modal
            window.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModalAndRedirect();
                }
            });

            // Cerrar con ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal && modal.style.display === 'block') {
                    closeModalAndRedirect();
                }
            });

            // Enlace a registro
            if (showRegisterLink) {
                showRegisterLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = 'logIn2.php';
                });
            }

            // Manejo de errores desde URL
            const urlParams = new URLSearchParams(window.location.search);
            const errorDiv = document.getElementById('errorLogin');
            
            if (urlParams.get('error') && errorDiv) {
                const errorMessages = {
                    'invalid': 'Usuario o contraseña incorrectos',
                    'empty': 'Por favor completa todos los campos',
                    'failed': 'Error al iniciar sesión. Intenta de nuevo.',
                    'user_not_found': 'Usuario no encontrado',
                    'wrong_password': 'Contraseña incorrecta'
                };
                
                const errorType = urlParams.get('error');
                if (errorMessages[errorType]) {
                    errorDiv.textContent = errorMessages[errorType];
                }
            }

            // Limpiar mensajes cuando el usuario empieza a escribir
            const inputs = document.querySelectorAll('.login-input');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (errorDiv) errorDiv.textContent = '';
                });
            });

            // Mensaje de éxito si viene de registro
            if (urlParams.get('success') === 'registered') {
                if (errorDiv) {
                    errorDiv.textContent = '¡Cuenta creada exitosamente! Ahora puedes iniciar sesión.';
                    errorDiv.style.color = '#28a745';
                    errorDiv.style.background = 'rgba(40, 167, 69, 0.1)';
                    errorDiv.style.borderColor = 'rgba(40, 167, 69, 0.2)';
                }
            }
        });
    </script>
</body>
</html>