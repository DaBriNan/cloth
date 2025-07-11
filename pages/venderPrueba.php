<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/img/logoFinal.png">
    <link rel="stylesheet"  href="../assets/estilos/vender.css" >
    <link rel="stylesheet" href="clotheS.css">
    
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Vender</title>
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
    </a> -->
     <!-- <?php
        session_start();
        if(isset($_SESSION["Id"])){
            echo $_SESSION["Nom"];
        }
     ?>  -->
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

<!-- Agregar este script antes del </body> -->

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





 <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<h1><span class="azul">Publicar</span> <span class="celeste">Producto</span></h1>

<body>
    <main>
         <section class="formulario">
      <h2>Detalles del Producto</h2>
      <form id="formularioProducto" action="../backend/vender.php"  method="POST" enctype="multipart/form-data">

        <label>Subir Imagen:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required />

        <label>Nombre del Producto:</label>
        <input type="text" id="nombre" name="producto" placeholder="Ej. Sudadera Palm Angels" required />

        <label>Precio:</label>
        <input type="number" id="precio" name="precio" placeholder="$" required min="1" />

        <label>Talla:</label>
        <input type="text" id="talla" name="talla_id" placeholder="1=S, 2=M, 3=L, 4=XL, 5=XS, 6= 22MX..." required />

        <label>Categoría:</label>
        <select id="categoria" name="categoria_id" required>
          <option value="">Selecciona una categoría</option>
          <option value="1">Hombre</option>
          <option value="2">Mujer</option>
          <option value="3">Niño</option>
        </select>

        <label>Descripción:</label>
        <textarea id="descripcion" name="description" placeholder="Describe el producto..." required></textarea>

        <button type="submit" name="submit">Publicar</button>
      </form>
    </section>

        
        <section class="resumen">
            <h1>Vista Previa</h1>
            <div class="preview">
                <img src="" alt="Vista previa del producto" >
                <p><strong>Precio:</strong> <span id="precioPreview">$0.00</span></p>
                <p><strong>Talla:</strong> <span id="tallaPreview">N/A</span></p>
            </div>
        </section>
    </main>


    <script>
       $(document).ready(function() {
    // Manejador del evento submit del formulario
    $('formularioProducto').on('submit', function(e) {
        e.preventDefault(); // Prevenir el envío tradicional del formulario
        
        // Crear un objeto FormData para manejar los datos del formulario
        var formData = new FormData(this);
        formData.append('action', 'crearProducto'); // Agregar acción específica

        $.ajax({
            url: '../backend/vender.php', // Ruta a tu script PHP
            type: 'POST',
            data: formData,
            processData: false, // Importante para FormData
            contentType: false, // Importante para FormData
            success: function(response) {
                alert(response);
                try {
                    var data = JSON.parse(response);
                    if(data.success) {
                        
                        alert('Producto publicado con éxito!');
                        window.location.href = "produPrueba.php"; // Redirigir
                    } else {
                        alert('Error: ' + data.message);
                    }
                } catch(e) {
                    console.error('Error parsing JSON:', e, response);
                    alert('Ocurrió un error inesperado');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error AJAX:', status, error);
                alert('Error al conectar con el servidor');
            }
        });
    });

    // Actualizar vista previa en tiempo real
    $('#nombre, #precio, #talla').on('input', function() {
        $('#nombrePreview').text($('#nombre').val() || 'Nombre del producto');
        $('#precioPreview').text('$' + ($('#precio').val() || '0.00'));
        $('#tallaPreview').text($('#talla').val() || 'N/A');
    });

    // Vista previa de la imagen
    $('#imagen').on('change', function(e) {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.preview img').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
});
    </script>

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
   

    
<script src="../assets/js/vender.js"></script>
<script src="../assets/js/scrpitInicio.js"></script>


</body>
</html>
