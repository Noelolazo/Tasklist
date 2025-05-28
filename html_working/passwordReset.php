<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Taskmanager - Password Reset</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/normalize.css">
    <script src="/js/clsAjax.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/recoverypsswd.js"></script>

</head>

<header class="header">
        <div class="imageDiv">
            <img src="/rscrs/img/logo.svg" class="mercantecLogo">
        </div>
        <div class="loginInfoButtonsDiv">
            <div class="loginDiv">
                <a href="/login">
                    <button class="loginButton">
                        <span>LOG IN</span>
                    </button>
                </a>
            </div>
            <div class="infoDiv">
                <a href="/info">
                    <button class="infoButton">
                        INFO
                    </button>
                </a>
            </div>
        </div>

</header>

<body>
    <div class="reset-container">
        <div class="correo_usuario-container" id="correo_usuario-container"></div>
        <form method="POST" action="/passwordReset" id="psswdRecForm">
            <div class="resetPasswordDiv">
                <?php
                    if(!isset($_POST['email'])){
                ?>
                    <input type="hidden" name="action" value="recoverypassEmail">
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" size="50" class="passwordResetTextbox" required>
                <?php
                    } else { 
                ?>
                <input type="hidden" name="action" value="recoverypassPIN">

                <label for="PIN">PIN:</label>
                <input type="text" name="PIN" id="PIN" size="50" class="passwordResetTextbox" required>

                <label for="psswd">New password:</label>
                <input type="password" name="psswd" id="psswd" size="50" class="passwordResetTextbox" required>
                    
                <label for="psswdR">Confirm password:</label>
                <input type="password" name="psswdR" id="psswdR" size="50" class="passwordResetTextbox" required>
                
                <input type="hidden" name="email" value="<?php echo $_POST['email'] ?>">
                <?php
                    }
                ?>
                
                <div class="resetButtonDiv">
                    <input type="submit" class="resetButton">
                </div>
            </div>
        </form>

    </div>
</body>


<footer>
    © 2025 Task Manager - All Rights Reserved
</footer>

</html>