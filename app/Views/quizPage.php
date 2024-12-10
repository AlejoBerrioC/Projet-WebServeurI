<?php
require_once __DIR__ . '/../Models/Entities/Quiz.php';
require_once __DIR__ . '/../Models/DAOs/QuizDAO.php';
require_once __DIR__ . '/../Models/Entities/Question.php';
require_once __DIR__ . '/../Models/DAOs/QuestionDAO.php';
require_once __DIR__ . '/../Models/Entities/Answer.php';
require_once __DIR__ . '/../Models/DAOs/AnswerDAO.php';
require_once __DIR__ . '/../../database/Database.php';
session_start();
// Get the quiz ID from the session
$db = (new Database())->connect();
$quizDao = new QuizDAO($db);
$questionDao = new QuestionDAO($db);
$answerDao = new AnswerDAO($db);
if(isset($_SESSION['quiz_id'])) {
    $quiz_id = $_SESSION['quiz_id'];
} else {
    echo "No quiz ID found in session.";
}

$questions = $questionDao->getQuestionsByQuizId($quiz_id);

//Change the question to the next one
// if(!isset($_SESSION['current_question_index'])) {
//     $_SESSION['current_question_index'] = 0;
//     echo 'current_question_index set to 0';
// }

// if(!empty($questions)) {
//     $currentQuestionIndex = $_SESSION['current_question_index'];

//     if($currentQuestionIndex < count($questions)) {
//         $currentQuestion = $questions[$currentQuestionIndex];
//         $answers = $answerDao->getAnswersByQuestionId($currentQuestion['id']);
//     }
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_answer'])) {
//     echo "antes " . $_SESSION['current_question_index'];
//     $_SESSION['current_question_index']++;
//     echo "despues " . $_SESSION['current_question_index'];
//     header("Location: " . $_SERVER['PHP_SELF']);
// }
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
            <h1><?php echo $quizDao->getQuizNameById($quiz_id); ?></h1>
        </div>
        <?php if(!empty($questions)) : ?>
            <?php 
                $firstQuestion = $questions[0];
                $answers = $answerDao->getAnswersByQuestionId($firstQuestion['id']);
            ?>
            <div id="question-container">
                <div class="question-container" id="question-<?php echo $firstQuestion['id']; ?>">
                    <div class="image-question">
                        <img src="<?php echo $firstQuestion['image_url']; ?>" alt="Question Image">
                    </div>
                    <div class="question-options">
                        <div class="question-text">
                            <h1><?php echo $firstQuestion['question_text']; ?></h1>
                        </div>
                        <form method="post" action="quizPage.php">
                            <div class="answers">
                                <table class="answers-table">
                                    <tr>
                                        <?php foreach ($answers as $answer) : ?>
                                            <td>
                                                <input type="radio" name="answer" id="answer-<?php echo $answer['id']; ?>" value="<?php echo $answer['id']; ?>">
                                                <label for="answer-<?php echo $answer['id']; ?>"><?php echo $answer['answer_text']; ?></label>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                </table>
                                <button type="submit" name="save-answer" id="save-answer-btn" data-current-question-id="<?php echo $firstQuestion['id']; ?>">Save Answer</button>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script src="../../public/js/jsQuizPage(Ajax).js"></script>
</body>
</html>