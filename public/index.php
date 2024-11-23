<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleLogin.css">
    <title>LogIn Page: Munchyroll</title>
</head>

<body>
    <div class="container">
        <div class="login-box">
            <div class="login-image">
                <img src="./images/LogoApp.webp" alt="login-image" width="30%" height="30%">
            </div>
            <form name="login-form" method="post">
                <label for="name">User Name:</label> <br/>
                <input type="text" id="name" name="name" length="16"> <br/><br/>
                <label for="password">Password: </label> <br/>
                <input type="password" id="pass" name="pass" length="16"> <br/>
                <button type="button" id="login">LogIn</button> 
                <button type="button" id="register">Register</button>
            </form>
        </div>
        <div class="background">
            <img src="./images/Login.png" alt="">
        </div>
    </div>
</body>

</html>