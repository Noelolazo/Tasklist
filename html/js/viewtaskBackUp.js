var XML;
document.addEventListener('DOMContentLoaded', function () {
  const params = new URLSearchParams(window.location.search);
  const date = params.get('date');
  
  const url = `http://taskm8/com/main.php?action=viewtask&date=${(date)}`;
  
  const AJAX = new clsAjax(url, null);
  
  const container = document.querySelector(".taskListParentDiv");

  formatDate = convertDate(date);
  document.querySelector('.dateButton').textContent = formatDate;
  
  
  function printList() {
    const xmlDoc = AJAX.responseXML;
    XML = AJAX.responseXML;
    // console.log("Texto bruto:", AJAX.response);
    // const xmlDoc = xml.responseXML;
    console.log("XML texto bruto:", xmlDoc);

    const lists = xmlDoc.getElementsByTagName("list");
    let txt = "";

    for (let i = 0; i < lists.length; i++) {
      const list_id = lists[i].getElementsByTagName("id")[0].textContent;
      const title = lists[i].getElementsByTagName("title")[0].textContent;

      txt += `<div class='taskListAndName'>
                <div class='taskListTitle' onclick="showMiniListDetail('${list_id}')"> 
                  <span>${title}</span>
                </div>
                <div class='taskList'>`;

      // Pasamos el nodo <tasks> a printTask()
      const tasksNode = lists[i].getElementsByTagName("tasks")[0];
      if (tasksNode) {
        txt += printTask(tasksNode);
      }

      txt += `</div></div>`;
    }
    container.innerHTML = txt;
    document.removeEventListener("__CALL_RETURNED__", printList);

  }

  document.removeEventListener("__CALL_RETURNED__", printList);
  document.addEventListener("__CALL_RETURNED__", printList);

  AJAX.Call();
});

function printTask(tasksNode) {
  const tasks = tasksNode.getElementsByTagName("task");
  let txt = "";

  for (let i = 0; i < tasks.length; i++) {
    const title = tasks[i].getElementsByTagName("title")[0].textContent;
    const task_id = tasks[i].getElementsByTagName("task_id")[0].textContent;
    txt += `<div class='singleTask' id='${task_id}' onclick="showMiniTaskDetail('${task_id}')">
              <div class='checkboxDiv'>
                <input type='checkbox' class='checkboxClass'>
              </div>
              <span>${title}</span>
            </div>`;
  }

  return txt;
}

function getTask(task_id) {
  const tasks = XML.getElementsByTagName("task");
  for (let i = 0; i < tasks.length; i++) {
    if (task_id == tasks[i].getElementsByTagName("task_id")[0].textContent){
      return tasks[i];
    }
  }
}

function getList(list_id) {
  const lists = XML.getElementsByTagName("list");
  for (let i = 0; i < lists.length; i++) {
    if (list_id == lists[i].getElementsByTagName("id")[0].textContent){
      return lists[i];
    }
  }
}