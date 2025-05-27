
document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modalLogin");
    const btnAbrir = document.getElementById("btnAbrirModal");
    const btnCerrar = document.querySelector(".cerrar");
    const loginForm = document.getElementById("loginForm");
    const errorMsg = document.getElementById("errorLogin");

    btnAbrir.addEventListener("click", (e) => {
        e.preventDefault();
        modal.style.display = "flex";
        errorMsg.style.display = "none";
        document.getElementById("usuario").focus();
    });

    btnCerrar.addEventListener("click", () => {
        modal.style.display = "none";
    });

    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });

    loginForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(loginForm);

        try {
            const response = await fetch(loginForm.action, {
                method: "POST",
                body: formData
                // No pongas headers: fetch ya gestiona correctamente el Content-Type
            });
    
            const text = await response.text(); // porque ahora no esperas JSON
    
            // Puedes usar esto si el backend imprime algo como "OK" o "ERROR"
            if (text.includes("OK")) {
                //window.location.href = "index.php";
            } else {
                errorMsg.textContent = text || "Inicio de sesión fallido.";
            }
    
        } catch (error) {
            console.error("Error:", error);
            errorMsg.textContent = "Error del servidor.";
        }
/*
        const usuario = document.getElementById("usuario").value.trim();
        const password = document.getElementById("contra").value.trim();

        try {
            const respuesta = await fetch("../backend/login.php", {
                method: "POST",
                headers: {
                    //"Content-Type": "application/json"
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `correo=${encodeURIComponent(usuario)}&contra=${encodeURIComponent(password)}`
            });

            const datos = await respuesta.json();

            if (datos.success) {
                // Redirigir si el login fue exitoso
                window.location.href = "index.php"; // o tu página principal
            } else {
                // Mostrar mensaje de error
                errorMsg.style.display = "block";
                errorMsg.textContent = datos.message || "Login fallido.";
                document.getElementById("password").value = "";
            }

        } catch (error) {
            console.error("Error en la solicitud:", error);
            errorMsg.style.display = "block";
            errorMsg.textContent = "Error del servidor.";
        }*/
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && modal.style.display === "flex") {
            modal.style.display = "none";
        }
    });
});
