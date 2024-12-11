<?php
class SessionDAO {
    private $conn;
    private $table = 'sessions';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addSession($userId, $sessionToken, $expiration) {
        $query = "INSERT INTO " . $this->table . " (user_id, session_token, expiration) VALUES (:user_id, :session_token, :expiration)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':session_token', $sessionToken);
        $stmt->bindParam(':expiration', $expiration);
        return $stmt->execute();
    }
}
?>