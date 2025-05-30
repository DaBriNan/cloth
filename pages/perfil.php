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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(111, 191, 209, 0.3);
        }

        .stat-icon {
            font-size: 2.5em;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #6fbfd1, #caebca);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-number {
            font-size: 2em;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #666;
            font-size: 0.9em;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .recent-activity {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6fbfd1, #caebca);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 15px;
        }

        .activity-text {
            flex: 1;
        }

        .activity-time {
            color: #666;
            font-size: 0.9em;
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
        }
    </style>
</head>

<body>
    <!-- Header con sistema de usuario -->
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
        
        <a href="venderPrueba.php" class="vender"><span class="texto">Vender</span></a>
        <a href="produPrueba.php" class="comprar"><span class="textoc">Comprar</span></a>
        <a href="paraTiP.php" class="paraTi"><span class="textop">Para ti</span></a>
        
        <a href="meGusta.php" class="meGusta">
            <img src="../assets/img/Heart.png" alt="Favoritos" class="imagen-corazon">
        </a>

        <!-- Usuario logueado -->
        <!-- <div class="user-menu">
            <button class="user user-button" onclick="toggleUserDropdown()">
                <img src="../assets/img/user.png" alt="usuario" class="imagen">
                <span class="user-name"><?php echo htmlspecialchars($_SESSION["Nom"]); ?></span>
                <i class="fas fa-chevron-down"></i>
            </button>
            
            <div class="user-dropdown" id="user-dropdown">
                <div class="user-info">
                    <h4><?php echo htmlspecialchars($_SESSION["Nom"]); ?></h4>
                    <p>ID: <?php echo $_SESSION["Id"]; ?></p>
                </div>
                
                <a href="perfil.php" class="active">
                    <i class="fas fa-user" style="margin-right: 8px;"></i>
                    Mi Perfil
                </a> -->
                <!-- <a href="misPedidos.php">
                    <i class="fas fa-shopping-bag" style="margin-right: 8px;"></i>
                    Mis Pedidos
                </a> -->
                <!-- <a href="direcciones.php">
                    <i class="fas fa-map-marker-alt" style="margin-right: 8px;"></i>
                    Mis Direcciones
                </a> -->
                <!-- <a href="configuracion.php">
                    <i class="fas fa-cog" style="margin-right: 8px;"></i>
                    Configuración
                </a> -->
                <!-- <a href="../backend/logout.php" class="logout-link" onclick="return confirmLogout()">
                    <i class="fas fa-sign-out-alt logout-icon" style="margin-right: 8px;"></i>
                    Cerrar Sesión
                </a>
            </div>
        </div> -->
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
            
            <a href="#" class="action-btn logout-btn" title="Cerrar sesión"
               onclick="if(confirm('¿Cerrar sesión?')) { window.location.href='../backend/logout.php'; } return false;">
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

        <!-- Estadísticas rápidas -->
         <!-- esto ahorita no pero quiero que funcione ya despues de que entregue -->
        <!-- <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="stat-number">12</div>
                <div class="stat-label">Compras realizadas</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-number">8</div>
                <div class="stat-label">Productos favoritos</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-number">4.8</div>
                <div class="stat-label">Calificación promedio</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="stat-number">$2,450</div>
                <div class="stat-label">Total gastado</div>
            </div>
        </div> -->

        <!-- Contenido principal -->
        <div class="profile-content">
            <!-- Sidebar -->
            <div class="profile-sidebar">
                <a href="#" class="sidebar-item active">
                    <i class="fas fa-user"></i>
                    Información Personal
                </a>
                <!-- <a href="misPedidos.php" class="sidebar-item">
                    <i class="fas fa-shopping-bag"></i>
                    Mis Pedidos
                </a>
                <a href="meGusta.php" class="sidebar-item">
                    <i class="fas fa-heart"></i>
                    Favoritos
                </a>
                <a href="#" class="sidebar-item">
                    <i class="fas fa-map-marker-alt"></i>
                    Direcciones
                </a>
                <a href="#" class="sidebar-item">
                    <i class="fas fa-credit-card"></i>
                    Métodos de Pago
                </a> -->
                <!-- <a href="#" class="sidebar-item">
                    <i class="fas fa-cog"></i>
                    Configuración
                </a> -->
                <a href="../backend/logout.php" class="sidebar-item" onclick="return confirmLogout()">
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
<!-- 
                    <button type="submit" name="update_profile" class="btn-primary">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button> -->
                </form>

                <!-- Actividad reciente -->
                 <!-- tambien quiero que funcione pero no en este momento -->
                <!-- <div class="recent-activity">
                    <h3>Actividad Reciente</h3>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="activity-text">
                            <strong>Compra realizada</strong><br>
                            Jersey Real Madrid - $499 MXN
                        </div>
                        <div class="activity-time">Hace 2 días</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="activity-text">
                            <strong>Producto añadido a favoritos</strong><br>
                            Hoodie Nike
                        </div>
                        <div class="activity-time">Hace 1 semana</div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                        <div class="activity-text">
                            <strong>Perfil actualizado</strong><br>
                            Información de contacto modificada
                        </div>
                        <div class="activity-time">Hace 2 semanas</div>
                    </div>
                </div> -->
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

  <script>
function confirmLogout() {
    return confirm('¿Estás seguro que deseas cerrar sesión?');
}
</script>
</body>
</html>