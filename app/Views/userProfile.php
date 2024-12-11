<?php

require_once __DIR__ . '/../Models/Entities/User.php';
require_once __DIR__ . '/../Models/DAOs/UserDAO.php';
require_once __DIR__ . '/../Models/Entities/Result.php';
require_once __DIR__ . '/../Models/DAOs/ResultDAO.php';
require_once __DIR__ . '/../Models/Entities/Quiz.php';
require_once __DIR__ . '/../Models/DAOs/QuizDAO.php';
require_once __DIR__ . '/../../database/Database.php';

$db = (new Database())->connect();
$userDao = new UserDAO($db);
$quizDao = new QuizDAO($db);
$resultDao = new ResultDAO($db);
$message = '';

session_start();
$user_id = $_SESSION['user_id'];
$user = $userDao->getUserById($user_id);
$userObj = new User($user['id'], $user['username'], $user['email'], $user['password'], $user['role'], $user['date_inscription']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentPassword = $_POST['current-password'];
    $newPassword = $_POST['new-password'];
    
    if(!password_verify($currentPassword, $userObj->getPassword())) {
        $message = "Invalid current password";
    } else {
        if($userDao->changePassword($userObj->getId(), $newPassword)) {
            $message = "Password changed successfully";
        }
    }
}

$results = $resultDao->getResultsByUserId($userObj->getId());
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../public/css/styleUserProfile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>User Profile</title>
</head>
<body>
    <div class="my-container">
        <div class="profile-info">
            <img src="../../public/images/user.png" alt="">
            <p><strong>Username: </strong> <?php echo $userObj->getUsername(); ?></p>
            <p><strong>Email: </strong> <?php echo $userObj->getEmail(); ?></p>
            <p><strong>Registration Date: </strong><?php echo date('Y-m-d', strtotime($userObj->getDateInscription())); ?></p>
            <button type="button" id="edit-password" class="btn btn-primary" 
                    data-toggle="modal" data-target="#edit-password-modal" 
                    data-user-number="<?php echo $userObj->getId(); ?>">Edit Password</button>
            <p class="text-danger"><?php echo $message; ?></p>
        </div>
        <div class="quiz-info">
            <table id="idTable-quiz">
                <thead>
                    <tr>
                        <th>Quiz Name</th>
                        <th>Result</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $result) : ?>
                        <tr>
                            <td><?php echo $quizDao->getQuizById($result['quiz_id'])->getTitle(); ?></td>
                            <td><?php echo $result['score']; ?></td>
                            <td><?php echo date('Y-m-d', strtotime($result['date'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Change password Modal -->
    <div id="edit-password-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="edit-password-form" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="edit-password-user-id" name="edit-password-user-id">
                        <label for="current-password">Current Password</label>
                        <input type="password" id="current-password" name="current-password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password</label>
                        <input type="password" id="new-password" name="new-password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '[data-target="#edit-password-modal"]', function () {
        var userId = $(this).data('user-number');
        $('#edit-password-user-id').val(userId);
    });
</script>
</body>
</html>