<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Taskmanager - Log In</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/normalize.css">
    <script src="/js/clsAjax.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/login.js"></script>
</head>

<header class="header">
    <div class="imageDiv">
        <img src="/rscrs/img/logo.svg" class="mercantecLogo">
    </div>
    <div class="loginInfoButtonsDiv">
        <div class="loginDiv">
            <a href="/signUp">
                <button class="loginButton">
                    <span>SIGN IN</span>
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
    <div class="logIn-container">

        <form method="GET" id="loginForm">
            <input type="hidden" name="action" value="login">
            <div class="emailDiv">
                <label>
                    E-mail:
                </label>
                <input type="text" name="email" size="50" class="textboxLogIn" required>
            </div>

            <div class="passwordResetDiv">
                <label>
                    Password:
                </label>
                <a href="/passwordReset">
                    <label for="passwordResetHTMLRedirectLink">
                        Forgot your password?
                    </label>
                </a>
            </div>

            <input type="password" name="passwd" size="50" class="textboxLogIn" required>

            <div class="logButtonDiv">
                <input type="submit" class="buttonLog">
            </div>
        </form>
        <div id="login-message"></div>
    </div>
</body>

<footer>
    © 2025 Task Manager - All Rights Reserved
</footer>

</html>