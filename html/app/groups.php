<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Taskmanager - Groups</title>
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

        <div class="mainContainerGroups">
            <div class="divGroups">
                <div class="headerDiv">
                    <div class="createGroupTitle">
                        <button class="createGroupButton">
                            CREATE GROUP
                        </button>
                    </div>
                </div>

                <div class="bottomDiv">

                    <div class="groupLabel">
                        <label for="groupName" class="label">GROUP NAME</label>
                        <input type="text">
                    </div>
                    <div class="groupLabel"></div>
                </div>
            </div>


            <div class="divGroups">
                <div class="headerDiv">
                    <div class="createGroupTitle">
                        <button class="createGroupButton">
                            CREATE GROUP
                        </button>
                    </div>
                </div>

                <div class="bottomDiv">
                    <div class="groupLabel"></div>
                    <div class="groupLabel"></div>
                    <div class="groupLabel"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>