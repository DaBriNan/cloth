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
    document.addEventListener("DOMContentLoaded", function() {
      const contenedor = document.getElementById("listaFavoritos");
      let favoritos = JSON.parse(localStorage.getItem("meGusta")) || [];

      if (favoritos.length === 0) {
        contenedor.innerHTML = '<div class="empty-favorites">No has marcado ningún producto como favorito.</div>';
        return;
      }

      contenedor.innerHTML = favoritos.map(producto => `
        <div class="producto" data-id="${producto.id}">
          <img src="${producto.image}" alt="${producto.name}">
          <div class="producto-info">
            <h3>${producto.name}</h3>
            <p>$${producto.price} MXN</p>
          </div>
          <div class="producto-actions">
            <button class="btn-megusta" data-id="${producto.id}">❤️</button>

            <button class="btn-comprar" onclick="addToCart('${producto.id}', 
            '${producto.name}', ${producto.price}, '${producto.image}', '${producto.description}')">Comprar</button>

            
          </div>
        </div>
      `).join("");

      // Manejar eliminación de favoritos
      document.querySelectorAll(".btn-megusta").forEach(btn => {
        btn.addEventListener("click", function() {
          const productId = this.getAttribute('data-id');
          favoritos = favoritos.filter(p => p.id !== productId);
          localStorage.setItem("meGusta", JSON.stringify(favoritos));
          location.reload();
        });
      });
    });

    // Función simulada para añadir al carrito
    //window.addToCart = function(id, name, price, image) {
      //alert(`Producto ${name} añadido al carrito`);
      // Aquí iría la lógica real para añadir al carrito
    //};
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