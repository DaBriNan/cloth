<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Para Ti | ClothEasy</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/logoFinal.png">
    <link rel="stylesheet" href="../assets/estilos/paraTi.css" />
    <link rel="stylesheet" href="clotheS.css">

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="assets/img/faviconClo.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
</head>
<body>

    <!-- barra-menu -->
    <header class="barra-menu">
        <a href="../index.html">
            <img src="../assets/img/logoFinal.png" class="imgMenu" alt="Inicio" />
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
        <!-- <div class="meGusta">
            <img src="../assets/img/Heart.png" alt="meGusta" class="imagen" />
        </div> -->
        <a href="../pages/logIn.php" class="user">
            <img src="../assets/img/user.png" alt="login" class="imagen">
        </a>
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

    <!-- barra-horizontal -->


    <nav class="categorias-menu">
        <button onclick="filtrarCategoria('Todo')">Todo</button>
        <button onclick="filtrarCategoria('Chamarras')">Chamarras</button>
        <button onclick="filtrarCategoria('Camisas')">Camisas</button>
        <button onclick="filtrarCategoria('Calzado')">Calzado</button>
        <button onclick="filtrarCategoria('Accesorios')">Accesorios</button>
      </nav>
 
            <main id="productosContainer" class="productos-grid">
    
                <div class="producto hombre">
                  <div class="imagen-contenedor">
                    <img src="../assets/img/amiri camisa.webp" alt="Playera Amiri">
                  </div>
                  <h3>Camisa Amiri</h3>
                  <p>$230 MXN</p>
                  <p>Talla: M</p>
                  <button class="btn-megusta" data-id="1" data-name="Playera Amiri" data-price="230" data-image="/assets/img/amiri camisa.webp">❤️</button>
                  <button onclick="addToCart(1,'Playera Amiri', 230, '/assets/img/amiri camisa.webp')">Comprar</button>
                </div>
            
                
                <div class="producto hombre">
                  <div class="imagen-contenedor">
                    <img src="../assets/img/saint.webp" alt="Playera Estampada">
                  </div>
                  <h3>Playera Estampada</h3>
                  <p>$350 MXN</p>
                  <p>Talla: S</p>
                  <button class="btn-megusta" data-id="2" data-name="Playera Estampada" data-price="350" data-image="/assets/img/saint.webp">❤️</button>
                  <button onclick="addToCart(2,'Playera Estampada', 350, '/assets/img/saint.webp')">Comprar</button>
                </div>
            
                
                <div class="producto hombre">
                  <div class="imagen-contenedor">
                    <img src="../assets/img/mezclilla squared.webp" alt="Chamarra Mezclilla">
                  </div>
                  <h3>Chamarra DSQUARED2</h3>
                  <p>$590 MXN</p>
                  <p>Talla: M</p>
                  <button class="btn-megusta" data-id="3" data-name="Chamarra DSQUARED" data-price="590" data-image="/assets/img/mezclilla squared.webp">❤️</button>
                  <button onclick="addToCart(3,'Chamarra DSQUARED', 590, '/assets/img/mezclilla squared.webp')">Comprar</button>
                </div>
            
                
                <div class="producto mujer">
                  <div class="imagen-contenedor">
                    <img src="../assets/img/sandro.webp" alt="Sandro">
                  </div>
                  <h3>Chamarra Sandro</h3>
                  <p>$450 MXN</p>
                  <p>Talla: L</p>
                  <button class="btn-megusta" data-id="4" data-name="Sandro" data-price="450" data-image="/assets/img/sandro.webp">❤️</button>
                  <button onclick="addToCart(4,'Sandro', 450, '/assets/img/sandro.webp')">Comprar</button>
                </div>
            
                
                <div class="producto nino">
                  <div class="imagen-contenedor">
                    <img src="../assets/img/playera cdg.webp" alt="Playera CDG">
                  </div>
                  <h3>Playera CDG</h3>
                  <p>$100 MXN</p>
                  <p>Talla: S</p>
                  <button class="btn-megusta" data-id="5" data-name="Playera CDG" data-price="100" data-image="/assets/img/playera cdg.webp">❤️</button>
                  <button onclick="addToCart(5,'Playera CDG', 100, '/assets/img/playera cdg.webp')">Comprar</button>
                </div>
            
                
                <div class="producto mujer">
                  <div class="imagen-contenedor">
                    <img src="../assets/img/playera casa blanca.webp" alt="Casa Blanca">
                  </div>
                  <h3>Playera Casa Blanca</h3>
                  <p>$325 MXN</p>
                  <p>Talla: S</p>
                  <button class="btn-megusta" data-id="6" data-name="Playera Casa Blanca" data-price="325" data-image="/assets/img/playera casa blanca.webp">❤️</button>
                  <button onclick="addToCart(6,'Playera Casa Blanca', 325, '/assets/img/playera casa blanca.webp')">Comprar</button>
                </div>
            
                
                <div class="producto mujer">
                  <div class="imagen-contenedor">
                    <img src="../assets/img/sueter all saints.webp" alt="All Saints">
                  </div>
                  <h3>Suéter All Saints</h3>
                  <p>$500 MXN</p>
                  <p>Talla: M</p>
                  <button class="btn-megusta" data-id="7" data-name="All Saints" data-price="50" data-image="/assets/img/sueter all saints.webp">❤️</button>
                  <button onclick="addToCart(7,'All Saints', 50, '/assets/img/sueter all saints.webp')">Comprar</button>
                </div>
            
                
                <div class="producto hombre">
                  <div class="imagen-contenedor">
                    <img src="../assets/img/playera palm.webp" alt="Playera Palm">
                  </div>
                  <h3>Playera Palm Angels</h3>
                  <p>$299 MXN</p>
                  <p>Talla: L</p>
                  <button class="btn-megusta" data-id="8" data-name="Playera Palm" data-price="25" data-image="/assets/img/playera palm.webp">❤️</button>
                  <button onclick="addToCart(8,'Playera Palm', 25, '/assets/img/playera palm.webp')">Comprar</button>
                </div>
            
                
                <div class="producto mujer">
                  <div class="imagen-contenedor">
                    <img src="../assets/img/denim.webp" alt="Denim">
                  </div>
                  <h3>Hoodie Denim Tears</h3>
                  <p>$600 MXN</p>
                  <p>Talla: 32</p>
                  <button class="btn-megusta" data-id="9" data-name="Denim" data-price="100" data-image="/assets/img/denim.webp">❤️</button>
                  <button onclick="addToCart(9,'Denim', 100, '/assets/img/denim.webp')">Comprar</button>
                </div>
            
                
                <div class="producto mujer">
                  <div class="imagen-contenedor">
                    <img src="../assets/img/Legacy Camisa.webp" alt="Camisa Legacy">
                  </div>
                  <h3>Camisa Legacy</h3>
                  <p>$750 MXN</p>
                  <p>Talla: S</p>
                  <button class="btn-megusta" data-id="10" data-name="Camisa" data-price="750" data-image="/assets/img/Legacy Camisa.webp">❤️</button>
                  <button onclick="addToCart(10,'CamisaLegacy', 750, '/assets/img/Legacy Camisa.webp')">Comprar</button>
                </div>
            
                <div class="product-list" id="productos-container">
                </div>
            </main>
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
        
   
                
      
    <script src="../assets/js/log.js"></script>
    <script src="../assets/js/buy.js"></script>
    <script src="../assets/js/scrpitInicio.js"></script>

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

</body>
</html>
