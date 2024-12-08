<?php
require_once __DIR__ . '/../Models/Entities/Quiz.php';
require_once __DIR__ . '/../Models/DAOs/QuizDAO.php';
require_once __DIR__ . '/../../database/Database.php';

session_start();
$db = (new Database())->connect();
$quizDao = new QuizDAO($db);
$newQuiz = new Quiz();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quizId = $quizDao->addQuiz($newQuiz);
    $newQuiz->setId($quizId);
    $_SESSION['new_quiz'] = serialize($newQuiz);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../public/js/jsQuizList.js"></script>
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
                        <th>Name</th>
                        <th>Description</th>
                        <th>Release Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Quiz 1</td>
                        <td>Test</td>
                        <td>2024-11-24</td>
                        <td>
                            <button type="submit" id="edit-quiz" onclick="creationQuiz()">Edit</button>
                            &nbsp;
                            <button type="button" id="delete-quiz" class="btn btn-primary" data-toggle="modal" data-target="#delete-quiz-modal">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Quiz 2</td>
                        <td>Test 2</td>
                        <td>2024-11-24</td>
                        <td>
                            <button type="submit" id="edit-quiz" onclick="creationQuiz()">Edit</button>
                            &nbsp;
                            <button type="button" id="delete-quiz" class="btn btn-primary" data-toggle="modal" data-target="#delete-quiz-modal">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Delete quiz Modal -->
    <div id="delete-quiz-modal" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h3 class="modal-title">Delete Quiz</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this user?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>