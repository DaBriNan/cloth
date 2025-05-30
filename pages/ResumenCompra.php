<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/img/logoFinal.png">
    <link rel="stylesheet"  href="../assets/estilos/ResumenCompra.css" >
    <link rel="stylesheet"  href="clotheS.css" >
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <title>Bolsa de Compra</title>
</head>

<body>

<!-- Modal de éxito de compra -->
<div id="purchaseSuccessModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-content">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            
            <h2 class="modal-title">¡Compra Exitosa!</h2>
            <p class="modal-message">
                Gracias <?= isset($_SESSION['Nom']) ? htmlspecialchars($_SESSION['Nom']) : '' ?> por tu compra. 
                Tu pedido ha sido registrado correctamente.
            </p>
            
            <div class="modal-buttons">
                <button class="btn-continue" onclick="continueShopping()">
                    <i class="fas fa-shopping-bag"></i>
                    Seguir Comprando
                </button>
                <button class="btn-home" onclick="goHome()">
                    <i class="fas fa-home"></i>
                    Ir al Inicio
                </button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos del modal */
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
    max-width: 450px;
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

.success-icon {
    margin-bottom: 25px;
}

.success-icon i {
    font-size: 4em;
    color: #4CAF50;
    text-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
    animation: pulse 2s infinite;
}

