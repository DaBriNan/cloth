// Importa las librerías necesarias
require('dotenv').config(); // Carga las variables de entorno del archivo .env
const express = require('express'); // Framework para crear el servidor web
const { GoogleGenerativeAI } = require('@google/generative-ai'); // SDK oficial de Google para Gemini
const cors = require('cors'); // Middleware para habilitar CORS (Cross-Origin Resource Sharing)

// Inicializa la aplicación Express
const app = express();
// Define el puerto donde escuchará tu servidor.
// Usa el puerto de entorno si está disponible (para despliegue), de lo contrario, usa el 3000.
const port = process.env.PORT || 3000;

// Configura la instancia de GoogleGenerativeAI con tu clave API.
// ¡La clave se obtiene de process.env.GEMINI_API_KEY que viene del archivo .env!
const genAI = new GoogleGenerativeAI(process.env.GEMINI_API_KEY);

// Obtiene el modelo de Gemini que vas a usar.
// 'gemini-pro' es un buen modelo de propósito general.
// Si necesitas más velocidad y es compatible con tu región, podrías probar 'gemini-1.5-flash'.
const model = genAI.getGenerativeModel({ model: "gemini-1.5-flash" });

// --- Middlewares ---
// Habilita CORS: Permite que tu frontend (que corre en un puerto diferente) pueda hacer peticiones a este backend.
// En desarrollo, '*' es conveniente. Para producción, reemplázalo con el dominio exacto de tu frontend.
app.use(cors({
    origin: '*', // Por ejemplo, 'http://localhost:5500' si usas Live Server
    methods: 'GET,HEAD,PUT,PATCH,POST,DELETE',
    credentials: true,
    optionsSuccessStatus: 204
}));
// Permite que Express entienda el formato JSON en las solicitudes (request bodies).
app.use(express.json());

