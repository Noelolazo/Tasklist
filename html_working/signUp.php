<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Taskmanager - Sign Up</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/normalize.css">
    <script src="/js/clsAjax.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/signUp.js"></script>
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
    
    <div class="signIn-container">
        <div class="correo_usuario-container" id="correo_usuario-container">
        </div>

        <form method="GET" id="signUpForm">
            <div class="input-container">
            <input type="hidden" name="action" value="signUp">
                <label>Username:</labe>
                    <input type="text" name="name" size="50" class="textboxSignIn" required>
                    <label>E-mail:</label>
                    <input type="text" name="email" size="50" class="textboxSignIn" required>
                    <label>Phone number (Optional):</label>
                    <input type="number" name="phone_number" max="999999999" size="9" class="textboxSignIn">
                    <label>Password:</label>
                    <input type="password" name="passwd" size="50" class="textboxSignIn" required>
                    
                    <div class="signButtonDiv">
                        <input type="submit" class="buttonLog">
                    </div>
            </div>
        </form>
        <div id="login-message"></div>
    </div>
</body>


<footer>
    © 2025 Task Manager - All Rights Reserved
</footer>

</html>