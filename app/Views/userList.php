<?php
require_once __DIR__ . '/../Models/Entities/User.php';
require_once __DIR__ . '/../Models/DAOs/UserDAO.php';
require_once __DIR__ . '/../../database/Database.php';

session_start();

$db = (new Database())->connect();
$userDao = new UserDAO($db);

$users = $userDao->getAllUsers();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $success = $userDao->deleteUser($_POST['delete-user-id']);

    if ($success) {
        echo 'success';
    } else {
        echo 'error';
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/styleUserList.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>User List</title>
</head>
<body>
    <div class="my-container">
        <div class="table-title">
            <h1>Manage Users</h1>
            <button type="button" onclick="creationAdmin()">Add Administrator</button>
        </div>
        <div class="user-list">
            <table id="idTable-user">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Inscription Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) : ?>
                        <?php 
                            $userObj = new User($user['id'], $user['username'], $user['email'], $user['password'], $user['role'], $user['date_inscription']);
                        ?>

                        <tr id="user-row-<?php echo $user['id']; ?>">
                            <td><?php echo $userObj->getUsername(); ?></td>
                            <td><?php echo $userObj->getRole(); ?></td>
                            <td><?php echo date('Y-m-d', strtotime($userObj->getDateInscription())); ?></td>
                            <td>
                                <button type="button" id="delete-user" class="btn btn-primary" 
                                data-toggle="modal" data-target="#delete-user-modal" 
                                data-user-number="<?php echo $user['id']; ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Delete User Modal -->
    <div id="delete-user-modal" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="delete-user-form" method="post">
                    <div class="modal-header">
                        <h3 class="modal-title">Delete User</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                        <input type="hidden" id="delete-user-id" name="delete-user-id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" onclick="deleteUser()">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../../public/js/jsUserList.js"></script>
</body>
</html>