<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mis Favoritos - ClothEasy</title>
  <link rel="stylesheet" href="clotheS.css">
  <link rel="stylesheet" href="../assets/estilos/megusta.css">

  <link rel="icon" type="image/x-icon" href="../assets/img/logoFinal.png">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  
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
    <!-- <a href="../pages/logIn.php" class="user">
      <img src="../assets/img/user.png" alt="login" class="imagen">
    </a>
     <?php
        session_start();
        if(isset($_SESSION["Id"])){
            echo $_SESSION["Nom"];
        }
     ?> -->


<a href="../pages/logIn.php" class="user" id="login-btn">
        <img src="../assets/img/user.png" alt="login" class="imagen">
    </a>

    <!-- Sección de usuario logueado (oculta por defecto) -->
    <div class="user-logged-section" id="user-logged-section" style="display: none;">
        <!-- Información del usuario (avatar + nombre) -->
        <div class="user-info">
            <img src="../assets/img/user.png" alt="usuario" class="user-avatar">
            <span class="user-name-display" id="user-name-display">Usuario</span>
        </div>
        
        <!-- Botones de acción -->
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

  </header>

  <script>
// Verificar sesión al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    checkUserSession();
});

// Verificar si hay una sesión activa
function checkUserSession() {
    fetch('../backend/check_session.php') // ← Nota la ruta con ../
        .then(response => response.json())
        .then(data => {
            console.log('Session data:', data);
            
            if (data.loggedIn && data.user) {
                showLoggedInUser(data.user);
            } else {
                showLoggedOutUser();
            }
        })
        .catch(error => {
            console.log('Error verificando sesión:', error);
            showLoggedOutUser();
        });
}

// Mostrar usuario logueado
function showLoggedInUser(user) {
    const loginBtn = document.getElementById('login-btn');
    const userSection = document.getElementById('user-logged-section');
    const userNameDisplay = document.getElementById('user-name-display');
    
    // Ocultar botón de login
    if (loginBtn) loginBtn.style.display = 'none';
    
    // Mostrar sección de usuario logueado
    if (userSection) userSection.style.display = 'flex';
    
    // Mostrar nombre del usuario
    if (userNameDisplay) userNameDisplay.textContent = user.name || 'Usuario';
    
    console.log('Usuario logueado:', user.name);
}

// Mostrar usuario NO logueado
function showLoggedOutUser() {
    const loginBtn = document.getElementById('login-btn');
    const userSection = document.getElementById('user-logged-section');
    
    // Mostrar botón de login
    if (loginBtn) loginBtn.style.display = 'inline-flex';
    
    // Ocultar sección de usuario logueado
    if (userSection) userSection.style.display = 'none';
    
    console.log('Usuario no logueado');
}
</script>

  <div class="favoritos-container">
    <h2>Mis productos favoritos ❤️</h2>
    <div id="listaFavoritos"></div>
  </div>

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
    // Reemplaza el script que genera los favoritos por este:

document.addEventListener("DOMContentLoaded", function() {
  const contenedor = document.getElementById("listaFavoritos");
  let favoritos = JSON.parse(localStorage.getItem("meGusta")) || [];

  if (favoritos.length === 0) {
    contenedor.innerHTML = `
      <div class="empty-favorites">
        <h2>No tienes favoritos aún</h2>
        <p>¡Explora nuestros productos y marca tus favoritos!</p>
        <a href="../pages/produPrueba.php" class="btn-explorar">Explorar Productos</a>
      </div>
    `;
    return;
  }

  // Generar HTML con las clases correctas para el CSS
  contenedor.innerHTML = favoritos.map(producto => `
    <div class="producto-favorito" data-id="${producto.id}">
      <div class="image-container">
        <img src="${producto.image}" alt="${producto.name}">
      </div>
      <div class="info-favorito">
        <h3>${producto.name}</h3>
        <p class="precio-favorito">$${producto.price} MXN</p>
      </div>
      <button class="btn-eliminar" data-id="${producto.id}" title="Eliminar de favoritos">×</button>
      <div class="acciones-favorito">
       
      </div>
    </div>
  `).join("");

  // Manejar eliminación de favoritos
  document.querySelectorAll(".btn-eliminar").forEach(btn => {
    btn.addEventListener("click", function() {
      const productId = this.getAttribute('data-id');
      favoritos = favoritos.filter(p => p.id !== productId);
      localStorage.setItem("meGusta", JSON.stringify(favoritos));
      
      // Animación suave al eliminar
      const productoDiv = this.closest('.producto-favorito');
      productoDiv.style.animation = 'slideOutUp 0.4s ease-in forwards';
      
      setTimeout(() => {
        location.reload();
      }, 400);
    });
  });
});

// Función para añadir al carrito (si no existe)
if (typeof addToCart === 'undefined') {
  window.addToCart = function(id, name, price, image) {
    alert(`Producto ${name} añadido al carrito`);
    // Aquí iría la lógica real para añadir al carrito
  };
}
  </script>

  <div id="ai-chat-container">
    <div id="ai-chat-header">
      <span>🛍️ Asistente ClothEasy</span>
      <button id="close-chat">×</button>
    </div>
    <div id="ai-chat-messages"></div>
    <div class="chat-input-container">
      <input type="text" id="ai-chat-input" placeholder="Escribe tu pregunta...">
      <button id="ai-send-btn">Enviar</button>
    </div>
  </div>

  <button id="open-chat">
    <i class="fas fa-robot"></i>
  </button>

  <script src="../assets/js/chatbot.js"></script>
  <!-- <script src="../assets/js/buy.js"></script> -->

</body>
</html>