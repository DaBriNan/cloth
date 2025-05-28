
<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="../assets/estilos/productos.css" />
     <link rel="stylesheet"  href="clotheS.css" >
    <!-- <link rel="stylesheet"  href="productos.css" > -->
    <title>Productos</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/logoFinal.png">
    <style>
        .home-down {
            margin-top: 30vw;
        }
    </style>
</head>

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
    <a href="../pages/login.php" class="user">
        <img src="../assets/img/user.png" alt="login" class="imagen">
    </a>
    <?php
        session_start();
        if(isset($_SESSION["Id"])){
            echo $_SESSION["Nom"];
        }
     ?>
  </header>

<body>


  <nav class="categorias-menu">
    <button onclick="filtrarCategoria('todos')">Todos</button>
    <button onclick="filtrarCategoria('hombre')">Hombre</button>
    <button onclick="filtrarCategoria('mujer')">Mujer</button>
    <button onclick="filtrarCategoria('nino')">Niño</button>
  </nav>

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


    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <script src="../assets/js/productos.js"></script>
        <script src="../assets/js/buy.js"></script>
    <!-- <script src="productos.js"></script> -->
    <!-- <script src="buy.js"></script> -->


 

        <main id="productosContainer" class="productos-grid">
        </main>


    <script>
        $(document).ready(function () {
            //getChapters();
            
          $.ajax({
              type: 'GET',
              url: '../backend/prueba.php?myInfo=getChapters',
              success: function (data) {
                 //alert(data)
                  const apiResult = JSON.parse(data)
                  const container = document.getElementById('productosContainer');

                  apiResult.forEach((result, idx) => {
                    
                    //adaptar a tu codigo
                      const content = `
                      <div class="producto" data-id=${result.categoriaP}>
                      <img class ="img-Chapter" src=../assets/img/${result.rutaImagen} alt="chapter">
                        <h3> ${result.nombreProducto} </h3
                        <p> ${result.precioP}</p>
                          <p> ${result.tallaP}</p>
                          <p class="descripcion">${result.descripcionDeProducto}</p>
                          <button class="btn-megusta" >❤️</button>
                          <button onclick="addToCart(${result.categoriaP}, '${result.nombreProducto}', '${result.precioP}', '../assets/img/${result.rutaImagen}')">Comprar</button>
                      </div>
                      `;

                      container.innerHTML += content;
                  })
              }
          });
           
        });
    </script>

</body>

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

</html>