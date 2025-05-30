
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
     
    <a href="../pages/venderPrueba.php" class="vender"><span class="texto">Vender</span></a>
    <a href="../pages/produPrueba.php" class="comprar"><span class="textoc">Comprar</span></a>
    <a href="../pages/paraTiP.php" class="paraTi"><span class="textop">Para ti</span></a>
    <a href="../pages/meGusta.php" class="meGusta">
            <img src="../assets/img/Heart.png" alt="meGusta" class="imagen">
        </a>

    <!-- <a href="../pages/login.php" class="user">
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

<br>

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
        //esto se implementó con Chris
        // $(document).ready(function () {
        //     //getChapters();
            
        //   $.ajax({
        //       type: 'GET',
        //       url: '../backend/prueba.php?myInfo=getChapters',
        //       success: function (data) {
        //          //alert(data)
        //           const apiResult = JSON.parse(data)
        //           const container = document.getElementById('productosContainer');

        //           apiResult.forEach((result, idx) => {
                    
        //             //adaptar a tu codigo
        //               const content = `
        //               <div class="producto" data-id=${result.idCatalogo}>
        //               <img class ="img-Chapter" src=../assets/img/${result.rutaImagen} alt="chapter">
        //                 <h3> ${result.nombreProducto} </h3>
        //                 <p> $ ${result.precioP}</p>
        //                   <p> TALLA ${result.tallaP}</p>
        //                   <p class="descripcion"> DESCRIPCION: ${result.descripcionDeProducto}</p>
        //                   <button class="btn-megusta" 
        //                     data-id="${result.idCatalogo}"
        //                     data-name="${result.nombreProducto}"
        //                     data-price="${result.precioP}"
        //                     data-image="../assets/img/${result.rutaImagen}">
        //                 ❤️
        //             </button>
        //                   <button onclick="addToCart(${result.idCatalogo}, '${result.nombreProducto}', '${result.precioP}', '../assets/img/${result.rutaImagen}')">
        //                   🛒 Añadir</button>
        //               </div>
        //               `;

        //               container.innerHTML += content;
        //           })
        //            initializeFavorites();
        //       }
        //   });
           
        // });
        // Función para filtrar categorías
    // Función para filtrar categorías
function filtrarCategoria(categoria) {
    const productos = document.querySelectorAll('.producto');
    const filterBtns = document.querySelectorAll('.categorias-menu button');
    
    // Actualizar botones activos
    filterBtns.forEach(btn => btn.classList.remove('activo'));
    event.target.classList.add('activo');
    
    // Filtrar productos
    productos.forEach(producto => {
        if (categoria === 'todos') {
            producto.style.display = 'block';
        } else {
            // Verificar si el producto tiene la clase de categoría
            if (producto.classList.contains(categoria)) {
                producto.style.display = 'block';
            } else {
                producto.style.display = 'none';
            }
        }
    });
}

// Función para convertir categoria_id a nombre de categoría
function convertirCategoria(categoriaId) {
    switch(categoriaId) {
        case '1':
            return 'mujer';
        case '2':
            return 'hombre';
        case '3':
            return 'nino';
        default:
            return 'hombre'; // Por defecto
    }
}

$(document).ready(function () {
    $.ajax({
        type: 'GET',
        url: '../backend/prueba.php?myInfo=getChapters',
        success: function (data) {
            const apiResult = JSON.parse(data);
            const container = document.getElementById('productosContainer');

            apiResult.forEach((result, idx) => {
                // Convertir categoria_id a nombre de categoría
                const categoria = convertirCategoria(result.categoriaP);
                
                // 🔍 DEBUG: Ver qué categorías se están asignando
                console.log(`Producto: ${result.nombreProducto}`);
                console.log(`categoria_id desde BD: ${result.categoriaP}`);
                console.log(`Categoría convertida: ${categoria}`);
                console.log('---');
                
                // Generar HTML con la clase de categoría
                const content = `
                <div class="producto ${categoria}" data-id="${result.idCatalogo}">
                    <img class="img-Chapter" src="../assets/img/${result.rutaImagen}" alt="chapter">
                    <h3>${result.nombreProducto}</h3>
                    <p>$ ${result.precioP}</p>
                    <p>TALLA ${result.tallaP}</p>
                    <p class="descripcion">DESCRIPCION: ${result.descripcionDeProducto}</p>
                    <button class="btn-megusta" 
                        data-id="${result.idCatalogo}"
                        data-name="${result.nombreProducto}"
                        data-price="${result.precioP}"
                        data-image="../assets/img/${result.rutaImagen}">
                        ❤️
                    </button>
                    <button onclick="addToCart(${result.idCatalogo}, '${result.nombreProducto}', '${result.precioP}', '../assets/img/${result.rutaImagen}')">
                        🛒 Añadir
                    </button>
                </div>
                `;

                container.innerHTML += content;
            });
            
            initializeFavorites();
            
            // Establecer "Todos" como activo por defecto
            const primerBoton = document.querySelector('.categorias-menu button');
            if (primerBoton) {
                primerBoton.classList.add('activo');
            }
            
            // 🔍 DEBUG: Ver todas las clases que se generaron
            setTimeout(() => {
                const productos = document.querySelectorAll('.producto');
                console.log('=== RESUMEN DE PRODUCTOS ===');
                productos.forEach(producto => {
                    console.log(`Clases del producto: ${producto.className}`);
                });
            }, 1000);
        }
    });
});

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