.modal-title {
    font-family: 'Outfit', sans-serif;
    font-size: 2em;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
    background: linear-gradient(45deg, #4CAF50, #45a049);
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

.btn-continue, .btn-home {
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

.btn-continue {
    background: linear-gradient(45deg, #8781FF, #6A65C8);
    color: white;
}

.btn-continue:hover {
    background: linear-gradient(45deg, #9691FF, #7A75D8);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(135, 129, 255, 0.4);
}

.btn-home {
    background: linear-gradient(45deg, #6fbfd1, #5fa8b8);
    color: white;
}

.btn-home:hover {
    background: linear-gradient(45deg, #7dd3d8, #6bb8c4);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(111, 191, 209, 0.4);
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

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

@media (max-width: 768px) {
    .modal-container {
        width: 95%;
        margin: 20px;
    }
    
    .modal-content {
        padding: 30px 20px;
    }
    
    .modal-title {
        font-size: 1.6em;
    }
    
    .modal-message {
        font-size: 1em;
    }
    
    .modal-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-continue, .btn-home {
        width: 100%;
        max-width: 250px;
    }
    
    .success-icon i {
        font-size: 3em;
    }
}
</style>

<header class="barra-menu">
    <a href="../index.html">
        <img src="../assets/img/logoFinal.png" class="imgMenu" alt="Inicio">
    </a>
   
   <a href="../pages/venderPrueba.php" class="vender"><span class="texto">Vender</span></a>
    <a href="../pages/produPrueba.php" class="comprar"><span class="textoc">Comprar</span></a>
    <a href="../pages/paraTiP.php" class="paraTi"><span class="textop">Para ti</span></a>

     <a href="../pages/meGusta.php" class="meGusta">
        <img src="../assets/img/Heart.png" alt="meGusta" class="imagen-corazon">
    </a>

    <?php if(isset($_SESSION["Id"])): ?>
        <!-- Usuario logueado -->
        <div class="user-logged-section" style="display: flex;">
            <div class="user-info">
                <img src="../assets/img/user.png" alt="usuario" class="user-avatar">
                <span class="user-name-display"><?= htmlspecialchars($_SESSION['Nom']) ?></span>
            </div>
            
            <div class="user-actions">
                <a href="../pages/perfil.php" class="action-btn profile-btn" title="Ver perfil">
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
    <?php else: ?>
        <!-- Usuario NO logueado -->
        <a href="../pages/logIn.php" class="user">
            <img src="../assets/img/user.png" alt="login" class="imagen">
        </a>
    <?php endif; ?>
</header>

<div class="cart-icon" id="cartIcon">
    <span class="material-symbols-outlined">shopping_cart</span>
    <span class="cart-count" id="cartCount">0</span>
</div>

<div class="cart-container" id="cartContainer">
    <div class="cart-header">
        <h2>Tu Carrito</h2>
        <span class="close-cart" id="closeCart">×</span>
    </div>
    <div id="cartItems"></div>
    <div class="cart-footer">
        <div class="cart-total">
            <h3>Total: $<span id="cartTotal">0</span></h3>
        </div>
        <button class="checkout-btn" id="checkoutBtn">Finalizar Compra</button>
    </div>
</div>

<div class="overlay" id="overlay"></div>

<h1><span class="azul">Bolsa de</span> <span class="celeste">Compra</span></h1>
<br>

<div class="compra-wrapper">
    <!-- Formulario de datos de envío -->
    <section class="datos-envio">
        <h2>Datos de Envío</h2>
        <form id="formularioEnvio">
            <div class="form-group">
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" name="nombre" 
                       value="<?= isset($_SESSION['Nom']) ? htmlspecialchars($_SESSION['Nom']) : '' ?>" 
                       required>
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" 
                       value="<?= isset($_SESSION['Dir']) ? htmlspecialchars($_SESSION['Dir']) : '' ?>" 
                       required>
            </div>

            <div class="form-group">
                <label for="ciudad">Ciudad</label>
                <input type="text" id="ciudad" name="ciudad" 
                       value="<?= isset($_SESSION['Ciu']) ? htmlspecialchars($_SESSION['Ciu']) : '' ?>" 
                       required>
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" id="estado" name="estado" 
                       value="<?= isset($_SESSION['Edo']) ? htmlspecialchars($_SESSION['Edo']) : '' ?>" 
                       required>
            </div>

            <div class="form-group">
                <label for="codigoPostal">Código Postal</label>
                <input type="text" id="codigoPostal" name="codigoPostal" 
                       value="<?= isset($_SESSION['Cp']) ? htmlspecialchars($_SESSION['Cp']) : '' ?>" 
                       required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono"
                       value="<?= isset($_SESSION['Tel']) ? htmlspecialchars($_SESSION['Tel']) : '' ?>" 
                       required>
            </div>

            <button type="submit" class="btn-enviar">🔒 Finalizar Pedido</button>
            <div id="paypal-button-container"></div>
        </form>
    </section>

    <div id="resumenContainer" class="contenedor">
        <!-- JavaScript llenará este contenedor -->
        <div class="descuento-seccion" style="display: none;">
            <div class="descuento-input">
                <input type="text" placeholder="Código de descuento" id="codigoDescuento">
                <button type="button" onclick="aplicarDescuento()">Aplicar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://www.paypal.com/sdk/js?client-id=ASDHu3rw0jW3_YguE0695whO9pZvutc3by-p_tVgB64kJiBwRFiSujUsYy7haPmSWOh-C-8qftUiDIJv&currency=MXN"></script>
<script src="../assets/js/paypal.js"></script>
<script src="../assets/js/buy.js"></script>
<script src="../assets/js/compras.js"></script>
<script src="../assets/js/productos.js"></script>
<script src="../assets/js/meGusta.js"></script>
<script src="../assets/js/favs.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>   

<script>
// JavaScript simplificado - solo para el modal

// Función para eliminar productos (actualizada)


// Mostrar modal de éxito
function showPurchaseSuccessModal() {
    const modal = document.getElementById('purchaseSuccessModal');
    modal.classList.add('show');
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });
}

// Cerrar modal
function closeModal() {
    const modal = document.getElementById('purchaseSuccessModal');
    modal.classList.remove('show');
}

// Continuar comprando
function continueShopping() {
    closeModal();
    window.location.href = "../pages/produPrueba.php";
}

// Ir al inicio
function goHome() {
    closeModal();
    window.location.href = "../index.html";
}

// Cerrar modal con ESC
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Debug para verificar que los datos se llenaron
document.addEventListener('DOMContentLoaded', function() {
    console.log('=== DATOS LLENADOS POR PHP ===');
    console.log('Nombre:', document.getElementById('nombre').value);
    console.log('Dirección:', document.getElementById('direccion').value);
    console.log('Ciudad:', document.getElementById('ciudad').value);
    console.log('Estado:', document.getElementById('estado').value);
    console.log('Código Postal:', document.getElementById('codigoPostal').value);
    console.log('Teléfono:', document.getElementById('telefono').value);
});
</script>

</body>
</html>