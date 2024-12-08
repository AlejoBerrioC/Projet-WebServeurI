<?php
require_once __DIR__ . '/../app/Controllers/Auth.php';
require_once __DIR__ . '/../app/Controllers/PageController.php';
require_once __DIR__ . '/../app/Models/Entities/User.php';
require_once __DIR__ . '/../app/Models/DAOs/UserDAO.php';
require_once __DIR__ . '/../database/Database.php';

$db = (new Database())->connect();
$userDao = new UserDAO($db);

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = null;
    $error = "";

    if(isset($_POST['login'])) {
        if(isset($_POST['name']) && isset($_POST['password'])) {
            $username = $_POST['name'];
            $password = $_POST['password'];
            $user = $userDao->authenticateUser($username, $password);
        }
    
        if($user && password_verify($password, $user->getPassword())) {
            Auth::login($user, $_POST['remember']);
            $_SESSION['user_id'] = $user->getId();
            $role = $user->getRole();
            PageController::dashboard($role);
        } else{
            $error = "Invalid username or password";
        }
    }

    if(isset($_POST['submit-register'])) {
        if(isset($_POST['new-name']) && isset($_POST['new-email']) && isset($_POST['new-pass'])) {
            $username = $_POST['new-name'];
            $email = $_POST['new-email'];
            $password = $_POST['new-pass'];
            if(Auth::register($userDao, $username, $email, $password)) {
                PageController::login();
            }
        }
    }
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
                <input type="password" id="password" name="password" length="16"> <br/>
                <button type="submit" id="login" name="login">LogIn</button> 
                <button type="button" id="register" name="register">Register</button><br/>
                <input type="checkbox" id="remember" name="remember"> Remember me
                <p><?php if(isset($error)) echo $error; ?></p>
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
                <button type="submit" id="submit-register" name="submit-register">Create Account</button>
                <button type="button" id="cancel-register" name="cancel-register">Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>