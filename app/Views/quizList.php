<?php
require_once __DIR__ . '/../Models/Entities/Quiz.php';
require_once __DIR__ . '/../Models/DAOs/QuizDAO.php';
require_once __DIR__ . '/../../database/Database.php';

session_start();
$db = (new Database())->connect();
$quizDao = new QuizDAO($db);
$newQuiz = new Quiz();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'createQuiz') {
    $quizId = $quizDao->addQuiz($newQuiz);
    $newQuiz->setId($quizId);
    $_SESSION['new_quiz'] = serialize($newQuiz);

    echo json_encode(['status' => 'success', 'quiz_id' => $quizId]);
    exit();
}

$quizzes = $quizDao->getAllQuizzes();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete-quiz-id'])) {
    $success = $quizDao->deleteQuiz($_POST['delete-quiz-id']);

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
    <link rel="stylesheet" href="../../public/css/styleQuizList.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Quiz List</title>
</head>
<body>
    <div class="my-container">
        <div class="table-title">
            <h1>Manage Quizes</h1>
            <form method="post">
                <button type="submit" onclick="creationQuiz()">Add New Quiz</button>
            </form> 
        </div>
        <div class="quiz-list">
            <table id="idTable-quiz">
                <thead>
                    <tr>
                        <th>Title</th>
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
                        <tr id="quiz-row-<?php echo $quiz['id']; ?>">
                            <td><?php echo $quizObj->getTitle(); ?></td>
                            <td><?php echo $quizObj->getDescription(); ?></td>
                            <td><?php echo date('Y-m-d', strtotime($quizObj->getDateCreation())); ?></td>
                            <td>
                                <button type="submit" id="edit-quiz" onclick="creationQuiz()">Edit</button>
                                &nbsp;
                                <button type="button" id="delete-quiz" class="btn btn-primary" 
                                data-toggle="modal" data-target="#delete-quiz-modal"
                                data-quiz-id="<?php echo $quiz['id']; ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Delete quiz Modal -->
    <div id="delete-quiz-modal" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="delete-quiz-form" method="post">
                    <div class="modal-header">
                        <h3 class="modal-title">Delete Quiz</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                        <input type="hidden" id="delete-quiz-id" name="delete-quiz-id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" onclick="deleteQuiz()">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../../public/js/jsQuizList.js"></script>
</body>
</html>