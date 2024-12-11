<?php
require_once __DIR__ . '/../Entities/Result.php';

class ResultDAO {
    private $conn;
    private $table = 'results';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addResult(Result $result) {
        $quiz_id = $result->getQuizId();
        $user_id = $result->getUserId();
        $score = $result->getScore();
        $query = "INSERT INTO " . $this->table . " (quiz_id, user_id, score) VALUES (:quiz_id, :user_id, :score)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quiz_id', $quiz_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':score', $score);
        return $stmt->execute();
    }

    public function getResultsByUserId($user_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>