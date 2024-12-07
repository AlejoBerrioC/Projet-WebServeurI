<?php
require_once __DIR__ . '/../Entities/Answer.php';

class AnswerDAO{
    private $conn;
    private $table = 'answers';

    public function __construct($db) {
        $this->conn = $db;
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
}

?>