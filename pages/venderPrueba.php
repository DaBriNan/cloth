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

   

    
<script src="../assets/js/vender.js"></script>
<script src="../assets/js/scrpitInicio.js"></script>

</body>
</html>
