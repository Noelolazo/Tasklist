document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("loginForm");

    form?.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        const email = formData.get("email");
        const password = formData.get("passwd");

        // Construir la URL para la solicitud GET
        const url = `http://taskm8/com/main.php?action=login&email=${(email)}&passwd=${(password)}`;

        // Crear una instancia de la clase clsAjax
        const AJAX = new clsAjax(url, null);

        // Evento que procesará la respuesta después de que se haya recibido
        function handleLoginResponse() {
            const response = AJAX.response;

            if (response == "Login correct") {
                alert(response);
                window.location.href = "/";
            } else {
                alert("Login failed: " + response);
            }

            // Remover el listener tras ejecutarse
            document.removeEventListener("__CALL_RETURNED__", handleLoginResponse);
        }

        // Asegúrate de eliminarlo antes por si quedó enganchado
        document.removeEventListener("__CALL_RETURNED__", handleLoginResponse);
        document.addEventListener("__CALL_RETURNED__", handleLoginResponse);

        AJAX.Call();
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const connection = getCookie("connection");
    const form = document.getElementById("loginForm");
    const message = document.getElementById("login-message");
    if (connection) {
        // Ocultar formulario y mostrar mensaje
        if (form) form.style.display = "none";
        if (message) {
            message.textContent = "There's already a session connected.";
            message.style.display = "block";
        }
    }
});