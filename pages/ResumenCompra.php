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

    <title>ClothEeasy</title>

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
       
        <a href="../pages/login.html" class="user">
            <img src="../assets/img/user.png" alt="login" class="imagen">
        </a>
         <?php
        session_start();
        if(isset($_SESSION["Id"])){
            echo $_SESSION["Nom"];
        }
     ?>
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

       
        
        <div id="resumenContainer" class="contenedor"> </div>


        <div class="compra-wrapper">
            <div id="resumenContainer" class="contenedor">
            </div>
          <section class="datos-envio">
            <h2>Datos de Envío</h2>
            <form id="formularioEnvio">
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input 
                  type="text" 
                  id="nombre" 
                  name="nombre" 
                  value="<?= isset($_SESSION['Nom']) ? htmlspecialchars($_SESSION['Nom']) : '' ?>" 
                  required>
              </div>
          
              <div class="form-group">
                <label for="direccion">Dirección</label>
                <input 
                  type="text" 
                  id="direccion" 
                  name="direccion" 
                  value="<?= isset($_SESSION['Dir']) ? htmlspecialchars($_SESSION['Dir']) : '' ?>" 
                  required>
              </div>

              <div class="form-group">
                <label for="ciudad">Ciudad</label>
                <input 
                  type="text" 
                  id="ciudad" 
                  name="ciudad" 
                  value="<?= isset($_SESSION['Ciu']) ? htmlspecialchars($_SESSION['Ciu']) : '' ?>" 
                  required>
              </div>
          
              <div class="form-group">
                <label for="estado">Estado</label>
                <input 
                  type="text" 
                  id="estado" 
                  name="estado" 
                  value="<?= isset($_SESSION['Edo']) ? htmlspecialchars($_SESSION['Edo']) : '' ?>" 
                  required>
              </div>
          
              <div class="form-group">
                <label for="codigoPostal">Código Postal</label>
                <input 
                  type="text" 
                  id="codigoPostal" 
                  name="codigoPostal" 
                  value="<?= isset($_SESSION['Cp']) ? htmlspecialchars($_SESSION['Cp']) : '' ?>" 
                  required>
              </div>
          
              <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" required>
              </div>
          
              <button type="submit" class="btn-enviar">Finalizar Pedido</button>
              <div id="paypal-button-container"></div>
            </form>
          </section>
          
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

</body>
</html>
