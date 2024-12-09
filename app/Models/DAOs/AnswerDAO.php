<?php
require_once __DIR__ . '/../Entities/Answer.php';

class AnswerDAO{
    private $conn;
    private $table = 'answers';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addAnswer(Answer $answer, $question_id) {
        $query = "INSERT INTO " . $this->table . " (question_id, answer_text, is_correct) VALUES (:question_id, :answer_text, :is_correct)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':question_id', $question_id);
        $stmt->bindParam(':answer_text', $answer->getAnswerText());
        $stmt->bindParam(':is_correct', $answer->getIsCorrect());
        return $stmt->execute();
    }

    public function addGoodAnswer(Answer $answer, $question_id) {
        $answerTxt = $answer->getAnswerText();
        $answerCorrect = $answer->getIsCorrect();
        $query = "INSERT INTO " . $this->table . " (question_id, answer_text, is_correct) VALUES (:question_id, :answer_text, :is_correct)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':question_id', $question_id);
        $stmt->bindParam(':answer_text', $answerTxt);
        $stmt->bindParam(':is_correct', $answerCorrect);
        return $stmt->execute();
    }

    public function addBadAnswer(Answer $answer, $question_id) {
        $answerTxt = $answer->getAnswerText();
        $answerCorrect = $answer->getIsCorrect();
        $query = "INSERT INTO " . $this->table . " (question_id, answer_text, is_correct) VALUES (:question_id, :answer_text, :is_correct)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':question_id', $question_id);
        $stmt->bindParam(':answer_text', $answerTxt);
        $stmt->bindParam(':is_correct', $answerCorrect);
        return $stmt->execute();
    }

    public function getBadAnswersByQuestionId($question_id) {
        $query = "SELECT * FROM . " . $this->table . " WHERE question_id = :question_id AND is_correct = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':question_id', $question_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGoodAnswerByQuestionId($question_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE question_id = :question_id AND is_correct = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':question_id', $question_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAnswersByQuestionId($question_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE question_id = :question_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':question_id', $question_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>