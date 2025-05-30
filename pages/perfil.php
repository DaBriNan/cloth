<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION["Id"])) {
    header("Location: login.php");
    exit();
}

// Procesar actualizaciones de perfil
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_profile'])) {
        // Aquí puedes agregar la lógica para actualizar la base de datos
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $ciudad = $_POST['ciudad'];
        $estado = $_POST['estado'];
        $cp = $_POST['cp'];
        
        // Actualizar variables de sesión temporalmente
        $_SESSION["Nom"] = $nombre;
        $_SESSION["Dir"] = $direccion;
        $_SESSION["Ciu"] = $ciudad;
        $_SESSION["Edo"] = $estado;
        $_SESSION["Cp"] = $cp;
        
        $mensaje = "Perfil actualizado exitosamente";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - ClothEasy</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/logoFinal.png">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="clotheS.css">
    
    <style>
        .profile-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
            font-family: 'Outfit', sans-serif;
        }

        .profile-header {
            background: linear-gradient(135deg, #6fbfd1, #caebca, #9171a8);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 60px;
            backdrop-filter: blur(10px);
            border: 4px solid rgba(255,255,255,0.3);
        }

        .profile-header h1 {
            margin: 0 0 10px 0;
            font-size: 2.5em;
            font-weight: 700;
        }

        .profile-header p {
            margin: 0;
            font-size: 1.1em;
            opacity: 0.9;
        }

        .profile-content {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .profile-sidebar {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            height: fit-content;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .sidebar-item:hover {
            background: linear-gradient(90deg, rgba(111, 191, 209, 0.1), rgba(202, 235, 202, 0.1));
            transform: translateX(5px);
            border-color: rgba(111, 191, 209, 0.3);
        }

        .sidebar-item.active {
            background: linear-gradient(90deg, rgba(111, 191, 209, 0.2), rgba(202, 235, 202, 0.2));
            border-color: #6fbfd1;
            font-weight: 600;
        }

        .sidebar-item i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .profile-main {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .section-title {
            font-size: 1.8em;
            color: #333;
            margin-bottom: 20px;
            font-weight: 600;
            border-bottom: 3px solid #6fbfd1;
            padding-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            font-family: 'Outfit', sans-serif;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #6fbfd1;
            box-shadow: 0 0 0 3px rgba(111, 191, 209, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6fbfd1, #9171a8);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Outfit', sans-serif;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(111, 191, 209, 0.4);
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        /* ========== ESTILOS DEL MODAL DE LOGOUT ========== */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 10000;
            animation: fadeIn 0.3s ease;
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal-container {
            background: white;
            border-radius: 20px;
            padding: 0;
            max-width: 420px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.4s ease;
            overflow: hidden;
        }

        .modal-content {
            text-align: center;
            padding: 40px 30px;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        .logout-icon {
            margin-bottom: 25px;
        }

        .logout-icon i {
            font-size: 3.5em;
            color: #ff6b6b;
            text-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
            animation: shake 0.5s ease-in-out;
        }

        .modal-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.8em;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .modal-message {
            font-family: 'Outfit', sans-serif;
            font-size: 1.1em;
            color: #666;
            margin-bottom: 35px;
            line-height: 1.5;
        }

        .modal-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-logout, .btn-cancel {
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            padding: 15px 25px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1em;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 160px;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-logout {
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            color: white;
        }

        .btn-logout:hover {
            background: linear-gradient(45deg, #ff7979, #ff6348);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4);
        }

        .btn-cancel {
            background: linear-gradient(45deg, #6c757d, #5a6268);
            color: white;
        }

        .btn-cancel:hover {
            background: linear-gradient(45deg, #7a8288, #6c757d);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(50px) scale(0.9);
            }
            to { 
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        @media (max-width: 768px) {
            .profile-content {
                grid-template-columns: 1fr;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .profile-header {
                padding: 30px 20px;
            }
            
            .profile-header h1 {
                font-size: 2em;
            }

            .modal-container {
                width: 95%;
                margin: 20px;
            }
            
            .modal-content {
                padding: 30px 20px;
            }
            
            .modal-title {
                font-size: 1.5em;
            }
            
            .modal-message {
                font-size: 1em;
            }
            
            .modal-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn-logout, .btn-cancel {
                width: 100%;
                max-width: 250px;
            }
            
            .logout-icon i {
                font-size: 3em;
            }
        }
    </style>
</head>

<body>
    <!-- Modal de confirmación de logout -->
    <div id="logoutConfirmModal" class="modal-overlay">
        <div class="modal-container">
            <div class="modal-content">
                <div class="logout-icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                
                <h2 class="modal-title">¿Cerrar Sesión?</h2>
                <p class="modal-message">
                    ¿Estás seguro de que quieres cerrar tu sesión, 
                    <strong><?php echo htmlspecialchars($_SESSION["Nom"]); ?></strong>?
                </p>
                
                <div class="modal-buttons">
                    <button class="btn-logout" onclick="confirmLogout()">
                        <i class="fas fa-sign-out-alt"></i>
                        Sí, Cerrar Sesión
                    </button>
                    <button class="btn-cancel" onclick="cancelLogout()">
                        <i class="fas fa-times"></i>
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Header con sistema de usuario -->
    <header class="barra-menu">
        <a href="../index.html">
            <img src="../assets/img/logoFinal.png" class="imgMenu" alt="Inicio">
        </a>
        
        <a href="venderPrueba.php" class="vender"><span class="texto">Vender</span></a>
        <a href="produPrueba.php" class="comprar"><span class="textoc">Comprar</span></a>
        <a href="paraTiP.php" class="paraTi"><span class="textop">Para ti</span></a>
        
        <a href="meGusta.php" class="meGusta">
            <img src="../assets/img/Heart.png" alt="Favoritos" class="imagen-corazon">
        </a>

        <!-- Usuario logueado -->
        <div class="user-logged-section">
            <!-- Información del usuario (avatar + nombre) -->
            <div class="user-info">
                <img src="../assets/img/user.png" alt="usuario" class="user-avatar">
                <span class="user-name-display"><?php echo htmlspecialchars($_SESSION["Nom"]); ?></span>
            </div>
            
            <!-- Botones de acción -->
            <div class="user-actions">
                <a href="perfil.php" class="action-btn profile-btn" title="Ver perfil">
                    <i class="fas fa-user"></i>
                    <span>Perfil</span>
                </a>
                
                <!-- ⚡ BOTÓN ACTUALIZADO CON MODAL -->
                <a href="#" class="action-btn logout-btn" title="Cerrar sesión" onclick="showLogoutModal(); return false;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Salir</span>
                </a>
            </div>
        </div>
    </header>

    <div class="profile-container">
        <!-- Header del perfil -->
        <div class="profile-header">
            <div class="profile-avatar">
                <i class="fas fa-user"></i>
            </div>
            <h1><?php echo htmlspecialchars($_SESSION["Nom"]); ?></h1>
            <p> • ID: <?php echo $_SESSION["Id"]; ?></p>
        </div>

        <!-- Contenido principal -->
        <div class="profile-content">
            <!-- Sidebar -->
            <div class="profile-sidebar">
                <a href="#" class="sidebar-item active">
                    <i class="fas fa-user"></i>
                    Información Personal
                </a>
                
                <!-- ⚡ ENLACE ACTUALIZADO CON MODAL -->
                <a href="#" class="sidebar-item" onclick="showLogoutModal(); return false;">
                    <i class="fas fa-sign-out-alt"></i>
                    Cerrar Sesión
                </a>
            </div>

            <!-- Contenido principal -->
            <div class="profile-main">
                <?php if (isset($mensaje)): ?>
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i> <?php echo $mensaje; ?>
                    </div>
                <?php endif; ?>

                <h2 class="section-title">Información Personal</h2>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nombre">Nombre Completo</label>
                        <input type="text" id="nombre" name="nombre" 
                               value="<?php echo htmlspecialchars($_SESSION["Nom"] ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" id="direccion" name="direccion" 
                               value="<?php echo htmlspecialchars($_SESSION["Dir"] ?? ''); ?>">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="ciudad">Ciudad</label>
                            <input type="text" id="ciudad" name="ciudad" 
                                   value="<?php echo htmlspecialchars($_SESSION["Ciu"] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <input type="text" id="estado" name="estado" 
                                   value="<?php echo htmlspecialchars($_SESSION["Edo"] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cp">Código Postal</label>
                        <input type="text" id="cp" name="cp" 
                               value="<?php echo htmlspecialchars($_SESSION["Cp"] ?? ''); ?>">
                    </div>

                    <!-- <button type="submit" name="update_profile" class="btn-primary">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button> -->
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-logo">
                <h2>CLOTHEASY</h2>
                <p>REDES SOCIALES</p>
                <div class="social-icons">
                    <img src="../assets/img/facebook.png" alt="Facebook">
                    <img src="../assets/img/instagram.png" alt="Instagram">
                    <img src="../assets/img/x.png" alt="Email">
                </div>
            </div>

            <div class="footer-links">
                <h3>COMPRA</h3>
                <ul>
                    <li><a href="#">Productos</a></li>
                    <li><a href="#">Precios</a></li>
                    <li><a href="#">Reembolso</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h3>COMPAÑÍA</h3>
                <ul>
                    <li><a href="#">Sobre Nosotros</a></li>
                    <li><a href="#">Contacto</a></li>
                    <li><a href="#">Noticias</a></li>
                    <li><a href="#">Soporte</a></li>
                </ul>
            </div>

            <div class="footer-newsletter">
                <h3>NO TE PIERDAS LAS OFERTAS</h3>
                <form>
                    <input type="email" placeholder="Ingresa tu correo">
                    <button type="submit">ENVIAR</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <p>Términos • Privacidad • Cookies</p>
        </div>
    </footer>

    <!-- logout -->
    <script>
    // Mostrar modal de confirmación de logout
    function showLogoutModal() {
        const modal = document.getElementById('logoutConfirmModal');
        modal.classList.add('show');
        
        // Cerrar modal si se hace clic fuera de él
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                cancelLogout();
            }
        });
    }

    // Confirmar logout - proceder con el cierre de sesión
    function confirmLogout() {
        const modal = document.getElementById('logoutConfirmModal');
        modal.classList.remove('show');
        
        // Redirigir al logout
        window.location.href = '../backend/logout.php';
    }

    // Cancelar logout - cerrar modal sin hacer nada
    function cancelLogout() {
        const modal = document.getElementById('logoutConfirmModal');
        modal.classList.remove('show');
    }

    // Cerrar modal con tecla ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            const modal = document.getElementById('logoutConfirmModal');
            if (modal.classList.contains('show')) {
                cancelLogout();
            }
        }
    });
    </script>
</body>
</html>