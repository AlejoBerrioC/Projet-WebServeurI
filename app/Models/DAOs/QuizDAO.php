<?php

require_once __DIR__ . '/../Entities/Quiz.php';

class QuizDAO{
    private $conn;
    private $table = 'quiz';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllQuizzes() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getQuizById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $quiz = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Quiz($quiz['id'], $quiz['titre'], $quiz['description'], $quiz['date_creation']);
    }

    public function addQuiz(Quiz $quiz) {
        $title = $quiz->getTitle() ?? '';
        $description = $quiz->getDescription() ?? '';
        $query = "INSERT INTO " . $this->table . " (titre, description) VALUES (:titre, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titre', $title);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function addTitre($id, $title) {
        $query = "UPDATE " . $this->table . " SET titre = :titre WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titre', $title);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function addDescription($id, $description) {
        $query = "UPDATE " . $this->table . " SET description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function updateQuiz(Quiz $quiz, $id) {
        $title = $quiz->getTitle();    
        $description = $quiz->getDescription();
        $query = "UPDATE " . $this->table . " SET titre = :titre, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titre', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteQuiz($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
}

?>