document.addEventListener('DOMContentLoaded', () => {
    let cart = {
        items: [],
        total: 0
    };

    const cartIcon = document.getElementById('cartIcon');
    const cartContainer = document.getElementById('cartContainer');
    const closeCart = document.getElementById('closeCart');
    const overlay = document.getElementById('overlay');
    const cartItemsContainer = document.getElementById('cartItems');
    const cartCountElement = document.getElementById('cartCount');
    const cartTotalElement = document.getElementById('cartTotal');
    const checkoutBtn = document.getElementById('checkoutBtn');

    function loadCart() {
        const savedCart = localStorage.getItem('cart');
        if (savedCart) {
            cart = JSON.parse(savedCart);
            updateCartUI();
        }
    }

    function saveCart() {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    function openCart() {
        cartContainer.classList.add('active');
        overlay.classList.add('active');
    }

    function closeCartFunc() {
        cartContainer.classList.remove('active');
        overlay.classList.remove('active');
    }

    window.addToCart = function(id, name, price, image, description) {
        const existingItemIndex = cart.items.findIndex(item => item.id === id);

        if (existingItemIndex !== -1) {
            cart.items[existingItemIndex].quantity++;
        } else {
            cart.items.push({ id, name, price, image, description, quantity: 1 });
        }

        updateCartTotal();
        updateCartUI();
        saveCart();
        openCart();
    };

    window.removeFromCart = function(id) {
        cart.items = cart.items.filter(item => item.id !== id);
        updateCartTotal();
        updateCartUI();
        saveCart();
    };

    window.increaseQuantity = function(id) {
        const item = cart.items.find(item => item.id === id);
        if (item) {
            item.quantity++;
            updateCartTotal();
            updateCartUI();
            saveCart();
        }
    };

    window.decreaseQuantity = function(id) {
        const item = cart.items.find(item => item.id === id);
        if (item && item.quantity > 1) {
            item.quantity--;
        } else if (item) {
            cart.items = cart.items.filter(i => i.id !== id);
        }
        updateCartTotal();
        updateCartUI();
        saveCart();
    };

    function updateCartTotal() {
        cart.total = cart.items.reduce((total, item) => total + (item.price * item.quantity), 0);
    }

    function updateCartUI() {
        cartCountElement.textContent = cart.items.reduce((count, item) => count + item.quantity, 0);
        cartTotalElement.textContent = cart.total.toFixed(2);
        cartItemsContainer.innerHTML = '';

        cart.items.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'cart-item';
            itemElement.innerHTML = `
                <img src="${item.image}" alt="${item.name}">
                <div class="item-details">
                    <div class="item-title">${item.name}</div>
                    <div class="item-price">$${item.price}</div>
                    <div class="item-controls">
                        <div class="quantity-btn" onclick="decreaseQuantity(${item.id})">
                            <span class="material-symbols-outlined">remove_circle</span>
                        </div>
                        <span class="item-quantity">${item.quantity}</span>
                        <div class="quantity-btn" onclick="increaseQuantity(${item.id})">
                            <span class="material-symbols-outlined">add_circle</span>
                        </div>
                        <div class="remove-item" onclick="removeFromCart(${item.id})">
                            <span class="material-symbols-outlined">delete</span>
                        </div>
                    </div>
                </div>`;
            cartItemsContainer.appendChild(itemElement);
        });
    }

    cartIcon.addEventListener("click", () => {
        cartContainer.classList.add("active");
        overlay.classList.add("active");
        cartIcon.classList.add("hidden");
    });

    closeCart.addEventListener("click", () => {
        cartContainer.classList.remove("active");
        overlay.classList.remove("active");
        cartIcon.classList.remove("hidden");
    });

    overlay.addEventListener("click", () => {
        cartContainer.classList.remove("active");
        overlay.classList.remove("active");
        cartIcon.classList.remove("hidden");
    });

    document.getElementById('checkoutBtn').addEventListener('click', () => {
        window.location.href = 'Resumencompra.html';
    });

    // Modal de compra
    const finalizarBtn = document.getElementById("finalizarCompraBtn");
    if (finalizarBtn) {
        finalizarBtn.addEventListener("click", () => {
            const modal = document.getElementById("modalCompra");
            const resumenDiv = document.getElementById("resumenCompra");

            if (cart.items.length === 0) {
                alert("Tu carrito está vacío.");
                return;
            }

            resumenDiv.innerHTML = "";
            cart.items.forEach(item => {
                const resumenItem = document.createElement("p");
                resumenItem.textContent = `${item.name} x${item.quantity} - $${(item.price * item.quantity).toFixed(2)}`;
                resumenDiv.appendChild(resumenItem);
            });

            const totalElement = document.createElement("h4");
            totalElement.textContent = `Total a pagar: $${cart.total.toFixed(2)}`;
            resumenDiv.appendChild(totalElement);

            modal.style.display = "block";
        });
    }

    // Cargar el carrito al inicio
    loadCart();

    // Filtro de categorías
    function filtrarCategoria(categoria) {
        const productos = document.querySelectorAll('.producto');
        const botones = document.querySelectorAll('.categorias-menu button');

        productos.forEach(producto => {
            producto.style.display = (categoria === 'todos' || producto.classList.contains(categoria)) ? 'block' : 'none';
        });

        botones.forEach(boton => boton.classList.remove('activo'));
        const botonActivo = document.querySelector(`.categorias-menu button[onclick*="${categoria}"]`);
        if (botonActivo) {
            botonActivo.classList.add('activo');
        }
    }

    filtrarCategoria('todos'); // marcar todos por defecto
});
