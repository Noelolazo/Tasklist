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
    <script src="/js/myProfile.js"></script>
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

        <div class="containerDetailsAndReset">
            <div class="containerReset">
                <div class="resetPasswordDiv" id="displayInfo"></div>
                <form method="POST" action="registerUserDelMarc.php">
                    <div class="resetPasswordDiv">
                        <label>New password:</label>
                        <input type="text" name="Name" size="50" class="passwordResetTextbox" required>

                        <label>Confirm password:</label>
                        <input type="text" name="Email" size="50" class="passwordResetTextbox" required>

                        <div class="resetButtonDiv">
                            <input type="submit" class="resetButton" value="SUBMIT">
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
    </div>
</body>
<script>
    function handleDayClick(date) {
        // Redirige a la página deseada
        window.location.href = "tasklist.php?date=" + date;
    }
</script>

</html>