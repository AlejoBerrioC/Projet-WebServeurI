<?php
require_once __DIR__ . '/../Entities/Question.php';

class QuestionDAO{
    private $conn;
    private $table = 'questions';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addQuestion(Question $question, $quiz_id) {
        $question_text = $question->getQuestionText();
        $image_url = $question->getImageUrl();
        $good_answer = $question->getGoodAnswer();
        $query = "INSERT INTO " . $this->table . " (quiz_id, question_text, image_url, good_answer) VALUES (:quiz_id, :question_text, :image_url, :good_answer)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quiz_id', $quiz_id);
        $stmt->bindParam(':question_text', $question_text);
        $stmt->bindParam(':image_url', $image_url);
        $stmt->bindParam(':good_answer', $good_answer);
        return $stmt->execute();
    }

    public function getQuestionsByQuizId($quiz_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE quiz_id = :quiz_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quiz_id', $quiz_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteQuestion($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>