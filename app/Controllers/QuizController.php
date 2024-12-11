<?php

session_start();
require_once __DIR__ . '/../Models/DAOs/QuestionDAO.php';
require_once __DIR__ . '/../Models/DAOs/AnswerDAO.php';
require_once __DIR__ . '/../Models/DAOs/ResultDAO.php';
require_once __DIR__ . '/../Models/Entities/Result.php';
require_once __DIR__ . '/../../database/Database.php';

$db = (new Database())->connect();
$questionDao = new QuestionDAO($db);
$answerDao = new AnswerDAO($db);
$resultDao = new ResultDAO($db);

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentQuestionId = $_POST['currentQuestionId'] ?? null;
    $answerId = $_POST['answerId'] ?? null;
    $score = $_POST['score'] ?? 0;
    $result = 0;
    $numberQuestion = $_POST['totalQuestions'] ?? null;

    if(!$currentQuestionId || !$answerId) {
        error_log("Current Question ID: $currentQuestionId, Answer ID: $answerId");
        echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
        exit();
    }

    if($answerDao->authGoodAnswer($answerId)) {
        $score += 1;
        $result = round($score / $numberQuestion * 100, 1);
    }

    $nextQuestion = $questionDao->getNextQuestion($_SESSION['quiz_id'], $currentQuestionId);

    if($nextQuestion) {
        $answers = $answerDao->getAnswersByQuestionId($nextQuestion->getId());
        
        echo json_encode([
            'status' => 'success',
            'nextQuestion' => [
                'id' => $nextQuestion->getId(),
                'text' => $nextQuestion->getQuestionText(),
                'image_url' => $nextQuestion->getImageUrl(),
                'answers' => $answers,
            ],
            'score' => $score
        ]);
    } else {
        echo json_encode(['status' => 'success', 'nextQuestion' => null, 'score' => $score]);
        $resultDao->addResult(new Result($_SESSION['quiz_id'], $_SESSION['user_id'], $result));
    }
}
?>