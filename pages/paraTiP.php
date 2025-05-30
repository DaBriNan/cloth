<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Para Ti | ClothEasy</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/logoFinal.png">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="../assets/estilos/paraTi.css" />
    <link rel="stylesheet" href="clotheS.css" />
</head>
<body>
    <!-- Header - Tu estructura original -->
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
        
        <a href="../pages/logIn.php" class="user" id="login-btn">
            <img src="../assets/img/user.png" alt="login" class="imagen">
        </a>

        <!-- Sección de usuario logueado (tu código original) -->
        <div class="user-logged-section" id="user-logged-section" style="display: none;">
            <div class="user-info">
                <img src="../assets/img/user.png" alt="usuario" class="user-avatar">
                <span class="user-name-display" id="user-name-display">Usuario</span>
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
    </header>

  <br>
     
    <!-- Filtros de categoría -->
    <nav class="categorias-menu">
        <button class="activo" onclick="filtrarCategoria('todos')">Todos</button>
        <button onclick="filtrarCategoria('hombre')">Hombre</button>
        <button onclick="filtrarCategoria('mujer')">Mujer</button>
        <button onclick="filtrarCategoria('nino')">Niño</button>
    </nav>

    <!-- Carrito flotante -->
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

    <!-- Grid de productos - EXACTAMENTE como en productos dinámico -->
    <main id="productosContainer" class="productos-grid">
        <div class="producto hombre" data-id="1">
            <img class="img-Chapter" src="../assets/img/amiri camisa.webp" alt="chapter">
            <h3>Camisa Amiri</h3>
            <p>$ 230</p>
            <p>TALLA M</p>
            <p class="descripcion">DESCRIPCION: Camisa de alta calidad con diseño único y detalles premium</p>
            <button class="btn-megusta" data-id="1" data-name="Camisa Amiri" data-price="230" data-image="../assets/img/amiri camisa.webp">❤️</button>
            <button onclick="addToCart(1, 'Camisa Amiri', '230', '../assets/img/amiri camisa.webp')">🛒 Añadir</button>
        </div>

        <div class="producto hombre" data-id="2">
            <img class="img-Chapter" src="../assets/img/saint.webp" alt="chapter">
            <h3>Playera Estampada</h3>
            <p>$ 350</p>
            <p>TALLA S</p>
            <p class="descripcion">DESCRIPCION: Playera con estampado exclusivo y materiales de primera calidad</p>
            <button class="btn-megusta" data-id="2" data-name="Playera Estampada" data-price="350" data-image="../assets/img/saint.webp">❤️</button>
            <button onclick="addToCart(2, 'Playera Estampada', '350', '../assets/img/saint.webp')">🛒 Añadir</button>
        </div>

        <div class="producto hombre" data-id="3">
            <img class="img-Chapter" src="../assets/img/mezclilla squared.webp" alt="chapter">
            <h3>Chamarra DSQUARED2</h3>
            <p>$ 590</p>
            <p>TALLA M</p>
            <p class="descripcion">DESCRIPCION: Chamarra de mezclilla premium con acabados de lujo y diseño moderno</p>
            <button class="btn-megusta" data-id="3" data-name="Chamarra DSQUARED2" data-price="590" data-image="../assets/img/mezclilla squared.webp">❤️</button>
            <button onclick="addToCart(3, 'Chamarra DSQUARED2', '590', '../assets/img/mezclilla squared.webp')">🛒 Añadir</button>
        </div>

        <div class="producto mujer" data-id="4">
            <img class="img-Chapter" src="../assets/img/sandro.webp" alt="chapter">
            <h3>Chamarra Sandro</h3>
            <p>$ 450</p>
            <p>TALLA L</p>
            <p class="descripcion">DESCRIPCION: Elegante chamarra Sandro con corte femenino y detalles sofisticados</p>
            <button class="btn-megusta" data-id="4" data-name="Chamarra Sandro" data-price="450" data-image="../assets/img/sandro.webp">❤️</button>
            <button onclick="addToCart(4, 'Chamarra Sandro', '450', '../assets/img/sandro.webp')">🛒 Añadir</button>
        </div>

        <div class="producto nino" data-id="5">
            <img class="img-Chapter" src="../assets/img/playera cdg.webp" alt="chapter">
            <h3>Playera CDG</h3>
            <p>$ 100</p>
            <p>TALLA S</p>
            <p class="descripcion">DESCRIPCION: Playera Comme des Garçons con el icónico logo de corazón</p>
            <button class="btn-megusta" data-id="5" data-name="Playera CDG" data-price="100" data-image="../assets/img/playera cdg.webp">❤️</button>
            <button onclick="addToCart(5, 'Playera CDG', '100', '../assets/img/playera cdg.webp')">🛒 Añadir</button>
        </div>

        <div class="producto mujer" data-id="6">
            <img class="img-Chapter" src="../assets/img/playera casa blanca.webp" alt="chapter">
            <h3>Playera Casa Blanca</h3>
            <p>$ 325</p>
            <p>TALLA S</p>
            <p class="descripcion">DESCRIPCION: Playera blanca minimalista con diseño clean y corte perfecto</p>
            <button class="btn-megusta" data-id="6" data-name="Playera Casa Blanca" data-price="325" data-image="../assets/img/playera casa blanca.webp">❤️</button>
            <button onclick="addToCart(6, 'Playera Casa Blanca', '325', '../assets/img/playera casa blanca.webp')">🛒 Añadir</button>
        </div>

        <div class="producto mujer" data-id="7">
            <img class="img-Chapter" src="../assets/img/sueter all saints.webp" alt="chapter">
            <h3>Suéter All Saints</h3>
            <p>$ 500</p>
            <p>TALLA M</p>
            <p class="descripcion">DESCRIPCION: Suéter de la marca británica All Saints con tejido de alta calidad</p>
            <button class="btn-megusta" data-id="7" data-name="Suéter All Saints" data-price="500" data-image="../assets/img/sueter all saints.webp">❤️</button>
            <button onclick="addToCart(7, 'Suéter All Saints', '500', '../assets/img/sueter all saints.webp')">🛒 Añadir</button>
        </div>

        <div class="producto hombre" data-id="8">
            <img class="img-Chapter" src="../assets/img/playera palm.webp" alt="chapter">
            <h3>Playera Palm Angels</h3>
            <p>$ 299</p>
            <p>TALLA L</p>
            <p class="descripcion">DESCRIPCION: Playera Palm Angels con gráficos únicos y estilo streetwear premium</p>
            <button class="btn-megusta" data-id="8" data-name="Playera Palm Angels" data-price="299" data-image="../assets/img/playera palm.webp">❤️</button>
            <button onclick="addToCart(8, 'Playera Palm Angels', '299', '../assets/img/playera palm.webp')">🛒 Añadir</button>
        </div>

        <div class="producto mujer" data-id="9">
            <img class="img-Chapter" src="../assets/img/denim.webp" alt="chapter">
            <h3>Hoodie Denim Tears</h3>
            <p>$ 600</p>
            <p>TALLA 32</p>
            <p class="descripcion">DESCRIPCION: Sudadera con capucha de la marca Denim Tears con diseño artístico único</p>
            <button class="btn-megusta" data-id="9" data-name="Hoodie Denim Tears" data-price="600" data-image="../assets/img/denim.webp">❤️</button>
            <button onclick="addToCart(9, 'Hoodie Denim Tears', '600', '../assets/img/denim.webp')">🛒 Añadir</button>
        </div>

        <div class="producto mujer" data-id="10">
            <img class="img-Chapter" src="../assets/img/Legacy Camisa.webp" alt="chapter">
            <h3>Camisa Legacy</h3>
            <p>$ 750</p>
            <p>TALLA S</p>
            <p class="descripcion">DESCRIPCION: Camisa Legacy con corte elegante y materiales premium para ocasiones especiales</p>
            <button class="btn-megusta" data-id="10" data-name="Camisa Legacy" data-price="750" data-image="../assets/img/Legacy Camisa.webp">❤️</button>
            <button onclick="addToCart(10, 'Camisa Legacy', '750', '../assets/img/Legacy Camisa.webp')">🛒 Añadir</button>
        </div>
    </main>

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

    <!-- Scripts -->
    <script src="../assets/js/log.js"></script>
    <script src="../assets/js/buy.js"></script>
    <script src="../assets/js/scrpitInicio.js"></script>
    <script src="../assets/js/meGusta.js"></script>
    <script src="../assets/js/favs.js"></script>

    <script>
        // Tu script de verificación de sesión original
        document.addEventListener('DOMContentLoaded', function() {
            checkUserSession();
            initializeFavorites();
        });

        function checkUserSession() {
            fetch('../backend/check_session.php')
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

        function showLoggedInUser(user) {
            const loginBtn = document.getElementById('login-btn');
            const userSection = document.getElementById('user-logged-section');
            const userNameDisplay = document.getElementById('user-name-display');
            
            if (loginBtn) loginBtn.style.display = 'none';
            if (userSection) userSection.style.display = 'flex';
            if (userNameDisplay) userNameDisplay.textContent = user.name || 'Usuario';
            
            console.log('Usuario logueado:', user.name);
        }

        function showLoggedOutUser() {
            const loginBtn = document.getElementById('login-btn');
            const userSection = document.getElementById('user-logged-section');
            
            if (loginBtn) loginBtn.style.display = 'inline-flex';
            if (userSection) userSection.style.display = 'none';
            
            console.log('Usuario no logueado');
        }

        // Función de filtrado de categorías
        function filtrarCategoria(categoria) {
            const productos = document.querySelectorAll('.producto');
            const filterBtns = document.querySelectorAll('.categorias-menu button');
            
            // Actualizar botones activos
            filterBtns.forEach(btn => btn.classList.remove('activo'));
            event.target.classList.add('activo');
            
            // Filtrar productos
            productos.forEach(producto => {
                if (categoria === 'todos' || producto.classList.contains(categoria)) {
                    producto.style.display = 'block';
                } else {
                    producto.style.display = 'none';
                }
            });
        }

        // Función para agregar al carrito
        function addToCart(id, name, price, image) {
            console.log('Agregando al carrito:', {id, name, price, image});
            
            // Efecto visual del botón
            const btn = event.target;
            const originalText = btn.innerHTML;
            btn.innerHTML = '✓ Agregado';
            btn.style.background = 'linear-gradient(45deg, #4CAF50, #45a049)';
            
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.background = '';
            }, 2000);
        }

        // Inicializar favoritos - EXACTAMENTE como en productos
        function initializeFavorites() {
            const botonesMeGusta = document.querySelectorAll(".producto .btn-megusta");
            let favoritos = JSON.parse(localStorage.getItem("meGusta")) || [];

            botonesMeGusta.forEach(btn => {
                const productId = btn.getAttribute('data-id');
                const isFavorito = favoritos.some(item => item.id === productId);

                // Establecer estado inicial del botón
                btn.classList.toggle("activo", isFavorito);

                btn.addEventListener("click", () => {
                    const product = {
                        id: productId,
                        name: btn.getAttribute('data-name'),
                        price: parseFloat(btn.getAttribute('data-price')),
                        image: btn.getAttribute('data-image')
                    };

                    let favoritos = JSON.parse(localStorage.getItem("meGusta")) || [];
                    const index = favoritos.findIndex(item => item.id === productId);

                    if (index === -1) {
                        // Añadir a favoritos
                        favoritos.push(product);
                        btn.classList.add("activo");
                        console.log("Producto añadido a favoritos:", product.name);
                    } else {
                        // Quitar de favoritos
                        favoritos.splice(index, 1);
                        btn.classList.remove("activo");
                        console.log("Producto removido de favoritos:", product.name);
                    }

                    localStorage.setItem("meGusta", JSON.stringify(favoritos));
                });
            });
        }
    </script>
</body>
</html>