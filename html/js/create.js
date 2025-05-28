var AJAXCreate;
function submitnewTask() {
  event.preventDefault();
  const list_id = document.getElementsById("tlist_id").value;
  const title = document.getElementById("ttitle").value;
  const description = document.getElementById("tdescription").value;
  const location = document.getElementById("tlocation").value;
  const deadline = document.getElementById("tdeadline").value;
  // const deadline = convertDate(date);

  if (list_id != 0) {
    const url = `http://taskm8/com/main.php?action=newTask&list_id${list_id}&title${title}&description${description}&location${location}&deadline${deadline}`;
    const AJAXCreate = new clsAJAX(url, null);
    AJAXCreate.Call();
  } else {
    localStorage.setItem("ttitle", title);
    localStorage.setItem("tdescription", description);
    localStorage.setItem("tlocation", location);
    localStorage.setItem("tdeadline", deadline);

    showlocalstorage();
  }

}

function submitnewList() {
  event.preventDefault();
  const form = document.getElementById("newlistform");

  alert(form);
  const formData = new FormData(form);
  const ltitle = formData.get("ltitle");
  const ldescription = formData.get("ldescription");
  const lparticipants = formData.get("lparticipants");
  const lgroups = formData.get("inviteGroups");
  const ttitle = localStorage.getItem("ttitle");
  const tdescription = localStorage.getItem("tdescription");
  const tlocation = localStorage.getItem("tlocation");
  const tdeadline = localStorage.getItem("tdeadline");



  // Construir la URL para la solicitud GET
  const url = `http://taskm8/com/main.php?action=newlist&ltitle=${(ltitle)}&ldescription=${(ldescription)}&lparticipants=${(lparticipants)}&lgroups=${(lgroups)}&ttitle=${(ttitle)}&tdescription=${(tdescription)}&tlocation=${(tlocation)}&tdeadline=${(tdeadline)}`;

  // Crear una instancia de la clase clsAJAXCreate
  AJAXCreate = new clsAJAX(url, null);



  // Evento que procesará la respuesta después de que se haya recibido
  // Asegúrate de eliminarlo antes por si quedó enganchado
  document.removeEventListener("__CALL_RETURNED__", handleResponse);
  document.addEventListener("__CALL_RETURNED__", handleResponse);

  AJAXCreate.Call();

}

function handleResponse() {
  const response = AJAXCreate.response;

  if (response == "0") {
    alert(response);
    window.location.href = "/app/myTasks";
  } else {
    alert("List couldn't be created: " + response);
  }

  // Remover el listener tras ejecutarse
  document.removeEventListener("__CALL_RETURNED__", handleResponse);
}


function showlocalstorage() {

  const title = localStorage.getItem("ttitle");
  const description = localStorage.getItem("tdescription");
  const date = localStorage.getItem("tdeadline");


  alert(`Submitted: ${title} - ${description} - ${date}`);
}