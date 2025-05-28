document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.mercantecLogo').addEventListener('click', function (e) {
        window.location.href = "/";
    });

    document.getElementById('logout').addEventListener('click', function (e) {
        e.preventDefault();
        const url = `http://taskm8/com/main.php?action=logout`;
    
        // Crear una instancia de la clase clsAjax
        const AJAX = new clsAjax(url, null);

        // Evento que procesará la respuesta después de que se haya recibido
        function handleLogoutResponse() {
            const response = AJAX.response;
            if(!response || !response.trim().startsWith("<")) return;
            if (response == "Logout successful.") {
                alert(response);
                window.location.href = "/";
            } else {
                alert("Logout failed: " + response);
            }
    
            // Remover el listener tras ejecutarse
            document.removeEventListener("__CALL_RETURNED__", handleLogoutResponse);
        }
    
        // Asegúrate de eliminarlo antes por si quedó enganchado
        document.removeEventListener("__CALL_RETURNED__", handleLogoutResponse);
        document.addEventListener("__CALL_RETURNED__", handleLogoutResponse);
    
        AJAX.Call();
    });
});

function deleteCookie(name) {
    document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return;
}

function convertDate(date) {
  const [y, m, d] = date.split("-");
  newdate = `${d}-${m}-${y}`;
  return newdate;
}