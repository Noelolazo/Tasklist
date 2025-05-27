<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Taskmanager - Landpage</title>
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
        <div class="main">
            <div class="section">
                <a href="/app/myTasks">
                    <button>MY TASKS</button>
                </a>
            </div>

            <div class="section2">
                <a href="/app/calendar">
                    <button>CALENDAR</button>
                </a>
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