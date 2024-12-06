<?php

require_once __DIR__ . '/../Entities/User.php';
class UserDAO{
    private $conn;
    private $table = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addUser(User $user) {
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = password_hash($user->getPassword(), PASSWORD_BCRYPT);
        $query = "INSERT INTO " . $this->table . " (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function getAllUsers() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function authenticateUser($username, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return new User($user['id'], $user['username'], $user['email'], $user['password'], $user['role'], $user['date_inscription']);
        }
        return null;
    }

    public function authenticateAdmin($username, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username AND role = 'admin'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return new User($user['id'], $user['username'], $user['email'], $user['password'], $user['role'], $user['date_inscription']);
        }
        return null;
    }

    public function changePassword($id, $newPassword) {
        $query = "SELECT password FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $currentPasswordHash = $stmt->fetchColumn();
    
        if (password_verify($newPassword, $currentPasswordHash)) {
            throw new Exception("Password cant be the same as the old one.");
        }
    
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $updateQuery = "UPDATE " . $this->table . " SET password = :password WHERE id = :id";
        $updateStmt = $this->conn->prepare($updateQuery);
        $updateStmt->bindParam(':password', $hashedPassword);
        $updateStmt->bindParam(':id', $id);
    
        if ($updateStmt->execute()) {
            return true;
        } else {
            throw new Exception("Error changing password.");
        }
    }
}

?>