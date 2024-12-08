<?php
require_once __DIR__ . '/../Models/Entities/User.php';
require_once __DIR__ . '/../Models/DAOs/UserDAO.php';
require_once __DIR__ . '/../../database/Database.php';

$db = (new Database())->connect();
$userDao = new UserDAO($db);
$message = '';
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new-admin-username']) && isset($_POST['new-admin-email'])
  && isset($_POST['username']) && isset($_POST['password'])) {
    $usernameNewAdmin = $_POST['new-admin-username'];
    $emailNewAdmin = $_POST['new-admin-email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    if($userDao->authenticateAdmin($username, $password)) {
        $userDao->changeUserToAdmin($usernameNewAdmin);
        $message = "New admin created successfully";
    } else {
        $message = "Invalid username or password";
    }

}
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/styleAdminCreation.css">
    <title>Admin Creation</title>
</head>
<body>
    <div class="my-container">
        <div class="table-title">
            <h1>New Admin</h1>
        </div>
        <div class="add-admin-container">
            <form id="admin-creation-form" method="post">
                <div class="new-admin">
                    <h2>New Admin Info</h2>
                    <table>
                        <tr>
                            <td><label for="username">Username: </label></td>
                            <td><input type="text" name="new-admin-username" id="new-admin-username"></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email: </label></td>
                            <td><input type="text" name="new-admin-email" id="new-admin-email"></td>
                        </tr>
                    </table>
                    <br/>
                </div>
                <div class="admin-info">
                    <h2>Your Admin Info</h2>
                    <table>
                        <tr>
                            <td><label for="username">Username: </label></td>
                            <td><input type="text" name="username" id="username"></td>
                        </tr>
                        <tr>
                            <td><label for="password">Password: </label></td>
                            <td><input type="password" name="password" id="password"></td>
                        </tr>
                    </table>
                    <br/>
                    <button type="submit">Create Admin</button>
                </div>
                <p class="text-danger"><?php echo $message; ?></p>
            </form>
        </div>
    </div>
</body>
</html>