document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.mercantecLogo').addEventListener('click', function (e) {
        window.location.href = "/";
    });

    document.getElementById('logout').addEventListener('click', function (e) {
        const url = `http://taskm8/com/main.php?action=myProfile`;
    
        // Crear una instancia de la clase clsAjax
        const AJAX = new clsAjax(url, null);
    
        // Evento que procesará la respuesta después de que se haya recibido
        function handleLogoutResponse() {
            const response = AJAX.response;
            XML = AJAX.responseXML;
            // console.log("Texto bruto:", AJAX.response);
            // const xmlDoc = xml.responseXML;
            console.log("XML texto bruto:", xmlDoc);

            const lists = xmlDoc.getElementsByTagName("list");
            let txt = " <form>\
                            <label for='username'>Username: </label>\
                            <input type='text' id='username'>\
                            <label for='email'>Email: </label>\
                            <input type='text' id='email'>\
                        </form>";

            txt = 
    
            // Remover el listener tras ejecutarse
            document.removeEventListener("__CALL_RETURNED__", handleLogoutResponse);
        }
    
        // Asegúrate de eliminarlo antes por si quedó enganchado
        document.removeEventListener("__CALL_RETURNED__", handleLogoutResponse);
        document.addEventListener("__CALL_RETURNED__", handleLogoutResponse);
    
        AJAX.Call();
    });
});