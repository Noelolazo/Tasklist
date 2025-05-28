//tasklist
function opencreatetasklist() {
  document.getElementById('popupcreatetasklist').style.display = 'block';
  document.getElementById('overlay').style.display = 'block';
}

function closecreatetasklist() {
  document.getElementById('popupcreatetasklist').style.display = 'none';
  document.getElementById('overlay').style.display = 'none';
}


//task
function opencreatetask(id = 0) {
  
  if (id != 0){
    const container = document.querySelector(".inputHiddenId");
    container.setAttribute('value',$id);
    container.setAttribute('id','tlist_id')
  }

  document.getElementById('popupcreatetask').style.display = 'block';
  document.getElementById('overlay').style.display = 'block';
}

function closecreatetask() {
  document.getElementById('popupcreatetask').style.display = 'none';
  document.getElementById('overlay').style.display = 'none';
}

// task popup
function showMiniTaskDetail(task_id) {
  task = getTask(task_id);
  var title = task.getElementsByTagName("title")[0].textContent;
  var description = task.getElementsByTagName("description")[0].textContent;
  var location = task.getElementsByTagName("location")[0].textContent;
  document.getElementById('popupTaskDetailMini').style.display = 'block';
  document.getElementById("miniTaskTitle").value = title;
  document.getElementById("miniTaskDescription").value = description;
  document.getElementById("miniTaskLocation").value = location;
}

function editMiniTask() {
  document.getElementById("miniTaskTitle").removeAttribute("readonly");
  document.getElementById("miniTaskDescription").removeAttribute("readonly");
  document.getElementById("tlocation").removeAttribute("readonly");
}

function submitMiniTaskDetail(event) {
  event.preventDefault();
  const title = document.getElementById("miniTaskTitle").value;
  const description = document.getElementById("miniTaskDescription").value;
  const location = document.getElementById("miniTaskLocation").value;
  alert(`Submitted: ${title} - ${description} - ${location}`);
  closeMiniTaskPopup();
}

function closeMiniTaskPopup() {
  document.getElementById("popupTaskDetailMini").style.display = "none";
}

// list popup
function showMiniListDetail(list_id) {
  list = getList(list_id);

  var title = list.getElementsByTagName("title")[0].textContent;
  var description = list.getElementsByTagName("description")[0].textContent;

  document.getElementById('popupListDetailMini').style.display = 'block';
  document.getElementById("miniListTitle").value = title;
  document.getElementById("miniListDescription").value = description;
}

function editMiniList() {
  document.getElementById("miniListkTitle").removeAttribute("readonly");
  document.getElementById("miniListDescription").removeAttribute("readonly");
}

function submitMiniListDetail(event) {
  event.preventDefault();
  const title = document.getElementById("miniListTitle").value;
  const description = document.getElementById("miniListDescription").value;
  alert(`Submitted: ${title} - ${description}`);
  closeMiniPopup();
}

function closeMiniListPopup() {
  document.getElementById("popupListDetailMini").style.display = "none";
}

function seeMiniPartners() {
  alert("Viewing partners...");
}