// --- Ruta de la API para el Chatbot ---
// Define una ruta POST en '/chat' que recibirá los mensajes del frontend.
app.post('/chat', async (req, res) => {
    // Extrae el mensaje del usuario del cuerpo de la solicitud JSON.
    const userMessage = req.body.message;

    // Validación básica del mensaje
    if (!userMessage) {
        return res.status(400).json({ error: 'El mensaje de usuario es requerido.' });
    }

    // ****** EL "PROMPT" PARA GEMINI ******
    // Este es el corazón de cómo Gemini responderá.
    // Aquí le dices a Gemini quién es, cuál es su propósito y le proporcionas toda la información
    // sobre tus productos para que pueda responder de manera relevante.
    // ¡Asegúrate de que esta información sea precisa y detallada sobre tu tienda "ClothEasy"!
    const productInfoPrompt = `
Eres un asistente de ventas amigable y experto de la tienda online "ClothEasy". Tu misión es ayudar a los usuarios con preguntas sobre nuestros productos de ropa, tallas, precios y envíos. Responde de forma clara, concisa y profesional. Si no encuentras la información específica en los datos que te proporciono, por favor, indica amablemente que no tienes esa información y sugiere visitar la sección de productos en la web o contactar a soporte si necesitan algo más específico.

**Información Detallada de Productos y Políticas de ClothEasy:**

* **Tallas Generales Disponibles:**
    * Ropa (general, como sudaderas, chaquetas): XS, S, M, L, XL.
    * Jeans/Pantalones: Tallas mexicanas 24, 26, 28, 30, 32, 34, 36, 38.
    * Camisas/Blusas/Playeras: Tallas S, M, L, XL, XXL.
    * Calzado: Tallas de la 23 a la 29 (MXN).
    * Tallas Específicas de Accesorios: Adulto, Talla 3 (para sombreros).

* **Lista de Productos con Precios y Tallas Específicas:**
    * **Bufanda gris:** Precio: $230 MXN. Talla: Adulto. Categoría: Hombre.
    * **Sombrero Café:** Precio: $350 MXN. Talla: 3. Categoría: Hombre.
    * **Conjunto Nike Azul:** Precio: $590 MXN. Talla: G. Categoría: Hombre.
    * **Tenis Puma:** Precio: $450 MXN. Talla: 24. Categoría: Mujer.
    * **Sudadera Blanca:** Precio: $100 MXN. Talla: S. Categoría: Niño.
    * **Pantalones Rotos:** Precio: $325 MXN. Talla: 32. Categoría: Mujer.
    * **Tines Rosas:** Precio: $50 MXN. Talla: 23. Categoría: Mujer.
    * **Corbata Negra:** Precio: $25 MXN. Talla: Adulto. Categoría: Hombre.
    * **Short Guinda:** Precio: $100 MXN. Talla: S. Categoría: Mujer.
    * **Chamarra Negra:** Precio: $750 MXN. Talla: S. Categoría: Mujer.
    * **Jersey Real Madrid (Edición Especial):** Precio: $499 MXN. Tallas disponibles: S, M, L, XL. (Se encuentra en el carrusel de la página principal).
    * **Polo Ralph (Clásico):** Precio: $349 MXN. Material: 100% Algodón piqué. Colores disponibles: Azul marino, blanco, negro, rojo. (Se encuentra en el carrusel de la página principal).
    * **Playera Under Armour (Deportiva):** Precio: $279 MXN. Material: Mezcla de poliéster de alto rendimiento, tecnología de secado rápido (absorbe el sudor). (Se encuentra en el carrusel de la página principal).
    * **Jeans Clásicos (Denim Stretch):** Precio: $699 MXN. Material: Denim stretch (98% algodón, 2% elastano). Ajuste: Skinny/Slim fit. (Se encuentra en el carrusel de la página principal).
    * **Hoodie Nike (Blanca):** Precio: $559 MXN. Material: Felpa suave y cómoda (mezcla de algodón y poliéster). Tallas: XS a XL. (Se encuentra en el carrusel de la página principal).

* **Política de Envíos:**
    * **Tiempo de entrega:** De 3 a 5 días hábiles. Este tiempo aplica para todo el territorio nacional (México).
    * **Costo de envío:** El costo varía según la región y el peso del paquete. Se calcula automáticamente al finalizar la compra en el checkout.
    * **Oferta de Envío Gratuito:** Actualmente, tenemos una promoción de **envío GRATIS** en todas las compras superiores a **$1,497 MXN**. Esta oferta es por tiempo limitado (vigente por las próximas 48 horas desde tu compra) y se aplica automáticamente en el carrito.

* **Otras Políticas:**
    * **Devoluciones:** Aceptamos devoluciones dentro de los 30 días posteriores a la compra, siempre y cuando el producto esté sin usar y con sus etiquetas originales. El reembolso se procesará al método de pago original. Consulta nuestra política de devoluciones completa en el sitio web.
    * **Métodos de Pago:** Aceptamos tarjetas de crédito/débito (Visa, MasterCard, American Express), PayPal y pagos con OXXO Pay.
    
    * **Funciones de la pagina:**
    * Además de poder comprar en nuestro sitio, la gente también puede vender sus prendas dirigiéndose a la pestaña ventas.

Ahora, por favor, responde a la siguiente pregunta del usuario basándote estrictamente en la información proporcionada anteriormente. Si no encuentras la respuesta, indica que no tienes esa información y sugiere visitar la sección de productos o contactar a soporte: "${userMessage}"
`;

    try {
        // Llama a la API de Gemini para generar contenido basado en el prompt.
        const result = await model.generateContent(productInfoPrompt);
        // Obtiene la respuesta del modelo.
        const response = await result.response;
        // Extrae el texto de la respuesta.
        const text = response.text();

        // ****** CAMBIO CLAVE AQUÍ: Usamos 'response' en lugar de 'reply' ******
        // Envía la respuesta de Gemini de vuelta al frontend como JSON.
        res.json({ response: text }); // CAMBIO A 'response'
    } catch (error) {
        // Si ocurre un error al comunicarse con Gemini, lo registra y envía un mensaje de error.
        console.error('Error al comunicarse con Gemini:', error);
        res.status(500).json({ error: "Lo siento, tengo problemas para responder en este momento. Por favor, intenta de nuevo más tarde." }); // Cambié 'reply' a 'error' para ser más descriptivo en caso de fallo.
    }
});

// --- Inicio del Servidor ---
// Hace que el servidor empiece a escuchar las solicitudes en el puerto definido.
app.listen(port, () => {
    console.log(`Servidor backend escuchando en http://localhost:${port}`);
});