<?php
session_start();
require_once __DIR__ . '/../Models/DAOs/QuestionDAO.php';
require_once __DIR__ . '/../Models/DAOs/AnswerDAO.php';
require_once __DIR__ . '/../../database/Database.php';

$db = (new Database())->connect();
$questionDao = new QuestionDAO($db);
$answerDao = new AnswerDAO($db);


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentQuestionId = $_POST['currentQuestionId'] ?? null;
    $answerId = $_POST['answerId'] ?? null;

    if(!$currentQuestionId || !$answerId) {
        error_log("Current Question ID: $currentQuestionId, Answer ID: $answerId");
        echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
        exit();
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
            ]
        ]);
    } else {
        echo json_encode(['status' => 'success', 'nextQuestion' => null]);
    }
}
?>