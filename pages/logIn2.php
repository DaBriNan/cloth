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
    <title>Registro - ClothEasy</title>
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

        <!-- Botón de usuario que abre el modal de registro -->
        <a href="#" class="user" id="openRegisterModal">
            <img src="../assets/img/user.png" alt="registro" class="imagen">
        </a>
    </header>

    <!-- Modal de Registro -->
    <div id="registerSection" class="registerSection modal">
        <div class="registerFormContainer modal-contenido">
            <span class="cerrar" id="cerrarRegistro">&times;</span>
            <h2>Crear Cuenta</h2>
            <form id="registerForm" action="../backend/registro.php" method="post">
                <input type="email" name="email" class="auth-input login-input" placeholder="Correo electrónico" required>
                <input type="password" name="contra" class="auth-input login-input" placeholder="Contraseña" required>
                <input type="password" name="confirm_contra" class="auth-input login-input" placeholder="Confirmar contraseña" required>
                <input type="text" name="nombre" class="auth-input login-input" placeholder="Nombre completo" required>
                <input type="text" name="direccion" class="auth-input login-input" placeholder="Dirección">
                <input type="text" name="estado" class="auth-input login-input" placeholder="Estado">
                <input type="text" name="ciudad" class="auth-input login-input" placeholder="Ciudad">
                <input type="text" name="cp" class="auth-input login-input" placeholder="Código Postal">
                <button type="submit" class="auth-btn login-btn" name="submit">
                    <i class="fas fa-user-plus"></i> Crear Cuenta
                </button>
                <p id="errorRegister" class="error-message"></p>
            </form>
            <p class="auth-switch">¿Ya tienes cuenta? <a href="logIn.php" id="showLogin">Inicia sesión aquí</a></p>
        </div>
    </div>

    <!-- JavaScript para controlar el modal de registro -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Página de registro cargada');
            
            // Obtener elementos del modal
            const registerModal = document.getElementById('registerSection');
            const closeRegisterBtn = document.getElementById('cerrarRegistro');
            const showLoginLink = document.getElementById('showLogin');

            // ⚡ AUTO-ABRIR MODAL SIEMPRE
            if (registerModal) {
                console.log('Abriendo modal de registro automáticamente...');
                registerModal.style.display = 'block';
                registerModal.classList.add('show');
                
                // Focus en el primer input
                setTimeout(() => {
                    const firstInput = document.querySelector('input[name="email"]');
                    if (firstInput) firstInput.focus();
                }, 300);
            } else {
                console.error('Modal con ID "registerSection" no encontrado');
            }

            // Función para cerrar modal y redirigir
            function closeRegisterModalAndRedirect() {
                if (registerModal) {
                    registerModal.style.display = 'none';
                    registerModal.classList.remove('show');
                }
                setTimeout(() => {
                    window.location.href = '../index.html';
                }, 200);
            }

            // Event listeners para cerrar modal
            if (closeRegisterBtn) {
                closeRegisterBtn.addEventListener('click', closeRegisterModalAndRedirect);
            }

            // Cerrar con clic fuera del modal
            window.addEventListener('click', function(e) {
                if (e.target === registerModal) {
                    closeRegisterModalAndRedirect();
                }
            });

            // Cerrar con ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && registerModal && registerModal.style.display === 'block') {
                    closeRegisterModalAndRedirect();
                }
            });

            // Enlace a login
            if (showLoginLink) {
                showLoginLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = 'logIn.php';
                });
            }

            // Manejo de errores desde URL
            const urlParams = new URLSearchParams(window.location.search);
            const errorDiv = document.getElementById('errorRegister');
            
            if (urlParams.get('error') && errorDiv) {
                const errorMessages = {
                    'passwords_not_match': 'Las contraseñas no coinciden',
                    'email_exists': 'Este correo ya está registrado',
                    'invalid_email': 'Correo electrónico inválido',
                    'short_password': 'La contraseña debe tener al menos 6 caracteres',
                    'empty_fields': 'Por favor completa todos los campos obligatorios',
                    'registration_failed': 'Error al crear la cuenta. Intenta de nuevo.'
                };
                
                const errorType = urlParams.get('error');
                if (errorMessages[errorType]) {
                    errorDiv.textContent = errorMessages[errorType];
                }
            }

            // Mensaje de éxito si la cuenta se creó correctamente
            if (urlParams.get('success') === 'registered') {
                if (errorDiv) {
                    errorDiv.textContent = '¡Cuenta creada exitosamente! Redirigiendo al login...';
                    errorDiv.classList.add('success-message');
                    
                    // Redirigir al login después de 2 segundos
                    setTimeout(() => {
                        window.location.href = 'logIn.php?success=registered';
                    }, 2000);
                }
            }

            // Limpiar mensajes cuando el usuario empieza a escribir
            const inputs = document.querySelectorAll('.auth-input');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (errorDiv) errorDiv.textContent = '';
                    // Quitar clase de error
                    this.classList.remove('error');
                });
            });

            // Validación de contraseñas en tiempo real
            const passwordInput = document.querySelector('input[name="contra"]');
            const confirmPasswordInput = document.querySelector('input[name="confirm_contra"]');

            function validatePasswords() {
                if (confirmPasswordInput.value && passwordInput.value !== confirmPasswordInput.value) {
                    confirmPasswordInput.setCustomValidity('Las contraseñas no coinciden');
                    confirmPasswordInput.classList.add('error');
                } else {
                    confirmPasswordInput.setCustomValidity('');
                    confirmPasswordInput.classList.remove('error');
                }
            }

            if (passwordInput && confirmPasswordInput) {
                passwordInput.addEventListener('input', validatePasswords);
                confirmPasswordInput.addEventListener('input', validatePasswords);
            }

            // Validación de email en tiempo real
            const emailInput = document.querySelector('input[name="email"]');
            if (emailInput) {
                emailInput.addEventListener('blur', function() {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (this.value && !emailRegex.test(this.value)) {
                        this.setCustomValidity('Por favor ingresa un correo válido');
                        this.classList.add('error');
                    } else {
                        this.setCustomValidity('');
                        this.classList.remove('error');
                    }
                });
            }

            // Validación de longitud de contraseña
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    if (this.value && this.value.length < 6) {
                        this.setCustomValidity('La contraseña debe tener al menos 6 caracteres');
                        this.classList.add('error');
                    } else {
                        this.setCustomValidity('');
                        this.classList.remove('error');
                    }
                });
            }
        });
    </script>
</body>
</html>