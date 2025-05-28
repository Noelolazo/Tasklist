var XML;
document.addEventListener('DOMContentLoaded', function () {
  const url = `http://taskm8/com/main.php?action=myProfile`;

  const AJAX = new clsAjax(url, null);

  const container = document.getElementById('displayInfo');
  function loadMyProfile() {
  const xmlDoc = AJAX.responseXML;
  XML = xmlDoc;

  console.log("XML texto bruto:", xmlDoc);

  const users = XML.getElementsByTagName("user");
  if (!users || users.length === 0) {
    console.error("No se encontró ningún nodo <user> en el XML.");
    return;
  }

  const user = users[0];

  const usernameNode = user.getElementsByTagName("username")[0];
  const emailNode = user.getElementsByTagName("email")[0];

  if (!usernameNode || !emailNode) {
    console.error("Faltan los nodos <username> o <email> dentro de <user>");
    return;
  }

  const username = usernameNode.textContent;
  const email = emailNode.textContent;

  let txt = `
    <label for='username'>Username: </label>
    <p id='username'>${username}</p>
    <label for='email'>Email: </label>
    <p id='email'>${email}</p>
  `;

  const container = document.getElementById('displayInfo');
  container.innerHTML = txt;

  document.removeEventListener("__CALL_RETURNED__", loadMyProfile);
}

  document.removeEventListener("__CALL_RETURNED__", loadMyProfile);
  document.addEventListener("__CALL_RETURNED__", loadMyProfile);

  AJAX.Call();
});