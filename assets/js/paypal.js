// paypal.js
document.addEventListener("DOMContentLoaded", () => {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const total = cart.reduce((sum, item) => sum + item.price, 0) + 5.99; 

    paypal.Buttons({
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: total.toFixed(2), // Total a cobrar
                        currency_code: "MXN" // O "MXN" si manejas pesos
                    },
                    description: "Compra en Tienda de Ropa"
                }]
            });
        },
        onApprove: (data, actions) => {
            return actions.order.capture().then(details => {
                alert(`Pago completado por ${details.payer.name.given_name}`);
                //  redirigir a una página 
                window.location.href = "/gracias.html";
            });
        },
        onError: (err) => {
            console.error("Error en el pago:", err);
            alert("Ocurrió un error al procesar el pago.");
        }
    }).render("#paypal-button-container"); 
});