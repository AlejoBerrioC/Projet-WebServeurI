<?php
    if (isset($_POST['login'])){
        header('Location: ../app/Views/dashboard.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleLogin.css">
    <script src="./js/jsLogin.js"></script>
    <title>LogIn Page: What Kind of Gamer are You?</title>
</head>

<body>
    <div class="my-container">
        <div class="login-box" id="login-box">
            <div class="logo-image">
                <img src="./images/LogoApp.webp" alt="login-image" width="30%" height="30%">
            </div>
            <form name="login-form" method="post">
                <label for="name">User Name:</label> <br/>
                <input type="text" id="name" name="name" length="16"> <br/><br/>
                <label for="password">Password: </label> <br/>
                <input type="password" id="pass" name="pass" length="16"> <br/>
                <button type="submit" id="login" name="login">LogIn</button> 
                <button type="button" id="register" name="register">Register</button>
            </form>
        </div>
        <div class="background">
            <img src="./images/Login.png" alt="">
        </div>
        <!-- Register Modal -->
        <div class="register-box" id="register-box" style="display: none;">
            <div class="logo-image">
                <img src="./images/LogoApp.webp" alt="login-image" width="30%" height="30%">
            </div>
            <form name="register-form" method="post">
                <label for="new-name">User Name:</label> <br />
                <input type="text" id="new-name" name="new-name" maxlength="16"> <br /><br />
                <label for="new-email">Email:</label> <br />
                <input type="email" id="new-email" name="new-email"> <br /><br />
                <label for="new-password">Password: </label> <br />
                <input type="password" id="new-pass" name="new-pass" maxlength="16"> <br />
                <button type="submit" id="submit-register">Create Account</button>
                <button type="button" id="cancel-register">Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>