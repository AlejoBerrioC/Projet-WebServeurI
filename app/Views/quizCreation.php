<?php

require_once __DIR__ . '/../Models/Entities/Quiz.php';
require_once __DIR__ . '/../Models/DAOs/QuizDAO.php';
require_once __DIR__ . '/../Models/Entities/Question.php';
require_once __DIR__ . '/../Models/DAOs/QuestionDAO.php';
require_once __DIR__ . '/../Models/Entities/Answer.php';
require_once __DIR__ . '/../Models/DAOs/AnswerDAO.php';
require_once __DIR__ . '/../../database/Database.php';

session_start();

$db = (new Database())->connect();
$quizDao = new QuizDAO($db);
$questionDao = new QuestionDAO($db);
$answerDao = new AnswerDAO($db);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quiz = unserialize($_SESSION['new_quiz']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/styleQuizCreation.css">
    <title>Quiz Creation</title>
</head>
<body>
    <div class="my-container">
        <div class="table-title">
            <h1>New Quiz</h1>
        </div>
        <form id="quiz-form" method="post">
            <div id="question-container">
            </div>
            <button type="button" class="add-question" id="add-question">Add Another Question</button>
            <br/><br/>
            <div class="quiz-description-div">
                <label for="quiz-title" >Title: </label>
                <input type="text" id="quiz-title" name="quiz-title">
                <label for="quiz-description" >Description: </label><br/>
                <textarea id="quiz-description" name="quiz-description" placeholder="Description" rows="4" cols="50">
                </textarea>
                <br/><br/>
                <button type="submit" id="save-quiz" name="save-quiz">Save Quiz</button>
            </div>
        </form>
    </div>
    <script src="../../public/js/jsQuizcreation.js"></script>
</body>
</html>