<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Taskmanager - MyTasks</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/clsAjax.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/popups.js"></script>
    <script src="/js/create.js"></script>
    <script src="/js/mytasks.js"></script>

</head>

<body>

    <div class="topbar">
        <div class="imageDiv">
            <img src="/rscrs/img/logo.svg" class="mercantecLogo">
        </div>
        <div class="notification">
            <div class="circle">
                <a href="/app/invitations" class="invitationsButton"></a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <a href="/landpage">LANDPAGE</a>
            <a href="/app/calendar">CALENDAR</a>
            <a href="/app/myTasks">MY TASKS</a>
            <div style="flex-grow: 0.985;"></div>
            <a href="/app/groups">GROUPS</a>
            <a href="/app/myProfile">MY PROFILE</a>
            <a href="#" id="logout">LOG OUT</a>
        </div>

        <div class="mainCreateTask">
            <div class="parentDiv">
                <div class="dateCreateDiv">
                    <div class="dateButtonDiv">
                        <button class="dateButton">DATE</button>
                    </div>
                    <div class="createListDiv">
                        <button onclick="opencreatetasklist()" class="createListButton">CREATE TASK LIST</button>
                    </div>
                </div>

                <div class="wideAndNarrowDiv">
                    <div class="whideDiv">
                        <div class="taskListParentDiv"></div>
                    </div>
                    <div class="narrowDiv">
                        <div class="createSingleTask"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!--popupcreatetasklist -->
    <div id="overlay" onclick="closePopup()"></div>
    <div id="popupcreatetasklist" style="display:none; z-index=">
        <h2>New List</h2>
        <form onsubmit="submitnewList(event)" id="newlistform">
            <input type="hidden" name="action" value="newtask">
            <label>Title:
                <input type="text" name="ltitle" id="ltitle" required>
            </label>
            <label>Description (optional):
                <textarea name="ldescription" id="ldescription"></textarea>
            </label>
            <label>Add task:<br>
                <button type="button" onclick="opencreatetask()">Add task</button><br>
            </label>
            <label>Invite users:
                <input id="lparticipants" type="text" name="lparticipants[]" size="250"><br>
            </label>
            <label>Invite groups:
                <input type="text" name="lgroups" id="lgroups">
            </label>
            <br>
            <button type="submit" onclick="closecreatetasklist()">Accept</button>
            <button type="button" onclick="closecreatetasklist()">Cancel</button>
        </form>
    </div>

    <!-- Task -->
    <div id="popupcreatetask" style="display:none">
        <h2>New Task</h2>
        <form onsubmit="submitnewTask(event)">
            <label>Title:
                <input type="text" name="ttitle" id="ttitle" required>
            </label>
            <label>Description:
                <input type="text" name="tdescription" id="tdescription">
            </label>
            <label>Location:
                <input type="text" name="tlocation" id="tlocation">
            </label>
            <div class="date-container">
                <label for="fecha" class="fecha-label">Select the deadline:</label>
                <input type="date" id="tdeadline" name="tdeadline" required>
            </div>
            <br>
            <button type="submit" onclick="closecreatetask()">Accept</button>
            <button type="button" onclick="closecreatetask()">Cancel</button>
        </form>
    </div>

    <!-- Task Detail Popup -->
    <div id="popupTaskDetailMini" style="display: none;">
        <form class="popup-mini" onsubmit="submitMiniTaskDetail(event)">
            <h2>Task Detail</h2>

            <label for="miniTaskTitle">Title:</label>
            <input type="text" id="miniTaskTitle" name="ttitle" readonly>

            <label for="miniTaskDescription">Description:</label>
            <textarea id="miniTaskDescription" name="tdescription" rows="4" readonly></textarea>

            <label>Location:
                <input type="text" name="miniTaskLocation" id="miniTaskLocation" readonly>
            </label>

            <div class="popup-mini-buttons">
                <button type="button" onclick="editMiniTask()">Edit</button>
                <button type="submit" class="accept">Accept</button>
                <button type="button" class="cancel" onclick="closeMiniTaskPopup()">Cancel</button>
            </div>
        </form>
    </div>

    <!-- List Detail Popup -->
    <div id="popupListDetailMini" style="display: none;">
        <form class="popup-mini" onsubmit="submitMiniListDetail(event)">
            <h2>List Detail</h2>

            <label for="miniListTitle">Title:</label>
            <input type="text" id="miniListTitle" name="ltitle" readonly>

            <label for="miniListDescription">Description:</label>
            <textarea id="miniListDescription" name="ldescription" rows="4" readonly></textarea>

            <div class="popup-mini-buttons">
                <button type="button" onclick="editMiniList()">Edit</button>
                <button type="submit" class="accept">Accept</button>
                <button type="button" class="cancel" onclick="closeMiniListPopup()">Cancel</button>
            </div>
        </form>
    </div>

</body>

</html>