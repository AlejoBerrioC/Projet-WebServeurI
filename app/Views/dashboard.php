<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/styleDashboard.css">
    <title>Dashboard Admin</title>
</head>
<body>
    <div class="my-container">
        <div class="navbar-ver">
            <a href="./dashboard.php"><img src="../../public/images/LogoApp.webp" alt="" id="idLogo-navbar"></a>
            <ul>
                <li><a href="./userProfile.php" target="contentFrame">Profile</a></li>
                <li><a href="./quizTime.php" target="contentFrame">Quiz Time</a></li>
                <li><a href="./userList.php" target="contentFrame">User List</a></li>
                <li><a href="./quizList.php" target="contentFrame">Quiz List</a></li>
            </ul>
            <button type="button"><img src="../../public/images/logout.png" alt=""></button>
        </div>
        <div class="iframe">
            <iframe src="./userProfile.php" name="contentFrame" id="idContentFrame"></iframe>
            <img src="../../public/images/background.jpg" alt="">
        </div>
    </div>
</body>
</html>