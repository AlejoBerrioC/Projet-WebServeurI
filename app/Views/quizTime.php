<?php
require_once __DIR__ . '/../Models/Entities/Quiz.php';
require_once __DIR__ . '/../Models/DAOs/QuizDAO.php';
require_once __DIR__ . '/../../database/Database.php';

session_start();
$db = (new Database())->connect();
$quizDao = new QuizDAO($db);
$newQuiz = new Quiz();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quiz-id'])) {
    $quizId = $_POST['quiz-id']; 
    $_SESSION['quiz_id'] = $quizId;
    header('Location: quizPage.php');
}

$quizzes = $quizDao->getAllQuizzes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/styleQuizTime.css">
    <title>Quiz Time</title>
</head>
<body>
    <div class="my-container">
        <div class="table-title">
            <h1>What Kind of Gamer Are You?</h1>
        </div>
        <div class="quiz-list">
            <table id="idTable-quiz">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Release Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($quizzes as $quiz) : ?>
                        <?php
                            $quizObj = new Quiz($quiz['id'], $quiz['titre'], $quiz['description'], $quiz['date_creation']);
                        ?>
                        <tr>
                        <td><?php echo $quizObj->getTitle(); ?></td>
                        <td><?php echo $quizObj->getDescription(); ?></td>
                        <td><?php echo date('Y-m-d', strtotime($quizObj->getDateCreation())); ?></td>
                        <td>
                            <form action="" method="post" name="start-quiz">
                                <input type="hidden" name="quiz-id" id="quiz-id" value="<?php echo $quiz['id']; ?>">
                                <button type="submit">Start</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>