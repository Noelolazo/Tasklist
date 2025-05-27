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
                    <div class="dateButtonDiv"><button onclick="showMiniTaskDetail()" class="dateButton">DATE</button>
                    </div>
                    <div class="createListDiv"><button onclick="opencreatetasklist()" class="createListButton">CREATE
                            TASK LIST</button></div>
                </div>

                <div class="wideAndNarrowDiv">
                    <div class="whideDiv">
                        <div class="taskListParentDiv">

                            <div class="taskListAndName">

                                <div class="taskListTitle">
                                    <span>TITLE</span>
                                </div>

                                <div class="taskList">
                                    <div class="singleTask">
                                        <div class="checkboxDiv">
                                            <input type="checkbox" class="checkboxClass"></input>
                                        </div>
                                    </div>
                                    <div class="singleTask">
                                        <div class="checkboxDiv">
                                            <input type="checkbox" class="checkboxClass"></input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="taskListAndName">

                                <div class="taskListTitle">
                                    <span>TITLE</span>
                                </div>

                                <div class="taskList">
                                    <div class="singleTask">
                                        <div class="checkboxDiv">
                                            <input type="checkbox" class="checkboxClass"></input>
                                        </div>
                                    </div>
                                    <div class="singleTask">
                                        <div class="checkboxDiv">
                                            <input type="checkbox" class="checkboxClass"></input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="taskListAndName">

                                <div class="taskListTitle">
                                    <span>TITLE</span>
                                </div>

                                <div class="taskList">
                                    <div class="singleTask">
                                        <div class="checkboxDiv">
                                            <input type="checkbox" class="checkboxClass"></input>
                                        </div>
                                    </div>
                                    <div class="singleTask">
                                        <div class="checkboxDiv">
                                            <input type="checkbox" class="checkboxClass"></input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="taskListAndName">

                                <div class="taskListTitle">
                                    <span>TITLE</span>
                                </div>

                                <div class="taskList">
                                    <div class="singleTask">
                                        <div class="checkboxDiv">
                                            <input type="checkbox" class="checkboxClass"></input>
                                        </div>
                                    </div>
                                    <div class="singleTask">
                                        <div class="checkboxDiv">
                                            <input type="checkbox" class="checkboxClass"></input>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="taskListAndName">

                                <div class="taskListTitle">
                                    <span>TITLE</span>
                                </div>

                                <div class="taskList">
                                    <div class="singleTask">
                                        <div class="checkboxDiv">
                                            <input type="checkbox" class="checkboxClass"></input>
                                        </div>
                                    </div>
                                    <div class="singleTask">
                                        <div class="checkboxDiv">
                                            <input type="checkbox" class="checkboxClass"></input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <div id="popupcreatetasklist" style="display:none">
        <h2>New Tasklist</h2>
        <form method="get">
            <input type="hidden" name="action" value="newtask">
            <label>Title:
                <input type="text" name="ltitle" required>
            </label>
            <label>Location:
                <input type="text" name="ldescription" required>
            </label>
            <label>Description:
                <textarea name="description" required></textarea>
            </label>
            <label>Timeset:
                <input type="date" id="date" name="date" required><br><br>
                <label>Add task:<br>
                    <button onclick="opencreatetask()">Add task</button><br>
                </label>
            </label>
            <label>Invite users:
                <input id="participants" type="text" name="participants[]" size="250"><br>
            </label>
            <label>Invite groups:
                <input type="text" name="inviteGroups">
            </label>
            <button type="submit">Accept</button>
            <button type="button" onclick="closecreatetasklist()">Cancel</button>
        </form>
    </div>

    <!-- Task -->
    <div id="popupcreatetask" style="display:none">
        <h2>New Task</h2>
        <form>
            <label>Title:
                <input type="text" name="ttitle">
            </label>
            <label>Description:
                <input type="text" name="tdescription">
            </label>
            <div class="date-container">
                <label for="fecha" class="fecha-label">Select the deadline:</label><br>
                <input type="date" id="date" name="date" required><br><br>
            </div>
            <label>Assign people:
                <textarea name="description"></textarea>
            </label>
            <button type="submit">Accept</button>
            <button type="button" onclick="closecreatetask()">Cancel</button>
        </form>
    </div>

    <!-- Task Detail Popup -->
    <div id="popupTaskDetailMini" style="display: none;">
        <form class="popup-mini" onsubmit="submitMiniTaskDetail(event)">
            <h2>Task Detail</h2>

            <label for="miniTaskTitle">Title:</label>
            <input type="text" id="miniTaskTitle" name="title" readonly>

            <label for="miniTaskDescription">Description:</label>
            <textarea id="miniTaskDescription" name="description" rows="4" readonly></textarea>

            <div class="popup-mini-buttons">
                <button type="button" onclick="editMiniTask()">Edit</button>
                <button type="submit" class="accept">Accept</button>
                <button type="button" class="cancel" onclick="closeMiniPopup()">Cancel</button>
            </div>
        </form>
    </div>

</body>

</html>