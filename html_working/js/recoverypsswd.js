document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("psswdRecForm");
    
    form?.addEventListener("submit", function (e) {
        e.preventDefault();
        let fail = false;
        const formData = new FormData(form);
        const action = formData.get("action");
        const email = formData.get("email");
        let url = null;

        // Construir la URL para la solicitud GET
        if (action == "recoverypassEmail") {
            url = `http://taskm8/com/main.php?action=${(action)}&email=${(email)}`;
        } else if (action == "recoverypassPIN") {
            const pin = formData.get("PIN");
            const passwd = formData.get("psswd");
            const passwdR = formData.get("psswdR");
            if (passwd == passwdR) {
                url = `http://taskm8/com/main.php?action=${(action)}&email=${(email)}&pin=${(pin)}&passwd=${(passwd)}`
            } else {
                alert("Passwords do not match. ");
                fail = true;
            }

        }

        if (!fail) {
            // Crear una instancia de la clase clsAjax
            const AJAX = new clsAjax(url, null);

            // Evento que procesará la respuesta después de que se haya recibido
            function handleLoginResponse() {
                const response = AJAX.response;

                if (action == "recoverypassEmail") {
                    if (response != "The recover password mail has been sent.") {
                        alert("Recovery failed: " + response);
                    } else {
                        form.submit();
                    }
                } else if (action == "recoverypassPIN") {
                    if (response != "Change of password correct.") {
                        alert("Recovery failed: " + response);
                    } else {
                        alert (response);
                        window.location.href = "/login";

                    }
                }

                document.removeEventListener("__CALL_RETURNED__", handleLoginResponse);
            }

            // Asegúrate de eliminarlo antes por si quedó enganchado
            document.removeEventListener("__CALL_RETURNED__", handleLoginResponse);
            document.addEventListener("__CALL_RETURNED__", handleLoginResponse);

            AJAX.Call();
        } else {
            console.log("NO ENTRA");
        }

    });
});