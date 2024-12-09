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
if(isset($_SESSION['quiz_id'])) {
    $quiz_id = $_SESSION['quiz_id'];
    echo $quiz_id;
} else {
    echo "No quiz ID found in session.";
}

$questions = $questionDao->getQuestionsByQuizId($quiz_id);

foreach($questions as $question) {
    $answers = $answerDao->getAnswersByQuestionId($question['id']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/styleQuizPage.css">
    <title>Quiz Page</title>
</head>
<body>
    <div class="my-container">
        <div class="table-title">
            <h1>Quiz 1</h1>
        </div>
        <form id="quiz-form" method="POST">
            <div id="question-container">
                <div class="image-question">
                    <img src="../../public/images/Quiz/Quiz1/q1.png" alt="Question Image">
                </div>
                <div class="question-options">
                    <div class="question-text">
                        <h1>Who is the main protagonist of The Legend of Zelda series?</h1>
                    </div>
                    <div class="answers">
                        <table class="answers-table">
                            <tr>
                                <td>
                                    <input type="radio" id="answer1" name="quiz-answer" value="Link">
                                    <label for="answer1">Link</label>
                                </td>
                                <td>
                                    <input type="radio" id="answer2" name="quiz-answer" value="Zelda">
                                    <label for="answer2">Zelda</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="radio" id="answer3" name="quiz-answer" value="Ganondorf">
                                    <label for="answer3">Ganondorf</label>
                                </td>
                                <td>
                                    <input type="radio" id="answer4" name="quiz-answer" value="Navi">
                                    <label for="answer4">Navi</label>
                                </td>
                            </tr>
                        </table>
                        <button type="submit">Save Answer</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>