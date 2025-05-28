document.addEventListener('DOMContentLoaded', () => {
    const cart = JSON.parse(localStorage.getItem('cart')) || { items: [], total: 0 };
    
    const carritoContainer = document.getElementById('carritoContainer'); // O donde quieras mostrarlo
    carritoContainer.innerHTML = "";
  
    cart.items.forEach(item => {
      const div = document.createElement('div');
      div.textContent = `${item.name} x${item.quantity} - $${(item.price * item.quantity).toFixed(2)}`;
      carritoContainer.appendChild(div);
    });
  });
  

  document.getElementById('formularioEnvio').addEventListener('submit', function(e) {
    e.preventDefault();
    const items = showItems()
    // alert(items)
    eliminarProductos(items)
    //clearCart()
    
    //alert("¡Gracias por tu compra! Tu pedido ha sido registrado.");
    /*$.ajax({
        type: 'POST',
        url: '../../app/backend/comprar.php',
        data: { func: 'deleteChapter', id: "2" },
        success: function (data) {
            alert("aqui")
            //window.location.href = "../../backend/comprar.php";
        },
        error: function (error) {
            //console.error('Error al intentar eliminar el capítulo:', error);
            alert("aca")
        }
    });*/
    this.reset();
    
  });
  


document.addEventListener('DOMContentLoaded', () => {
    const resumenContainer = document.getElementById('resumenContainer');

    const savedCart = localStorage.getItem('cart');
    if (!savedCart) {
        resumenContainer.innerHTML = '<p>No hay productos en el carrito.</p>';
        return;
    }

    let cart = JSON.parse(savedCart);

    function renderResumen() {
        resumenContainer.innerHTML = ''; // limpiar

        cart.items.forEach((item, index) => {
            const itemDiv = document.createElement('div');
            itemDiv.className = 'resumen-item';
            itemDiv.style.display = 'flex';
            itemDiv.style.alignItems = 'center';
            itemDiv.style.gap = '10px';
            itemDiv.style.marginBottom = '20px';
            itemDiv.style.backgroundColor = 'white';
            itemDiv.style.padding = '10px';
            itemDiv.style.borderRadius = '10px';
            itemDiv.style.boxShadow = '0 2px 6px rgba(0,0,0,0.1)';

            itemDiv.innerHTML = `
                <img src="${item.image}" alt="${item.name}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                <div style="flex: 1;">
                    <h3 style="margin-bottom: 5px;">${item.name}</h3>
                    <p style="margin-bottom: 5px;">Precio: $${item.price}</p>
                    <p style="margin-bottom: 5px;">Cantidad: ${item.quantity}</p>
                    <p style="font-weight: bold;">Subtotal: $${item.price * item.quantity}</p>
                </div>
                <span class="material-symbols-outlined remove-item" style="cursor: pointer; color: crimson; font-size: 30px;" data-index="${index}">
                    delete
                </span>
            `;
            resumenContainer.appendChild(itemDiv);
        });

        // Mostrar total
        const totalDiv = document.createElement('div');
        totalDiv.className = 'resumen-total';
        totalDiv.style.textAlign = 'right';
        totalDiv.style.marginTop = '20px';
        totalDiv.innerHTML = `<h2>Total a pagar: $${cart.total}</h2>`;
        resumenContainer.appendChild(totalDiv);

        attachRemoveListeners();
    }

    function attachRemoveListeners() {
        const removeButtons = document.querySelectorAll('.remove-item');
        removeButtons.forEach(button => {
            button.addEventListener('click', () => {
                const index = button.getAttribute('data-index');
                const item = cart.items[index];

                // Actualizamos total
                cart.total -= item.price * item.quantity;

                // Quitamos el producto
                cart.items.splice(index, 1);

                // Si el carrito queda vacío, eliminamos también
                // if (cart.items.length === 0) {
                //     localStorage.removeItem('cart');
                //     resumenContainer.innerHTML = '<p>No hay productos en el carrito.</p>';
                //     return;
                // }

                // Guardamos cambios
                localStorage.setItem('cart', JSON.stringify(cart));

                // Volvemos a renderizar
                renderResumen();
            });
        });
    }

    renderResumen();
});


function eliminarProductos(ids) {
    $.ajax({
        type: 'POST',
        url: '../backend/comprar.php',
        data: { func: 'deleteChapter', id: JSON.stringify(ids) },
        success: function (data) {
            alert("¡Gracias por tu compra! Tu pedido ha sido registrado.")
            clearCart()
            //window.location.href = "../produPrueba.php";
        },
        error: function (error) {
            //console.error('Error al intentar eliminar el capítulo:', error);
            alert("Error al intentar hacer la compra, intenta más tarde")
        }
    });
}