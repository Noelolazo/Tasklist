<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Taskmanager - Create Task</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/clsAjax.js"></script>
    <script src="/js/main.js"></script>
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
                    <div class="dateButtonDiv"><button class="dateButton">DATE</button> </div>
                    <div class="createListDiv"><button class="createListButton">CREATE TASK LIST</button></div>
                </div>

                <div class="wideAndNarrowDiv">
                    <div class="whideDiv">
                        <div class="taskListParentDiv">
                            <div class="taskList">
                                <div class="singleTask">
                                    <div class="checkboxDiv">
                                        <input type="checkbox" class="checkboxClass"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="taskList"></div>
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
</body>

</html>