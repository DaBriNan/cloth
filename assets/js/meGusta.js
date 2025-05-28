document.addEventListener("DOMContentLoaded", () => {
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
            } else {
                // Quitar de favoritos
                favoritos.splice(index, 1);
                btn.classList.remove("activo");
            }

            localStorage.setItem("meGusta", JSON.stringify(favoritos));
        });
    });


    
});

